<?php namespace Danmatthews\LaravelTwigview\Engines;

use Twig_Loader_Filesystem;
use Twig_Environment;
use Twig_SimpleFunction;

class LaravelTwigViewEngine implements \Illuminate\View\Engines\EngineInterface
{
    /**
     * Store the application instance.
     * @var object
     */
    public $app;

    public function __construct($app)
    {
        $this->app = $app;
    }

    /**
     * Get the evaluated contents of the view.
     *
     * @param  string $path
     * @param  array  $data
     * @return string
     */
    public function get($path, array $data = array())
    {

        // Manage the transformation of errors into a handy array.
        foreach ($data['errors']->getMessages() as $key => $errors) {
            $twigErrors[$key] = new \Danmatthews\LaravelTwigView\LaravelTwigFieldErrorMessageBag($errors);
        }

        // No errors? Send the original errors variable so it's still defined.
        $data['errors'] = isset($twigErrors) > 0 ? $twigErrors : $data['errors'];

        // Get the list of view paths from the app.
        $paths = $this->app['view']->getFinder()->getPaths();

        // Sort the paths, longest first.
        usort(
            $paths,
            function ($a, $b) {
                return strlen($b)-strlen($a);
            }
        );

        // Get the directory the requested view sits in.
        $viewdir = dirname($path);

        // Match it to a view path registered in config::view.paths
        foreach ($paths as $dir) {
            if (stristr($viewdir, $dir)) {
                $path = str_replace($dir.'/', '', $path);
                break;
            }
        }

        // Create a loader for this template.
        $loader = new Twig_Loader_Filesystem($paths);

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
