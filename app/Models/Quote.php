<?php

namespace App\Models;

use App\Services\NumeratorManager;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Quote extends Model
{
    use HasFactory;

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($model) {
            $numeratorManager = new NumeratorManager();
            $nextNumber = $numeratorManager->getNextNumberForModel(get_class($model));
            $formattedNumber = $numeratorManager->formatNumberForModel(get_class($model), $nextNumber);

            $model->reference = $formattedNumber;
            $numeratorManager->incrementNumberForModel(get_class($model));
            $model->total_ht = 0;
            $model->total_ttc = 0;
        });
    }

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
