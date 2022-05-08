<?php

namespace App\Helpers;

class RoutesHelper
{
    protected $routes;

    public function __construct()
    {
        $this->routes = include CONFIG_PATH . '/routes.php';
    }

    public function show404()
    {
        $this->handle(true);
    }

    /**
     * Handle the request processing for the application.
     *
     * @return void
     */
    public function handle($is404 = false)
    {
        # get request path
        $requestPath = $_SERVER['REQUEST_URI'];

        // get request method
        $requestMethod = $_SERVER['REQUEST_METHOD'];

        // call the route
        $routes = $this->routes[$requestMethod];

        if (array_key_exists($requestPath, $routes)) {
            $route = $routes[$requestPath];
        } else {
            $route = $this->routes['404'];
        }

        if ($is404) {
            $route = $this->routes['404'];
        }

        // get controller name
        $controller = $route[0];
        // get function name
        $method = $route[1];

        try {
            // call the controller and function
            $instance = new $controller();
            $instance->$method();
        } catch (\Throwable $th) {
            // shows 404 page
            $this->show404();
        }
    }
}
