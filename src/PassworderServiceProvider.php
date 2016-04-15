<?php namespace Lucasvdh\Passworder;

use Illuminate\Support\ServiceProvider;

/**
 * Credits to wingman
 */

class PassworderServiceProvider extends ServiceProvider
{

	/**
	 * Bootstrap the application services.
	 *
	 * @return void
	 */
	public function boot()
	{
		$this->publishes([
			__DIR__ . '/Config/wordset.txt' => config_path('wordset.txt'),
			__DIR__ . '/Config/passworder.php' => config_path('passworder.php'),
		], 'config');
	}

	/**
	 * Register the application services.
	 *
	 * @return void
	 */
	public function register()
	{
		# Load config
		$this->mergeConfigFrom( __DIR__ . '/Config/passworder.php', 'passworder' );

		$this->app['passworder'] = $this->app->share(function($app) {
			return new Passworder;
		});
	}
}
