<?php

namespace App\Services;

use App\Models\Numerator;

class NumeratorManager
{
    public function getNextNumberForModel(string $model)
    {
        $numerator = Numerator::where('model', $model)->first();

        if (!$numerator) {
            throw new Exception("Numerator not found for model {$model}");
        }

        return $numerator->next_number;
    }

    public function incrementNumberForModel(string $model)
    {
        $numerator = Numerator::where('model', $model)->first();

        if (!$numerator) {
            throw new Exception("Numerator not found for model {$model}");
        }

        $numerator->update(['next_number' => $numerator->next_number + 1]);
    }

    public function formatNumberForModel(string $model, int $number)
    {
        $numerator = Numerator::where('model', $model)->first();

        if (!$numerator) {
            throw new Exception("Numerator not found for model {$model}");
        }

        $formattedNumber = '';

        if ($numerator->prefix) {
            $formattedNumber .= $numerator->prefix;
        }

        if ($numerator->date_format) {
            $formattedNumber .= date($numerator->date_format);
        }

        $formattedNumber .= $number;

        if ($numerator->suffix) {
            $formattedNumber .= $numerator->suffix;
        }

        return $formattedNumber;
    }
}
