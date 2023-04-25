<?php

namespace App\Nova;

use Laravel\Nova\Fields\ID;
use Illuminate\Http\Request;
use Laravel\Nova\Fields\Date;
use Laravel\Nova\Fields\Text;
use Laravel\Nova\Fields\Number;
use Laravel\Nova\Fields\Select;
use Laravel\Nova\Fields\Boolean;
use Laravel\Nova\Fields\DateTime;
use Laravel\Nova\Fields\Textarea;
use Laravel\Nova\Fields\BelongsTo;
use Laravel\Nova\Http\Requests\NovaRequest;

class Task extends Resource
{
    /**
     * The model the resource corresponds to.
     *
     * @var class-string<\App\Models\Task>
     */
    public static $model = \App\Models\Task::class;

    // menuden kaldirmak icin
    public static $displayInNavigation = false;

    /**
     * The single value that should be used to represent the resource when being displayed.
     *
     * @var string
     */
    public static $title = 'title';

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

            Text::make(__('Titre'), 'title')
                ->sortable()
                ->rules('required', 'max:255'),

            Text::make(__('Type'), 'type')
                ->sortable()
                ->rules('required', 'max:255'),

            BelongsTo::make(__('Client'), 'client', Client::class)
                ->searchable()
                ->sortable()
                ->rules('required'),

            BelongsTo::make(__('Technicien'), 'user', User::class)
                ->searchable()
                ->sortable()
                ->rules('required'),

            DateTime::make(__('Date de debut'), 'start_date')
                ->sortable()
                ->rules('required'),

            Select::make(__('Statut'), 'status')
                ->options([
                    'ouvert' => 'Ouvert',
                    'en_cours' => 'En cours',
                    'termine' => 'Terminé',
                    'ferme' => 'Fermé',
                ])
                ->sortable()
                ->rules('required'),

            Number::make(__('Duree'), 'duration')
                ->sortable()
                ->nullable(),

            Boolean::make(__('Mobile'), 'mobile')
                ->sortable(),

            Textarea::make(__('Description'), 'description')
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

    public static function redirectAfterCreate(NovaRequest $request, $resource)
    {
        return '/calendar';
    }

    public static function redirectAfterUpdate(NovaRequest $request, $resource)
    {
        return '/calendar';
    }
}
