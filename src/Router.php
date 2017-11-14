<?php

namespace PHProuter;

use PHProuter\RouteCollection;

class Router
{
    /** @var \PHProuter\RouteCollection Contain collection of defined routes. */
    private $routeCollection;

    /** @var string Path to controllers uses by path. */
    private $controllerPath = 'Controllers\\';

    /**
     * Router constructor.
     * @param \PHProuter\RouteCollection $routeCollection
     */
    public function __construct(RouteCollection $routeCollection)
    {
        $this->routeCollection = $routeCollection;
    }

    /**
     * Handling request.
     *
     * @param string $uri
     * @param string $method
     * @return mixed
     * @throws \Exception
     */
    public function direct(string $uri, string $method)
    {
        $direct_route = $this->routeCollection->getRoute($uri, $method);
        if($direct_route){
           return self::loadRouteContent($direct_route);
        } else {
            throw new \Exception('Route is not defined');
        }
    }

    /**
     * Load content defined by route.
     *
     * @param Route $route
     * @return mixed
     */
    private function loadRouteContent(Route $route)
    {
        return self::loadController($route->getController());
    }

    /**
     * Process controller and his method name so that it could be instantiated.
     *
     * @param string $controller
     * @return mixed
     */
    private function loadController(string $controller)
    {
        $exploded_controller = explode('@', $controller);

        $method_name = $exploded_controller[1] . "Action";

        $controller_path = $this->controllerPath . $exploded_controller[0];

        $controllerInstantion = new $controller_path;

        $controllerInstantionWithMethod = $controllerInstantion->{$method_name}();

        return $controllerInstantionWithMethod;
    }
}

?>