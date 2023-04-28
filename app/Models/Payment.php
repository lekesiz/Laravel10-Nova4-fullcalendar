<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    use HasFactory;

    protected $casts = [
        'date' => 'date',
    ];

    protected $fillable = [
        'invoice_id',
        'description',
        'date',
        'payment_method',
        'amount',
        'account_to_credit',
    ];

    public function invoice()
    {
        return $this->belongsTo(Invoice::class);
    }

    protected static function boot()
    {
        parent::boot();

        static::saved(function ($payment) {
            // Faturayı alın ve ödemelerin toplamını hesaplayın
            $invoice = $payment->invoice;
            $totalPayments = $invoice->payments->sum('amount');

            // Fatura durumunu güncelleyin
            if ($totalPayments >= $invoice->total_ttc) {
                $invoice->status = 'Payé';
            } else {
                $invoice->status = 'Partiellement payée';
            }

            // Faturayı kaydedin
            $invoice->save();
        });
    }
}
