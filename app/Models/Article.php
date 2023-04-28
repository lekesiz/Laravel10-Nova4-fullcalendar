<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Article extends Model
{
    use HasFactory;

    protected $fillable = [
        'reference',
        'designation',
        'type',
        'category',
        'unit',
        'purchase_price',
        'coefficient',
        'selling_price',
        'vat_rate',
        'price_including_tax',
        'margin',
        'margin_rate',
        'description',
    ];

    public function supplier() {
        return $this->belongsTo(Supplier::class);
    }
    public function quotes() {
        return $this->belongsToMany(Quote::class, 'quote_article')->withPivot('quantity'); 
    }
}
