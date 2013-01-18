<?php namespace Danmatthews\LaravelTwigView;
use Twig_Loader_String;
use Twig_Environment;
use Twig_SimpleFunction;
class LaravelTwigViewEngine implements \Illuminate\View\Engines\EngineInterface {

	/**
	 * Get the evaluated contents of the view.
	 *
	 * @param  string  $path
	 * @param  array   $data
	 * @return string
	 */
	public function get($path, array $data = array())
	{
		// Get a twig string loader.
		$loader = new Twig_Loader_String();

		// Load an environment object for this loader.
		$twig = new Twig_Environment($loader, array(
		   'cache' => base_path().'/app/storage/views',
		   'autoescape' => false,
	    ));

		// Add the url() function as the base method.
		$twig->addFunction(new Twig_SimpleFunction('url', 'URL::to'));

		// Add the asset() function for templates.
		$twig->addFunction(new Twig_SimpleFunction('asset', 'URL::asset'));

		// Render and return the file.
		return $twig->render(file_get_contents($path), $data);
	}

}
