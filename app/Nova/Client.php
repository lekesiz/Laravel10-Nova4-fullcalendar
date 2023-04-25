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
                ->hideFromIndex(),

            Text::make(__('Référence'), 'reference')
                ->sortable()
                ->rules('required', 'max:254')
                ->default(function () {
                    return Carbon::now()->format('YmdHi');
                }),

            Select::make(__('Type Client'), 'client_type')
                ->options([
                    'Professionnel' => 'Professionnel',
                    'Particulier' => 'Particulier',
                ])
                ->sortable()
                ->rules('required'),

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
                ->rules('required', 'max:255'),

            Text::make(__('Prénom'), 'first_name')
                ->sortable()
                ->rules('required', 'max:255'),

            Email::make(__('Email'), 'email')
                ->sortable()
                ->rules('required', 'email', 'max:254')
                ->creationRules('unique:clients,email')
                ->updateRules('unique:clients,email,{{resourceId}}'),

            Text::make(__('N° Mobile'), 'mobile_phone')
                ->sortable()
                ->nullable(),

            Text::make(__('N° fixe'), 'landline_phone')
                ->sortable()
                ->nullable(),

            Text::make(__('Code comptable'), 'accounting_code')
                ->hideFromIndex()
                ->sortable()
                ->nullable(),

            Number::make(__('Délai de paiement'), 'payment_deadline')
                ->hideFromIndex()
                ->sortable()
                ->nullable(),

            Number::make(__('Remise'), 'discount')
                ->hideFromIndex()
                ->sortable()
                ->nullable(),

            Text::make(__('Site Web'), 'website')
                ->hideFromIndex()
                ->sortable()
                ->nullable(),

            Text::make(__('Siret'), 'siret')
                ->hideFromIndex()
                ->sortable()
                ->nullable(),

            Text::make(__('TVA'), 'vat')
                ->hideFromIndex()
                ->sortable()
                ->nullable(),

            Textarea::make(__('Conditions de règlement'), 'payment_conditions')
                ->hideFromIndex()
                ->sortable()
                ->nullable(),

            Textarea::make(__('Notes'), 'notes')
                ->hideFromIndex()
                ->sortable()
                ->nullable(),

            HasMany::make(__('Adresse du client'), 'ClientAddress', ClientAddress::class),
            HasMany::make(__('Contact du client'), 'ClientContact', ClientContact::class),
            HasMany::make(__('Document du client'), 'ClientDocument', ClientDocument::class),
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
