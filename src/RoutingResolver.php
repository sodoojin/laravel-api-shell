<?php

namespace Visualplus\LaravelApiShell;


use Illuminate\Routing\Router;

class RoutingResolver
{
    /**
     * @var array
     */
    private $paths = [];

    /**
     * RouteParser constructor.
     * @param Router $router
     */
    public function __construct(Router $router)
    {
        $routes = $router->getRoutes()->getRoutes();

        foreach ($routes as $route) {
            $action = $route->getAction();

            if (! $action['uses'] instanceof \Closure) {
                $this->addPath($route->uri, $route->methods);
            }
        }
    }

    /**
     * @param $uri
     * @param array $methods
     */
    private function addPath($uri, array $methods)
    {
        $path = [
            'methods' => $methods
        ];

        foreach (array_reverse(explode('/', $uri)) as $u) {
            $path = [
                $u => $path
            ];
        }

        $this->paths = array_merge_recursive($path, $this->paths);
    }

    /**
     * @return array
     */
    public function getPaths()
    {
        return $this->paths;
    }
}