<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Quote extends Model
{
    use HasFactory;

    protected $fillable = [
        'reference', 'type', 'client_id', 'billing_address', 'intervention_address',
        'responsible', 'contact', 'object', 'creation_date', 'due_date',
        'automatic_advance_payment_calculation', 'percentage', 'amount_ttc',
        'payment_terms', 'notes', 'history', 'status', 'total_ht', 'total_ttc',
    ];

    public function client() {
        return $this->belongsTo(Client::class);
    }

    public function articles() {
        return $this->belongsToMany(Article::class, 'quote_article')->withPivot('quantity');
    }
}
