<?php

namespace App\Nova;

use Laravel\Nova\Fields\ID;
use Illuminate\Http\Request;
use Laravel\Nova\Fields\URL;
use Laravel\Nova\Fields\Text;
use Laravel\Nova\Fields\Email;
use Laravel\Nova\Fields\Image;
use Illuminate\Validation\Rule;
use Laravel\Nova\Fields\Textarea;
use Laravel\Nova\Http\Requests\NovaRequest;

class Company extends Resource
{
    public static function label()
    {
        return __('Entreprise');
    }
    public static function singularLabel()
    {
        return __('Entreprise');
    }
    /**
     * The model the resource corresponds to.
     *
     * @var class-string<\App\Models\Company>
     */
    public static $model = \App\Models\Company::class;

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

            Text::make(__('Nom de l\'entreprise'), 'name')
                ->sortable()
                ->rules('required', 'max:255'),

            Text::make(__('E-mail'), 'email')
                ->sortable()
                ->rules('required', 'email', 'max:254')
                ->creationRules('unique:companies,email')
                ->updateRules('unique:companies,email,{{resourceId}}'),

            Text::make(__('Numéro de telephone'), 'phone_number')
                ->sortable()
                ->nullable(),

            URL::make(__('Site Web'), 'website')
                ->sortable()
                ->nullable(),

            Textarea::make(__('Adresse'), 'address')
                ->alwaysShow()
                ->sortable()
                ->nullable(),

            Text::make(__('Ville'), 'city')
                ->sortable()
                ->nullable(),

            Text::make(__('Code postal'), 'postal_code')
                ->sortable()
                ->nullable(),

            Text::make(__('Pays'), 'country')
                ->sortable()
                ->nullable(),

            Image::make(__('Logo'), 'logo')
                ->disk('public')
                ->nullable()
                ->prunable(),
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
