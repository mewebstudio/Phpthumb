<?php namespace Mews\Phpthumb;

use Illuminate\Support\ServiceProvider;

class PhpthumbServiceProvider extends ServiceProvider {

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
		$this->package('mews/phpthumb');

		$app = $this->app;

	    $this->app->finish(function() use ($app)
	    {

	    });
	}

	/**
	 * Register the service provider.
	 *
	 * @return void
	 */
	public function register()
	{
	    $this->app['phpthumb'] = $this->app->share(function($app)
	    {
	        return new Phpthumb($app['view'], $app['config']);
	    });
	}

	/**
	 * Get the services provided by the provider.
	 *
	 * @return array
	 */
	public function provides()
	{
		return array('phpthumb');
	}

}