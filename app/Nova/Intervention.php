<?php

namespace App\Nova;

use Laravel\Nova\Fields\ID;
use Illuminate\Http\Request;
use Laravel\Nova\Fields\Date;
use Laravel\Nova\Fields\Text;
use Laravel\Nova\Fields\Number;
use Laravel\Nova\Fields\Select;
use Laravel\Nova\Fields\Textarea;
use Laravel\Nova\Fields\BelongsTo;
use Laravel\Nova\Fields\BelongsToMany;
use Laravel\Nova\Http\Requests\NovaRequest;

class Intervention extends Resource
{
    /**
     * The model the resource corresponds to.
     *
     * @var class-string<\App\Models\Intervention>
     */
    public static $model = \App\Models\Intervention::class;

    public static $displayInNavigation = false;

    /**
     * The single value that should be used to represent the resource when being displayed.
     *
     * @var string
     */
    public static $title = 'reference';

    /**
     * The columns that should be searched.
     *
     * @var array
     */
    public static $search = [
        'reference',
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
            Select::make('Type', 'type')
                ->options([
                    'Planifiée' => 'Planifiée',
                    'En retard' => 'En retard',
                    'Annulée' => 'Annulée',
                    'Complété' => 'Complété',
                ])
                ->sortable()
                ->rules('required')
                ->size('w-1/3'),
            BelongsTo::make('Client', 'client', Client::class)
                ->size('w-1/3')
                ->searchable(),
            Text::make('Objet', 'subject')
                ->sortable()
                ->nullable()
                ->size('w-1/3'),
            Date::make('Date de début', 'start_date')
                ->sortable()
                ->nullable()
                ->size('w-1/3'),
            Date::make('Date de fin', 'end_date')
                ->sortable()
                ->nullable()
                ->size('w-1/3'),
            Number::make('Nombre des Déplacements', 'number_of_trips')
                ->nullable()
                ->sortable()
                ->hideFromIndex()
                ->size('w-1/3'),
            Textarea::make("Adresse d'intervention", 'intervention_address')
                ->alwaysShow()
                ->nullable()
                ->sortable()
                ->size('w-1/3'),
            Textarea::make('Note adresse', 'address_note')
                ->alwaysShow()
                ->nullable()
                ->size('w-1/3'),
            Textarea::make('Rapport', 'report')
                ->alwaysShow()
                ->nullable()
                ->size('w-1/3'),
            BelongsTo::make('Techniciens', 'technician', User::class)
                ->searchable()
                ->size('w-1/3'),
            Text::make('Référence', 'reference')
                ->sortable()
                ->size('w-1/3')
                ->hideWhenCreating()
                ->hideWhenUpdating(),
            ID::make('Gestion interventions', 'id')
                ->sortable()
                ->hideFromIndex()
                ->size('w-1/3'),
            BelongsToMany::make('Articles', 'articles', Article::class)
                ->searchable()
                ->fields(function () {
                    return [
                        Number::make('Quantité', 'quantity')->min(1)->default(1),
                    ];
                }),
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
