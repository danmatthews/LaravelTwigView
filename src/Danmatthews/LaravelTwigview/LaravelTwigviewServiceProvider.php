<?php namespace Danmatthews\LaravelTwigview;

use Illuminate\Support\ServiceProvider;

class LaravelTwigviewServiceProvider extends ServiceProvider
{
    /**
     * Indicates if loading of the provider is deferred.
     *
     * @var bool
     */
    protected $defer = false;

    /**
     * Bootstrap the application events.
     *
     * @return void
     */
    public function boot()
    {
        $this->package('danmatthews/laravel-twigview');
        $app = $this->app;
        $this->app['view']->addExtension(
            'twig',
            'twig',
            function () use ($app) {
                return new Engines\LaravelTwigViewEngine($app);
            }
        );
    }

    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register()
    {
    }
}
