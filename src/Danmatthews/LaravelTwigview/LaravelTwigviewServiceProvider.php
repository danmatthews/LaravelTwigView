<?php namespace Danmatthews\LaravelTwigview;

use Illuminate\Support\ServiceProvider;

class LaravelTwigviewServiceProvider extends ServiceProvider {

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
		$this->app['view']->addExtension('twig', 'twig', function()
		{
			return new Engines\LaravelTwigViewEngine($this->app);
		});
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
