<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

// Priveleges
use App\Http\Database\privileges as privileges;
use App\Http\Database\privileges_group as privileges_group;
use App\Http\Database\privileges_user as privileges_user;
use App\setting;

//
use Config;
use View;
use Menu;

class MenuServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {


        //$data['menu'] = Menu::get('mastermenu');
        //var_dump(View::getherData());
        Config::set('menu',Menu::get('mastermenu'));
        return View::share(['menu'=>Menu::get('mastermenu')]);

    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
