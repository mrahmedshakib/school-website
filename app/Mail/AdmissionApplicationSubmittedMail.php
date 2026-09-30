<?php

namespace App\Mail;

use App\Models\AdmissionApplication;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class AdmissionApplicationSubmittedMail extends Mailable
{
    use Queueable, SerializesModels;

    public function __construct(
        public AdmissionApplication $application
    ) {
    }

    public function build()
    {
        return $this
            ->subject('Online Admission Application Submitted')
            ->view('emails.admission.application-submitted');
    }
}