<?php

namespace App\Nova;

use Laravel\Nova\Fields\ID;
use Illuminate\Http\Request;
use Laravel\Nova\Fields\Text;
use Laravel\Nova\Fields\Boolean;
use Laravel\Nova\Fields\HasMany;
use Laravel\Nova\Fields\Textarea;
use Laravel\Nova\Fields\BelongsTo;
use Laravel\Nova\Http\Requests\NovaRequest;

class ClientAddress extends Resource
{

    public static function label() {
        return __('Adresse du client');
    }

    public static function singularLabel() {
        return __('Adresse du client');
    }

    // menuden kaldirmak icin
    public static $displayInNavigation = false;
    
    /**
     * The model the resource corresponds to.
     *
     * @var class-string<\App\Models\ClientAddress>
     */
    public static $model = \App\Models\ClientAddress::class;

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
            ID::make()->sortable(),

            BelongsTo::make(__('Client'), 'client', Client::class)->sortable(),

            Text::make(__('Désignation'), 'designation')
                ->sortable()
                ->rules('required'),

            Textarea::make(__('Adresse'), 'address')
                ->alwaysShow()
                ->sortable()
                ->rules('required'),

            Textarea::make(__('Complément d\'adresse'), 'address_complement')
                ->sortable()
                ->nullable(),

            Text::make(__('Code Postal'), 'postal_code')
                ->sortable()
                ->rules('required'),

            Text::make(__('Ville'), 'city')
                ->sortable()
                ->rules('required'),

            Text::make(__('Département'), 'department')
                ->sortable()
                ->nullable(),

            Text::make(__('Pays'), 'country')
                ->sortable()
                ->rules('required')
                ->default(function () {
                    return 'France';
                }),

            Textarea::make(__('Note'), 'note')
                ->alwaysShow()
                ->sortable()
                ->nullable(),

            Boolean::make(__('Adresse de facturation'), 'billing_address')
                ->sortable(),
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
}
