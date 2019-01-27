<?php
/**
 * Created by PhpStorm.
 * User: vasar
 * Date: 2019-01-27
 * Time: 23:11
 */

namespace Vasar\Weather;


class ServiceProvider extends \Illuminate\Support\ServiceProvider
{
    protected $defer = true;

    public function register()
    {
        $this->app->singleton(Weather::class, function(){
            return new Weather(config('services.weather.key'));
        });

        $this->app->alias(Weather::class, 'weather');
    }

    public function provides()
    {
        return [Weather::class, 'weather'];
    }
}