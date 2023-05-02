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
    public static function label() {
        return __('Numérateurs');
    }
    public static function singularLabel() {
        return __('Numérateurs');
    }
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
            Select::make(__('Model'), 'model')
                ->options([
                    'App\Models\Intervention' => 'Intervention',
                    'App\Models\Client' => 'Client',
                    'App\Models\Article' => 'Article',
                    'App\Models\CreditNote' => 'Avoir',
                    'App\Models\Invoice' => 'Facture',
                    'App\Models\Quote' => 'Devis',
                ])
                ->displayUsingLabels()
                ->hideWhenUpdating(),
            Text::make(__('Préfixe'), 'prefix')
                ->size('w-1/4')
                ->nullable(),
            Select::make(__('Format de date'), 'date_format')
                ->size('w-1/4')
                ->options([
                    '' => 'Pas de date',
                    'Y-m-d-' => 'YYYY-MM-DD',
                    'Ymd-' => 'YYYYMMDD',
                    'y-m-d-' => 'YY-MM-DD',
                    'ymd-' => 'YYMMDD',
                    'd-m-Y-' => 'DD-MM-YYYY',
                ])
                ->displayUsingLabels()
                ->nullable(),
            Number::make(__('Numéro suivant'), 'next_number')
                ->size('w-1/4'),
            Text::make(__('Suffixe'), 'suffix')
                ->size('w-1/4')
                ->nullable(),
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
