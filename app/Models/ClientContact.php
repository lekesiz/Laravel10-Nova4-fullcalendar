<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ClientContact extends Model
{
    use HasFactory;

    protected $fillable = [
        'client_id', 'civility', 'last_name', 'first_name', 'position', 'email', 'mobile_phone', 'landline_phone', 'comment'
    ];

    public function client() {
        return $this->belongsTo(Client::class);
    }
}
