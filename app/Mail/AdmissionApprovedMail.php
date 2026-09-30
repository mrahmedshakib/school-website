<?php

namespace App\Mail;

use App\Models\AdmissionPayment;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class AdmissionApprovedMail extends Mailable
{
    use Queueable, SerializesModels;

    public function __construct(
        public AdmissionPayment $payment
    ) {
    }

    public function build()
    {
        return $this
            ->subject('Admission Application Confirmed')
            ->view('emails.admission.approved');
    }
}