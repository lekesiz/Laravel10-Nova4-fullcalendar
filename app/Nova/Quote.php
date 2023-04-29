<?php

namespace App\Nova;

use App\Nova\Actions\PdfQuote;
use Illuminate\Support\Str;
use Laravel\Nova\Fields\ID;
use Illuminate\Http\Request;
use Laravel\Nova\Fields\Date;
use Laravel\Nova\Fields\Text;
use Laravel\Nova\Fields\Badge;
use Laravel\Nova\Fields\Number;
use Laravel\Nova\Fields\Select;
use Laravel\Nova\Fields\Status;
use Laravel\Nova\Fields\Boolean;
use Laravel\Nova\Fields\Currency;
use Laravel\Nova\Fields\Textarea;
use Laravel\Nova\Fields\BelongsTo;
use App\Nova\Actions\ConvertToInvoice;
use Laravel\Nova\Fields\BelongsToMany;
use Laravel\Nova\Http\Requests\NovaRequest;

class Quote extends Resource
{
    /**
     * The model the resource corresponds to.
     *
     * @var class-string<\App\Models\Quote>
     */
    public static $model = \App\Models\Quote::class;

    public static $displayInNavigation = false;

    public static function label() {
        return __('Devis');
    }
    public static function singularLabel() {
        return __('Devis');
    }

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
            Date::make('Date de création', 'created_at')
                ->size('w-1/2')
                ->sortable()
                ->hideWhenCreating()
                ->hideWhenUpdating(),
            Text::make('Référence', 'reference')
                ->size('w-1/2')
                ->sortable()
                ->hideWhenCreating()
                ->hideWhenUpdating(),
            BelongsTo::make('Client', 'client', Client::class)
                ->size('w-1/3')
                ->searchable(),
            Text::make('Objet', 'object')
                ->size('w-1/3')
                ->hideFromIndex()
                ->nullable(),
            Select::make('Statut', 'status')
                ->size('w-1/3')
                ->sortable()
                ->options([
                    'Crée' => 'Crée',
                    'Facturé' => 'Facturé',
                    'En retard' => 'En retard',
                    'Annulé' => 'Annulé',
                ])
                ->default('Crée'),
            Textarea::make('Notes', 'notes')
                ->alwaysShow()
                ->nullable(),
            Text::make('Total HT', function () {
                    return number_format($this->total_ht, 2, ',', ' ') . ' €';
                })
                    ->size('w-1/2')
                    ->sortable(),
            Text::make('Total TTC', function () {
                    return number_format($this->total_ttc, 2, ',', ' ') . ' €';
                })
                    ->size('w-1/2')
                    ->sortable(),
            BelongsToMany::make('Articles', 'articles', Article::class)
                ->searchable()
                ->fields(function () {
                    return [
                        Number::make('Quantité', 'quantity')
                        ->min(1)
                        ->default(1)
                        ->step(0.01)
                        ->sortable(),
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
        return [
            new PdfQuote,
            new ConvertToInvoice,
        ];
    }
}
