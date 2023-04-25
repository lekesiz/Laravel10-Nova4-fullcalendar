<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ClientAddress extends Model
{
    use HasFactory;

    protected $fillable = [
        'client_id', 'designation', 'address', 'address_complement', 'postal_code', 'city', 'department', 'country', 'note', 'billing_address'
    ];

    public function client() {
        return $this->belongsTo(Client::class);
    }
}
