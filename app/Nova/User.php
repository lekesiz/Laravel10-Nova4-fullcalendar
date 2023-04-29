<?php

namespace App\Nova;

use Laravel\Nova\Panel;
use Eminiarts\Tabs\Tabs;
use Illuminate\Support\Str;
use Laravel\Nova\Fields\ID;
use Illuminate\Http\Request;
use Laravel\Nova\Fields\Text;
use Laravel\Nova\Fields\Color;
use Laravel\Nova\Fields\Avatar;
use Illuminate\Validation\Rules;
use Laravel\Nova\Fields\Boolean;
use Laravel\Nova\Fields\HasMany;
use Laravel\Nova\Fields\Gravatar;
use Laravel\Nova\Fields\Password;
use Laravel\Nova\Fields\Textarea;
use Eminiarts\Tabs\Traits\HasTabs;
use Laravel\Nova\Fields\BelongsTo;
use Laravel\Nova\Fields\BelongsToMany;
use Trin4ik\NovaSwitcher\NovaSwitcher;
use Laravel\Nova\Http\Requests\NovaRequest;

class User extends Resource
{
    use HasTabs;
    
    public static function label()
    {
        return __('Utilisateurs');
    }
    public static function singularLabel()
    {
        return __('Utilisateur');
    }

    // 
    public static function newModel()
    {
        $model = new static::$model;
        $model::creating(function ($user) {
            $user->username = $user->name . $user->last_name;
        });
        $model::updating(function ($user) {
            $user->username = $user->name . $user->last_name;
        });
        return $model;
    }

    /**
     * The model the resource corresponds to.
     *
     * @var class-string<\App\Models\User>
     */
    public static $model = \App\Models\User::class;

    /**
     * The single value that should be used to represent the resource when being displayed.
     *
     * @var string
     */
    public static $title = 'username';

    // public function title() {
    //     return $this->name . ' ' . $this->last_name;
    // }    
    // public function subtitle() {
    //     return $this->email;
    // }

    /**
     * The columns that should be searched.
     *
     * @var array
     */
    public static $search = [
        'id', 'name', 'email', 'last_name', 'username'
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
            Avatar::make('Avatar'),
            BelongsTo::make('Role')
                ->size('w-1/4')
                ->canSee(function ($request) {
                    return $request->user()->is_admin;
                }),
            NovaSwitcher::make('Actif/Passif', 'is_active')
                ->size('w-1/4')
                ->canSee(function ($request) {
                    return $request->user()->is_admin;
                }),
            NovaSwitcher::make('Administrateur', 'is_admin')
                ->size('w-1/4')
                ->canSee(function ($request) {
                    return $request->user()->is_admin;
                }),
            Color::make('Couleur', 'color')
                ->nullable()
                ->size('w-1/4')
                ->canSee(function ($request) {
                    return $request->user()->is_admin;
                }),
            Text::make('Utilisateur', 'username')
                ->nullable()
                ->sortable()
                ->size('w-1/4'),
            Text::make('Nom', 'name')
                ->sortable()
                ->rules('required', 'max:255')
                ->size('w-1/4'),
            Text::make('Prénom', 'last_name')
                ->sortable()
                ->rules('required', 'max:255')
                ->size('w-1/4'),
            Text::make('Mobile')
                ->nullable()
                ->size('w-1/4'),
            Text::make('Adresse', 'addresse')
                ->nullable()
                ->hideFromIndex()
                ->size('w-1/4'),
            Text::make('Email')
                ->sortable()
                ->rules('required', 'email', 'max:254')
                ->creationRules('unique:users,email')
                ->updateRules('unique:users,email,{{resourceId}}')
                ->size('w-1/4'),
            Password::make('Password')
                ->onlyOnForms()
                ->creationRules('required', Rules\Password::defaults())
                ->updateRules('nullable', Rules\Password::defaults())
                ->size('w-1/4'),
            Text::make('N° SS', 'nir')
                ->nullable()
                ->hideFromIndex()
                ->size('w-1/4'),
            Text::make('Dernière connexion', 'last_activity')
                ->size('w-1/4')
                ->canSee(function ($request) {
                    return $request->user()->is_admin;
                }),
            Textarea::make('Note')
                ->nullable()
                ->canSee(function ($request) {
                    return $request->user()->is_admin;
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
