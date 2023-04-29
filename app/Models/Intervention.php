<?php

namespace App\Models;

use App\Services\NumeratorManager;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Intervention extends Model
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
