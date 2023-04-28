<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Client extends Model
{
    use HasFactory;

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
    public function quotes() {
        return $this->hasMany(Quote::class);
    }
}
