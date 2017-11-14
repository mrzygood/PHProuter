<?php

namespace PHProuter;

use PHProuter\Route;

class RouteCollection
{

    /** @var array Collection of routes. */
    private $routes;

    /**
     * Add route to collection.
     *
     * @param \PHProuter\Route $route
     */
    public function add(Route $route)
    {
        $this->routes[] = $route;
    }

    /**
     * If route is defined will return it.
     *
     * @param string $uri
     * @param string $request_method
     * @return bool|mixed
     */
    public function getRoute(string $uri, string $request_method)
    {

        foreach($this->routes as $route)
        {
            if(preg_match($route->getUriPattern(), $uri) && $route->getRequestMethod() === $request_method)
            {
                return $route;
            }
        }

        return false;
    }

    /**
     * Return whole route collection
     *
     * @return array
     */
    public function getRoutes() : array
    {
        return $this->routes;
    }



}