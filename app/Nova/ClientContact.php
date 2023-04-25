<?php

namespace App\Nova;

use Laravel\Nova\Fields\ID;
use Illuminate\Http\Request;
use Laravel\Nova\Fields\Text;
use Laravel\Nova\Fields\Email;
use Laravel\Nova\Fields\Select;
use Laravel\Nova\Fields\HasMany;
use Laravel\Nova\Fields\Textarea;
use Laravel\Nova\Fields\BelongsTo;
use Laravel\Nova\Http\Requests\NovaRequest;

class ClientContact extends Resource
{
    // menuden kaldirmak icin
    public static $displayInNavigation = false;
    
    /**
     * The model the resource corresponds to.
     *
     * @var class-string<\App\Models\ClientContact>
     */
    public static $model = \App\Models\ClientContact::class;

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

            Select::make(__('Civilité'), 'civility')
                ->options([
                    'M' => 'M',
                    'Mme' => 'Mme',
                ])
                ->hideFromIndex()
                ->sortable()
                ->nullable(),

            Text::make(__('Nom'), 'last_name')
                ->sortable()
                ->rules('required'),

            Text::make(__('Prénom'), 'first_name')
                ->sortable()
                ->rules('required'),

            Text::make(__('Fonction'), 'position')
                ->sortable()
                ->nullable(),

            Email::make(__('Email'), 'email')
                ->sortable()
                ->rules('required', 'email', 'max:255'),

            Text::make(__('Mobile'), 'mobile_phone')
                ->sortable()
                ->nullable(),

            Text::make(__('Fixe'), 'landline_phone')
                ->sortable()
                ->nullable(),

            Textarea::make(__('Commentaire'), 'comment')
                ->sortable()
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
}
