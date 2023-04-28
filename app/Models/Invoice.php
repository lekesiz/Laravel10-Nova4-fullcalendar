<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Invoice extends Model
{
    use HasFactory;

    protected $fillable = [
        'reference', 'client_id', 'object', 'notes', 'status', 'total_ht', 'total_ttc',
    ];

    public function client() {
        return $this->belongsTo(Client::class);
    }

    public function articles() {
        return $this->belongsToMany(Article::class, 'invoice_article')->withPivot('quantity');
    }

    public function payments()
    {
        return $this->hasMany(Payment::class);
    }

    public function getTotalHtAttribute() {
        $total_ht = 0;
        foreach ($this->articles as $article) {
            $quantity = $article->pivot->quantity;
            $price = $article->selling_price;
            $total_ht += $quantity * $price;
        }
        return $total_ht;
    }
    
    public function getTotalTtcAttribute() {
        $total_ttc = 0;
        foreach ($this->articles as $article) {
            $quantity = $article->pivot->quantity;
            $price_ttc = $article->price_including_tax;
            $total_ttc += $quantity * $price_ttc;
        }
        return $total_ttc;
    }
}
