<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Quote extends Model
{
    use HasFactory;

    protected $fillable = [
        'reference', 'client_id', 'object', 'notes', 'status', 'total_ht', 'total_ttc',
    ];

    public function client() {
        return $this->belongsTo(Client::class);
    }

    public function articles() {
        return $this->belongsToMany(Article::class, 'quote_article')->withPivot('quantity');
    }

    public function getTotalHtAttribute() {
        $total_ht = 0;
        foreach ($this->articles as $article) {
            // \Log::info("Article: " . json_encode($article));
            $quantity = $article->pivot->quantity;
            $price = $article->selling_price;
            $total_ht += $quantity * $price;
            // \Log::info("Quantity: {$quantity}, Price: {$price}, Total HT: {$total_ht}");
        }
        return $total_ht;
    }
    
    public function getTotalTtcAttribute() {
        $total_ttc = 0;
        foreach ($this->articles as $article) {
            // \Log::info("Article: " . json_encode($article));
            $quantity = $article->pivot->quantity;
            $price_ttc = $article->price_including_tax;
            $total_ttc += $quantity * $price_ttc;
            // \Log::info("Quantity: {$quantity}, Price TTC: {$price_ttc}, Total TTC: {$total_ttc}");
        }
        return $total_ttc;
    }
}
