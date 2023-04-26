<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Intervention extends Model
{
    use HasFactory;

    protected $casts = [
        'start_date' => 'date',
        'end_date' => 'date',
    ];

    protected $fillable = [
        'reference', 'type', 'client_id', 'intervention_address', 'number_of_trips', 'start_date', 'end_date', 'address_note', 'subject', 'report', 'technician_id'
    ];

    public function client() {
        return $this->belongsTo(Client::class);
    }
    public function technician() {
        return $this->belongsTo(User::class, 'technician_id');
    }
    public function articles()
    {
        return $this->belongsToMany(Article::class, 'article_intervention')->withPivot('quantity');
    }
}
