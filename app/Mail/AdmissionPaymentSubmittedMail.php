<?php

namespace App\Mail;

use App\Models\AdmissionPayment;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class AdmissionPaymentSubmittedMail extends Mailable
{
    use Queueable, SerializesModels;

    public function __construct(
        public AdmissionPayment $payment
    ) {
    }

    public function build()
    {
        return $this
            ->subject('Admission Payment Submitted')
            ->view('emails.admission.payment-submitted');
    }
}