<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class ComponentsServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
//        \Form::component('group_radio', 'components.radio', ['name', 'options', 'selected', 'attributes']);
//        \Form::component('group_checkbox', 'components.checkbox', ['name', 'options', 'selected', 'attributes', 'layout' => 'block']);
        \Form::component('switch', 'components.switch', ['name', 'value', 'checked', 'attributes']);
//        \Form::component('multiselect', 'components.multiselect', ['name', 'value', 'checked', 'attributes']);
//        \Form::component('datepicker', 'components.datepicker', ['name', 'value', 'attributes']);
//        \Form::component('icheck_radio', 'components.icheck_radio', ['name', 'options', 'checked', 'attributes']);
    }

    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
