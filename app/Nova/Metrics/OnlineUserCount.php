<?php

namespace App\Nova\Metrics;

use Laravel\Nova\Http\Requests\NovaRequest;
use Laravel\Nova\Metrics\ValueResult;
use Laravel\Nova\Metrics\Value;
use App\Models\User;
use Carbon\Carbon;

class OnlineUserCount extends Value
{

    public function name()
    {
        return 'Utilisateurs en ligne';
    }

    public function calculate(NovaRequest $request)
    {
        return $this->result(
            User::where('last_activity', '>', Carbon::now()->subMinutes(10))->count()
        );
    }

    public function range()
    {
        return 'TODAY';
    }

    public function uriKey()
    {
        return 'online-user-count';
    }
}
