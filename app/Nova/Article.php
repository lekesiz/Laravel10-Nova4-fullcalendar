<?php

namespace App\Nova;

use Laravel\Nova\Fields\ID;
use Illuminate\Http\Request;
use Laravel\Nova\Fields\Date;
use Laravel\Nova\Fields\Text;
use Laravel\Nova\Fields\Badge;
use Laravel\Nova\Fields\Number;
use Laravel\Nova\Fields\Select;
use Laravel\Nova\Fields\Currency;
use Laravel\Nova\Fields\DateTime;
use Laravel\Nova\Fields\Textarea;
use Laravel\Nova\Fields\BelongsTo;
use Laravel\Nova\Http\Requests\NovaRequest;

class Article extends Resource
{

    public static function newModel()
    {
        $model = new static::$model;
        $model::creating(function ($article) {
            $article->price_including_tax = $article->selling_price * ( 1 + $article->vat_rate / 100 );
            $article->margin = $article->selling_price - $article->purchase_price;
            $article->margin_rate = $article->purchase_price ? ($article->margin / $article->purchase_price) * 100 : 0;
        });
        $model::updating(function ($article) {
            $article->price_including_tax = $article->selling_price * ( 1 + $article->vat_rate / 100 );
            $article->margin = $article->selling_price - $article->purchase_price;
            $article->margin_rate = $article->purchase_price ? ($article->margin / $article->purchase_price) * 100 : 0;
        });
        return $model;
    }

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
    public static $title = 'designation';

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
                ->rules('required', 'max:255')
                ->sortable(),
            Select::make(__('Type'), 'type')
                ->size('w-1/3')
                ->options([
                    'Fourniture' => 'Fourniture',
                    'Main d\'oeuvre' => 'Main d\'oeuvre',
                    'Sous-traitance' => 'Sous-traitance',
                ])
                ->sortable()
                ->rules('required', 'max:255'),            
            Select::make('Catégorie', 'category')
                ->size('w-1/3')
                ->options([
                    'Produit fini' => 'Produit fini',
                    'Marchandise' => 'Marchandise',
                    'Services' => 'Services',
                    'Main d\'oeuvre' => 'Main d\'oeuvre',
                ])
                ->sortable()
                ->rules('required', 'max:255'),
            Select::make('Unité', 'unit')
                ->size('w-1/3')
                ->options([
                    'Lot' => 'Lot',
                    'Forfait' => 'Forfait',
                    'h' => 'h',
                    'mL' => 'mL',
                    'U' => 'U',
                    'F' => 'F',
                    'ENS' => 'ENS',
                    'm2' => 'm2',
                    'kg' => 'kg',
                    'g' => 'g',
                    'L' => 'L',
                    'm' => 'm',
                    'cm' => 'cm',
                    'mm' => 'mm',
                ])
                ->sortable()
                ->hideFromIndex()
                ->rules('required', 'max:255'),
            Currency::make('Prix d\'achat', 'purchase_price')
                ->size('w-1/3')
                ->sortable()
                ->hideFromIndex()
                ->rules('required'),
            Number::make('Coefficient')
                ->size('w-1/3')
                ->hideFromIndex()
                ->default(0)
                ->sortable(),
            Currency::make('Prix de vente HT', 'selling_price')
                ->size('w-1/3')
                ->sortable()
                ->rules('required'),
            Number::make('Taux de TVA %', 'vat_rate')
                ->size('w-1/3')
                ->step(0.01)
                ->sortable()
                ->rules('required'),
            Currency::make('Prix TTC', 'price_including_tax')
                ->hideWhenUpdating()
                ->hideWhenCreating()
                ->size('w-1/3')
                ->default(0)
                ->sortable(),
            Currency::make('Marge', 'margin')
                ->hideWhenUpdating()
                ->hideWhenCreating()
                ->size('w-1/3')
                ->hideFromIndex()
                ->default(0)
                ->sortable(),
            Number::make('Taux de marge %', 'margin_rate')
                ->hideWhenUpdating()
                ->hideWhenCreating()
                ->size('w-1/3')
                ->hideFromIndex()
                ->default(0)
                ->sortable(),
            Text::make('Reference')
                ->size('w-1/3')
                ->sortable()
                ->default(function () {
                    return substr(str_shuffle(str_repeat('0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ', 8)), 0, 8);
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
