<?php namespace Bfg\ChartJs;

use Illuminate\Support\ServiceProvider;

class ChartJsServiceProvider extends ServiceProvider
{
    public function boot()
    {
        $this->loadViewsFrom(__DIR__.'/../views', 'chart-js');
    }

    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind('chartjs', function() {
            return new Builder();
        });
    }
}
