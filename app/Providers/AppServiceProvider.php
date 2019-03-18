<?php

namespace App\Providers;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Schema;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //
        Schema::defaultStringLength(191);
//        Model::creating(function ($model) {
//            $model->{$model->getKeyName()} = Uuid::generate(4); //Uuid::generate()->string;
//            //$model->id = (string) Uuid::generate(4);
//        });
        if(env('APP_ENV') === 'prod' || env('APP_ENV') === 'heroku'){
            $this->app['request']->server->set('HTTPS', true);
        }
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
