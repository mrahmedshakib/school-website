<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class SmsService
{
    public function send(
        string $phone,
        string $message
    ): bool {
        Log::info("SMS notification dispatched", [
            'to' => $phone,
            'message' => $message,
            'gateway_enabled' => (bool) config('services.sms.enabled'),
        ]);

        if (!config('services.sms.enabled') || empty(config('services.sms.url'))) {
            // Simulated delivery in local/development mode
            return true;
        }

        try {
            $response = Http::timeout(15)
                ->asForm()
                ->post(
                    config('services.sms.url'),
                    [
                        'api_key' => config('services.sms.api_key'),
                        'sender' => config('services.sms.sender'),
                        'to' => $phone,
                        'message' => $message,
                    ]
                );

            if ($response->successful()) {
                return true;
            }

            Log::error(
                'SMS sending failed',
                [
                    'phone' => $phone,
                    'response' => $response->body(),
                ]
            );

            return false;

        } catch (\Throwable $e) {

            Log::error(
                'SMS exception',
                [
                    'phone' => $phone,
                    'message' => $e->getMessage(),
                ]
            );

            return false;
        }
    }
}