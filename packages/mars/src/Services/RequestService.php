<?php

namespace Ribrit\Mars\Services;

use Illuminate\Http\Request;

class RequestService extends Request
{
    public $router;

    public $group;

    public $accessRoute;

    protected $seoLink;

    public function getRouter()
    {
        return $this->router;
    }

    public function setRouter($router)
    {
        $this->router = $router;
    }

    public function setRouterMethod($data = [])
    {
        $router  = $this->router;
        $methods = $router->methods;

        foreach ($methods as $key => $method) {
            if (empty($data[ $key ])) {
                continue;
            }

            $methods[ $key ] = array_merge_recursive($method, $data[ $key ]);
        }

        $router->methods = $methods;
        $this->setRouter($router);

        return $router;
    }

    public function unSetRouterMethod($method)
    {
        $router  = $this->router;
        $methods = $router->methods;
        unset($methods[ $method ]);

        $router->methods = $methods;

        $this->setRouter($router);
    }

    public function changeCurrentMethod($method)
    {
        $router  = $this->router;
        $router->setAttribute('current', $router->methods[$method]);

        $this->setRouter($router);

        return $router;
    }

    public function getGroup()
    {
        return $this->group;
    }

    public function getAccessRoute()
    {
        return $this->accessRoute;
    }

    public function getSeoLink()
    {
        return $this->seoLink;
    }

    public function setSeoLink($seoLink)
    {
        $this->seoLink = $seoLink;
    }
}