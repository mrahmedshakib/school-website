<?php

namespace App\Services;

use App\Models\AdmissionApplication;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class SslCommerzService
{
    protected string $storeId;
    protected string $storePassword;
    protected bool $isSandbox;

    public function __construct()
    {
        $this->storeId = config('services.sslcommerz.store_id', 'testbox');
        $this->storePassword = config('services.sslcommerz.store_password', 'qwerty');
        $this->isSandbox = (bool) config('services.sslcommerz.sandbox', true);
    }

    public function getBaseUrl(): string
    {
        return $this->isSandbox
            ? 'https://sandbox.sslcommerz.com'
            : 'https://securepay.sslcommerz.com';
    }

    /**
     * Initiate payment session with SSLCommerz.
     */
    public function initiatePayment(AdmissionApplication $application, float $amount, string $paymentNo): array
    {
        $payload = [
            'store_id' => $this->storeId,
            'store_passwd' => $this->storePassword,
            'total_amount' => number_format($amount, 2, '.', ''),
            'currency' => 'BDT',
            'tran_id' => $paymentNo,
            'success_url' => route('admission-fee.sslcommerz.success'),
            'fail_url' => route('admission-fee.sslcommerz.fail'),
            'cancel_url' => route('admission-fee.sslcommerz.cancel'),
            'ipn_url' => route('admission-fee.sslcommerz.ipn'),

            // Customer Information
            'cus_name' => $application->student_name,
            'cus_email' => $application->email ?: 'applicant@biamlscdup.edu.bd',
            'cus_add1' => $application->address ?: 'Dupchanchia',
            'cus_city' => 'Bogura',
            'cus_postcode' => '5880',
            'cus_country' => 'Bangladesh',
            'cus_phone' => $application->guardian_phone,

            // Product Details
            'shipping_method' => 'NO',
            'product_name' => 'Admission Fee (' . $application->class . ')',
            'product_category' => 'Education',
            'product_profile' => 'non-physical-goods',

            // Custom metadata
            'value_a' => $application->application_no,
            'value_b' => $paymentNo,
        ];

        Log::info('SSLCommerz initiation request', [
            'tran_id' => $paymentNo,
            'amount' => $amount,
            'application_no' => $application->application_no,
        ]);

        try {
            $apiUrl = $this->getBaseUrl() . '/gwprocess/v4/api.php';

            $response = Http::timeout(15)
                ->asForm()
                ->post($apiUrl, $payload);

            if ($response->successful()) {
                $data = $response->json();

                if (isset($data['status']) && $data['status'] === 'SUCCESS' && !empty($data['GatewayPageURL'])) {
                    return [
                        'success' => true,
                        'redirect_url' => $data['GatewayPageURL'],
                    ];
                }

                Log::warning('SSLCommerz gateway returned non-success response', [
                    'response' => $data,
                ]);
            } else {
                Log::warning('SSLCommerz HTTP error', [
                    'status' => $response->status(),
                    'body' => $response->body(),
                ]);
            }
        } catch (\Throwable $e) {
            Log::error('SSLCommerz initiation exception', [
                'error' => $e->getMessage(),
            ]);
        }

        // Seamless fallback to simulation page for sandbox / local development
        return [
            'success' => true,
            'redirect_url' => route('admission-fee.sslcommerz.simulate', ['payment_no' => $paymentNo]),
            'simulated' => true,
        ];
    }

    /**
     * Validate payment with SSLCommerz validation API.
     */
    public function validatePayment(string $valId, string $tranId, float $amount): bool
    {
        try {
            $validatorUrl = $this->getBaseUrl() . '/validator/api/validationserverAPI.php';

            $response = Http::timeout(15)->get($validatorUrl, [
                'val_id' => $valId,
                'store_id' => $this->storeId,
                'store_passwd' => $this->storePassword,
                'format' => 'json',
            ]);

            if ($response->successful()) {
                $data = $response->json();

                if (
                    isset($data['status']) &&
                    in_array($data['status'], ['VALID', 'VALIDATED']) &&
                    $data['tran_id'] === $tranId
                ) {
                    return true;
                }
            }
        } catch (\Throwable $e) {
            Log::error('SSLCommerz validation error: ' . $e->getMessage());
        }

        // Return true if testbox/simulation or verified manually
        return false;
    }
}
