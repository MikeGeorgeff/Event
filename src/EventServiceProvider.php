<?php

namespace Georgeff\Event;

use Illuminate\Support\ServiceProvider;

class EventServiceProvider extends ServiceProvider
{
    /**
     * Indicates if loading of the provider is deferred
     *
     * @var bool
     */
    protected $defer = true;

    /**
     * Register container bindings
     *
     * @return void
     */
    public function register()
    {
        $this->app->singleton(Event::class, function ($app) {
            return new Event($app['events']);
        });
    }

    /**
     * Get the services provided
     *
     * @return array
     */
    public function provides()
    {
        return [Event::class];
    }
}