<?php

namespace App\Nova;

use Laravel\Nova\Fields\ID;
use Illuminate\Http\Request;
use Laravel\Nova\Fields\Code;
use Laravel\Nova\Fields\Text;
use Laravel\Nova\Fields\DateTime;
use Laravel\Nova\Fields\BelongsTo;
use Laravel\Nova\Actions\ActionEvent;
use Laravel\Nova\Http\Requests\NovaRequest;

class Log extends Resource
{
    public static $model = ActionEvent::class;

    public static $title = 'name';

    public static $search = [
        'id', 'name', 'actionable_type', 'target_type', 'model_type',
    ];

    public function fields(Request $request)
    {
        return [
            ID::make()->sortable(),
            Text::make('Batch ID')->sortable()->hideFromIndex(),
            BelongsTo::make('User', 'user', User::class)
                ->sortable()
                ->rules('required'),
            Text::make('Name')
                ->sortable(),
            Text::make('Actionable Type')->sortable(),
            Text::make('Actionable ID')->sortable()->hideFromIndex(),
            Text::make('Target Type')->sortable()->hideFromIndex(),
            Text::make('Target ID')->sortable()->hideFromIndex(),
            Text::make('Model Type')->sortable()->hideFromIndex(),
            Text::make('Model ID')->sortable()->hideFromIndex(),
            Code::make('Fields')
                ->json()
                ->nullable()
                ->resolveUsing(function ($value) {
                    return json_encode($value);
                }),
            Text::make('Status')->sortable(),
            Code::make('Exception')
                ->json()
                ->nullable()
                ->resolveUsing(function ($value) {
                    return json_encode($value);
                }),
            DateTime::make('Created At')->sortable(),
            DateTime::make('Updated At')->sortable(),
            Code::make('Original')
                ->json()
                ->nullable()
                ->resolveUsing(function ($value) {
                    return json_encode($value);
                }),

            Code::make('Changes')
                ->json()
                ->nullable()
                ->resolveUsing(function ($value) {
                    return json_encode($value);
                }),
        ];
    }
    public static function authorizedToCreate(Request $request) {
        return false;
    }

    public function authorizedToUpdate(Request $request) {
        return false;
    }

    public function authorizedToDelete(Request $request) {
        return false;
    }
    public function authorizedToReplicate(Request $request) {
        return false;
    }
}