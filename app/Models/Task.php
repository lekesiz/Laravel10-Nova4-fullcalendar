<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    use HasFactory;

    protected $fillable = [
        'title', 'type', 'client_id', 'user_id', 'start_date', 'status', 'duration', 'mobile', 'description',
    ];

    protected $casts = [
        'start_date' => 'datetime',
    ];

    public function client() {
        return $this->belongsTo(Client::class);
    }

    public function user() {
        return $this->belongsTo(User::class);
    }
}
