<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ClientDocument extends Model
{
    use HasFactory;

    protected $fillable = [
        'client_id', 'name', 'document'
    ];

    public function client() {
        return $this->belongsTo(Client::class);
    }
}
