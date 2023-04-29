<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ClientAddress extends Model
{
    use HasFactory;

    protected static function boot()
    {
        parent::boot();

        static::creating(function (ClientAddress $clientAddress) {
            if ($clientAddress->billing_address) {
                ClientAddress::where('client_id', $clientAddress->client_id)
                    ->where('billing_address', 1)
                    ->update(['billing_address' => 0]);
            }
        });

        static::updating(function (ClientAddress $clientAddress) {
            if ($clientAddress->isDirty('billing_address') && $clientAddress->billing_address) {
                ClientAddress::where('id', '!=', $clientAddress->id)
                    ->where('client_id', $clientAddress->client_id)
                    ->where('billing_address', 1)
                    ->update(['billing_address' => 0]);
            }
        });
    }

    protected $fillable = [
        'client_id', 'designation', 'address', 'address_complement', 'postal_code', 'city', 'department', 'country', 'note', 'billing_address'
    ];

    public function client() {
        return $this->belongsTo(Client::class);
    }
}
