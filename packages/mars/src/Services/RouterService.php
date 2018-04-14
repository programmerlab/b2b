<?php

namespace Ribrit\Mars\Services;

use Illuminate\Routing\ControllerInspector;
use Illuminate\Routing\Router;
use Illuminate\Container\Container;
use Illuminate\Contracts\Events\Dispatcher;

class RouterService extends Router
{
    public function __construct(Dispatcher $events, Container $container = null)
    {
        parent::__construct($events, $container);
    }

    /**
     * Route a controller to a URI with wildcard routing.
     *
     * @param  string  $uri
     * @param  string  $controller
     * @param  array   $names
     * @return void
     *
     * @deprecated since version 5.2.
     */
    public function controller($uri, $controller, $names = [])
    {
        $prepended = $controller;

        // First, we will check to see if a controller prefix has been registered in
        // the route group. If it has, we will need to prefix it before trying to
        // reflect into the class instance and pull out the method for routing.
        if (! empty($this->groupStack)) {
            $prepended = $this->prependGroupUses($controller);
        }

        $routable = (new ControllerInspector)
            ->getRoutable($prepended, $uri);

        // When a controller is routed using this method, we use Reflection to parse
        // out all of the routable methods for the controller, then register each
        // route explicitly for the developers, so reverse routing is possible.
        foreach ($routable as $method => $routes) {

            if (is_string($names)) {
                $createNames[ $method ] = $names . ucwords($method);
            } else {
                $createNames = $names;
            }

            foreach ($routes as $route) {
                $this->registerInspected($route, $controller, $method, $createNames);
            }
        }

        $this->addFallthroughRoute($controller, $uri);
    }
}