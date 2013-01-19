<?php namespace Danmatthews\LaravelTwigView\Engines;

use Twig_Loader_Filesystem;
use Twig_Environment;
use Twig_SimpleFunction;
use Danmatthews\LaravelTwigview\Loaders\LaravelTwigLoader;

class LaravelTwigViewEngine implements \Illuminate\View\Engines\EngineInterface {

	/**
	 * Store the application instance.
	 * @var object
	 */
	public $app;

	public function __construct($app) {
		$this->app = $app;
	}

	/**
	 * Get the evaluated contents of the view.
	 *
	 * @param  string  $path
	 * @param  array   $data
	 * @return string
	 */
	public function get($path, array $data = array())
	{
		// Get the directory name for this template.
		$viewdir = dirname($path);

		// Get the path to JUST the template.
		$path = str_replace($viewdir.'/', '', $path);

		// Create a loader for this template.
		$loader = new Twig_Loader_Filesystem($viewdir);

		// Load an environment object for this loader.
		$twig = new Twig_Environment($loader, array(
		   'cache' => base_path().'/app/storage/views',
		   'autoescape' => false,
		   'auto_reload' => true,
	    ));

		// Add the url() function as the base method.
		$twig->addFunction(new Twig_SimpleFunction('url', 'URL::to'));

		// Add the asset() function for templates.
		$twig->addFunction(new Twig_SimpleFunction('asset', 'URL::asset'));

		// Render and return the file.
		return $twig->render($path, $data);
	}

}
