<?php

namespace App\Models;

use App\Services\NumeratorManager;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Article extends Model
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
        });
    }

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
