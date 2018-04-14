<?php

namespace Ribrit\Mars\Helpers;

use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Lang;

class BreadCrumbsHelper
{
    public function cacheRender($request, $methods)
    {
        return Cache::rememberForever('breadcrumbs-' . lang('id') . '-' . $request->path(), function () use ($request, $methods) {
            return $this->render($request, $methods);
        });
    }

    protected function render($request, $methods)
    {
        $links = $this->findRoutes($this->clearSegments($request->segments()));

        $segments = [];

        foreach ($links as $link) {

            $text = $link['route']['title'];

            if ($link['original']['method']['code'] != 'index') {
                $text = $methods[ $link['original']['method']['code'] ]['title'];
            }

            $segments[] = [
                'url'   => $link['original']['text']['url'],
                'title' => $text
            ];
        }

        $total             = count($request->segments());
        $totalDataSegments = count($segments);


        if (intval($request->segment($total)) && $totalDataSegments > 0) {
            $segments[ $totalDataSegments - 1 ]['url'] = $segments[ $totalDataSegments - 1 ]['url'] . '/' . $request->segment($total);
        }

        if (!$segments) {
            $segments = $this->setSegmentsSite($request);
        }

        return $this->segmentsActive($segments);
    }

    protected function findRoutes($segments)
    {
        $names = array_el_to_key(config('route.names'), 'url');
        $data  = [];

        foreach ($segments as $key => $segment) {
            if (!isset($names[ $segment ])) {
                continue;
            }

            $data[ $key ] = $names[ $segment ];
        }

        return $data;
    }

    protected function clearSegments($segments)
    {
        $data = [];

        foreach ($this->segments($segments) as $value) $data [] = substr($value, 0, -1);

        return $data;
    }

    protected function segments($segments)
    {
        if (!$segments) {
            return [];
        }

        $data = [];
        $url  = '';

        foreach ($segments as $segment) $data [] = $url .= $segment . '/';

        if ($data[0] == 'admin/') {
            $firstUrl = 'admin/dashboard/';
        } else {
            $firstUrl = '/';
        }

        $data[0] = $firstUrl;

        return $data;
    }

    protected function setSegmentsSite($request)
    {
        $data[0] = [
            'url'   => '/',
            'title' => Lang::get('public.home')
        ];

        return $data;
    }

    protected function segmentsActive($segments)
    {
        $key                        = count($segments) - 1;
        $segments[ $key ]['active'] = 'yes';

        return $segments;
    }
}