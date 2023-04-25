<?php

namespace App\Nova;

use Carbon\Carbon;
use Laravel\Nova\Fields\ID;
use Illuminate\Http\Request;
use Laravel\Nova\Fields\Text;
use Laravel\Nova\Fields\Email;
use Laravel\Nova\Fields\Number;
use Laravel\Nova\Fields\Select;
use Laravel\Nova\Fields\HasMany;
use Laravel\Nova\Fields\Textarea;
use Laravel\Nova\Fields\BelongsTo;
use Laravel\Nova\Http\Requests\NovaRequest;

class Client extends Resource
{
    /**
     * The model the resource corresponds to.
     *
     * @var class-string<\App\Models\Client>
     */
    public static $model = \App\Models\Client::class;

    /**
     * The single value that should be used to represent the resource when being displayed.
     *
     * @var string
     */
    public static $title = 'last_name';

    /**
     * The columns that should be searched.
     *
     * @var array
     */
    public static $search = [
        'id',
        'last_name',
        'first_name',
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
            ID::make()->sortable()
                ->size('w-1/3')
                ->hideFromIndex(),

            Text::make(__('Référence'), 'reference')
                ->size('w-1/3')
                ->sortable()
                ->rules('required', 'max:254')
                ->default(function () {
                    $randomString = substr(str_shuffle(str_repeat('0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ', 11)), 0, 11);
                    return Carbon::now()->format('YmdHi') . $randomString;
                }),

            Select::make(__('Type Client'), 'client_type')
                ->size('w-1/3')
                ->options([
                    'Professionnel' => 'Professionnel',
                    'Particulier' => 'Particulier',
                ])
                ->sortable()
                ->rules('required'),

            Select::make(__('Civilité'), 'civility')
                ->size('w-1/3')
                ->options([
                    'M' => 'M',
                    'Mme' => 'Mme',
                ])
                ->hideFromIndex()
                ->sortable()
                ->nullable(),

            Text::make(__('Nom'), 'last_name')
                ->size('w-1/3')
                ->sortable()
                ->rules('required', 'max:255'),

            Text::make(__('Prénom'), 'first_name')
                ->size('w-1/3')
                ->sortable()
                ->rules('required', 'max:255'),

            Email::make(__('Email'), 'email')
                ->size('w-1/3')
                ->sortable()
                ->rules('required', 'email', 'max:254')
                ->creationRules('unique:clients,email')
                ->updateRules('unique:clients,email,{{resourceId}}'),

            Text::make(__('N° Mobile'), 'mobile_phone')
                ->size('w-1/3')
                ->sortable()
                ->nullable(),

            Text::make(__('N° fixe'), 'landline_phone')
                ->size('w-1/3')
                ->sortable()
                ->nullable(),

            Text::make(__('Code comptable'), 'accounting_code')
                ->size('w-1/3')
                ->hideFromIndex()
                ->sortable()
                ->nullable(),

            Number::make(__('Délai de paiement'), 'payment_deadline')
                ->size('w-1/3')
                ->hideFromIndex()
                ->sortable()
                ->nullable(),

            Number::make(__('Remise'), 'discount')
                ->size('w-1/3')
                ->hideFromIndex()
                ->sortable()
                ->nullable(),

            Text::make(__('Site Web'), 'website')
                ->size('w-1/3')
                ->hideFromIndex()
                ->sortable()
                ->nullable(),

            Text::make(__('Siret'), 'siret')
                ->size('w-1/3')
                ->hideFromIndex()
                ->sortable()
                ->nullable(),

            Text::make(__('TVA'), 'vat')
                ->size('w-1/3')
                ->hideFromIndex()
                ->sortable()
                ->nullable(),

            Textarea::make(__('Conditions de règlement'), 'payment_conditions')
                ->alwaysShow()
                ->size('w-1/2')
                ->hideFromIndex()
                ->sortable()
                ->nullable(),

            Textarea::make(__('Notes'), 'notes')
                ->alwaysShow()
                ->size('w-1/2')
                ->hideFromIndex()
                ->sortable()
                ->nullable(),

            HasMany::make(__('Adresse du client'), 'ClientAddress', ClientAddress::class),
            HasMany::make(__('Contact du client'), 'ClientContact', ClientContact::class),
            HasMany::make(__('Document du client'), 'ClientDocument', ClientDocument::class),
            HasMany::make(__('Tâche du client'), 'ClientTask', Task::class),
            HasMany::make(__('Note du client'), 'ClientNote', ClientNote::class),
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
