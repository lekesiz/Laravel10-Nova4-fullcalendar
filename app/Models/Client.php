<?php

namespace App\Models;

use App\Services\NumeratorManager;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Client extends Model
{
    use HasFactory;

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($model) {
            $numeratorManager = new NumeratorManager();
            $nextNumber = $numeratorManager->getNextNumberForModel(get_class($model));
            $formattedNumber = $numeratorManager->formatNumberForModel(get_class($model), $nextNumber);

            $model->reference = $formattedNumber;
            $numeratorManager->incrementNumberForModel(get_class($model));
        });
    }

    protected $fillable = [
        'reference',
        'client_type',
        'civility',
        'last_name',
        'first_name',
        'email',
        'mobile_phone',
        'landline_phone',
        'accounting_code',
        'payment_deadline',
        'discount',
        'website',
        'siret',
        'vat',
        'payment_conditions',
        'notes',
        'payment_deadline'
    ];

    public function ClientAddress() {
        return $this->hasMany(ClientAddress::class);
    }
    public function ClientContact() {
        return $this->hasMany(ClientContact::class);
    }
    public function ClientDocument() {
        return $this->hasMany(ClientDocument::class);
    }
    public function ClientNote() {
        return $this->hasMany(ClientNote::class);
    }
    public function ClientTask() {
        return $this->hasMany(Task::class);
    }
    public function Quote() {
        return $this->hasMany(Quote::class);
    }
    public function CreditNote() {
        return $this->hasMany(CreditNote::class);
    }
    public function Intervention() {
        return $this->hasMany(Intervention::class);
    }
    public function Invoice() {
        return $this->hasMany(Invoice::class);
    }
}
