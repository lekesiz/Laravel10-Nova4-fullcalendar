<?php

namespace App\Nova;

use Laravel\Nova\Fields\ID;
use Illuminate\Http\Request;
use Laravel\Nova\Fields\Text;
use Laravel\Nova\Fields\Number;
use Laravel\Nova\Fields\Select;
use Laravel\Nova\Http\Requests\NovaRequest;

class Numerator extends Resource
{
    /**
     * The model the resource corresponds to.
     *
     * @var class-string<\App\Models\Numerator>
     */
    public static $model = \App\Models\Numerator::class;

    /**
     * The single value that should be used to represent the resource when being displayed.
     *
     * @var string
     */
    public static $title = 'id';

    /**
     * The columns that should be searched.
     *
     * @var array
     */
    public static $search = [
        'id',
    ];

    /**
     * Get the fields displayed by the resource.
     *
     * @param  \Laravel\Nova\Http\Requests\NovaRequest  $request
     * @return array
     */
    public function fields(NovaRequest $request)
    {
        return [
            ID::make(__('ID'), 'id')->sortable(),
            Select::make(__('Model'), 'model')
                ->options([
                    'App\Models\Intervention' => 'Intervention',
                    'App\Models\Client' => 'Client',
                    'App\Models\Article' => 'Article',
                    'App\Models\CreditNote' => 'CreditNote',
                    'App\Models\Invoice' => 'Invoice',
                    'App\Models\Quote' => 'Quote',
                ])
                ->displayUsingLabels()
                ->sortable(),
            Text::make(__('Prefix'), 'prefix')->sortable()->nullable(),
            Text::make(__('Suffix'), 'suffix')->sortable()->nullable(),
            Select::make(__('Date Format'), 'date_format')
                ->options([
                    '' => 'No Date',
                    'Y-m-d-' => 'YYYY-MM-DD',
                    'Ymd-' => 'YYYYMMDD',
                    'y-m-d-' => 'YY-MM-DD',
                    'ymd-' => 'YYMMDD',
                    'd-m-Y-' => 'DD-MM-YYYY',
                ])
                ->displayUsingLabels()
                ->sortable()
                ->nullable(),
            Number::make(__('Next Number'), 'next_number')->sortable(),
        ];
    }

    /**
     * Get the cards available for the request.
     *
     * @param  \Laravel\Nova\Http\Requests\NovaRequest  $request
     * @return array
     */
    public function cards(NovaRequest $request)
    {
        return [];
    }

    /**
     * Get the filters available for the resource.
     *
     * @param  \Laravel\Nova\Http\Requests\NovaRequest  $request
     * @return array
     */
    public function filters(NovaRequest $request)
    {
        return [];
    }

    /**
     * Get the lenses available for the resource.
     *
     * @param  \Laravel\Nova\Http\Requests\NovaRequest  $request
     * @return array
     */
    public function lenses(NovaRequest $request)
    {
        return [];
    }

    /**
     * Get the actions available for the resource.
     *
     * @param  \Laravel\Nova\Http\Requests\NovaRequest  $request
     * @return array
     */
    public function actions(NovaRequest $request)
    {
        return [];
    }
    public static function authorizedToCreate(Request $request) {
        return false;
    }

    public function authorizedToUpdate(Request $request) {
        return true;
    }

    public function authorizedToDelete(Request $request) {
        return false;
    }
    public function authorizedToReplicate(Request $request) {
        return false;
    }
}
