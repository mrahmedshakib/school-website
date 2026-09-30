<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AdmissionPayment extends Model
{
    protected $fillable = [
        'admission_application_id',
        'payment_no',
        'amount',
        'payment_method',
        'account_number',
        'transaction_id',
        'payment_proof',
        'status',
        'admin_note',
        'paid_at',
        'verified_at',
    ];

    protected $casts = [
        'amount' => 'decimal:2',
        'paid_at' => 'datetime',
        'verified_at' => 'datetime',
    ];


    public function application()
    {
        return $this->belongsTo(
            AdmissionApplication::class,
            'admission_application_id'
        );
    }
}