<?php

namespace App\Nova;

use Laravel\Nova\Fields\ID;
use Illuminate\Http\Request;
use Laravel\Nova\Fields\Date;
use Laravel\Nova\Fields\Text;
use Laravel\Nova\Fields\Badge;
use Laravel\Nova\Fields\Number;
use Laravel\Nova\Fields\Currency;
use Laravel\Nova\Fields\DateTime;
use Laravel\Nova\Fields\Textarea;
use Laravel\Nova\Fields\BelongsTo;
use Laravel\Nova\Http\Requests\NovaRequest;

class Article extends Resource
{
    /**
     * The model the resource corresponds to.
     *
     * @var class-string<\App\Models\Article>
     */
    public static $model = \App\Models\Article::class;

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
        'reference', 'designation'
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
            Text::make('Désignation', 'designation')
                ->size('w-1/3')
                ->sortable(),
            Text::make('Type')
                ->size('w-1/3')
                ->sortable(),
            Text::make('Catégorie', 'category')
                ->size('w-1/3')
                ->sortable(),
            Text::make('Unité', 'unit')
                ->size('w-1/3')
                ->hideFromIndex()
                ->sortable(),
            Currency::make('Prix d\'achat', 'purchase_price')
                ->size('w-1/3')
                ->default(0)
                ->sortable(),
            Number::make('Coefficient')
                ->size('w-1/3')
                ->hideFromIndex()
                ->default(0)
                ->sortable(),
            Currency::make('Prix de vente', 'selling_price')
                ->size('w-1/3')
                ->default(0)
                ->sortable(),
            Number::make('Taux de TVA', 'vat_rate')
                ->size('w-1/3')
                ->default(0)
                ->sortable(),
            Currency::make('Prix TTC', 'price_including_tax')
                ->size('w-1/3')
                ->default(0)
                ->sortable(),
            Currency::make('Marge', 'margin')
                ->size('w-1/3')
                ->hideFromIndex()
                ->default(0)
                ->sortable(),
            Number::make('Taux de marge', 'margin_rate')
                ->size('w-1/3')
                ->hideFromIndex()
                ->default(0)
                ->sortable(),
            Text::make('Reference')
                ->size('w-1/3')
                ->sortable()
                ->default(function () {
                    return substr(str_shuffle(str_repeat('0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ', 8)), 0, 8);;
                }),
            Textarea::make('Description')
                ->nullable()
                ->alwaysShow(),
            BelongsTo::make('Fournisseur', 'supplier', 'App\Nova\supplier'),
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
