<?php

namespace Ribrit\Mars\Exceptions;

use Illuminate\Support\Facades\Lang;
use Illuminate\Support\Facades\Response;

class ErrorHandler
{
    /**
     * Varsatılan tema yolu
     *
     * @var string
     */
    public $errorViewPath = 'errors';

    /**
     * Dışarıdan dönen değere eklemek istediğiniz veri
     *
     * @var array
     */
    public $publicData = [];

    /**
     * Blade şablonu olarak hata mesajını basar
     *
     * @param int   $code
     * @return mixe
     */
    public function view($code = 500)
    {
        return Response::view(
            $this->errorViewPath.'.error',
            $this->make($code)
        , 500);
    }

    /**
     * Json formatında hata mesajını basar
     *
     * @param int   $code
     * @return mixed
     */
    public function json($code = 500)
    {
        return Response::json($this->make($code), 500);
    }

    /**
     * Hata fırlat
     *
     * @param $code
     * @return \Exception
     */
    public function exception($code)
    {
        return new \Exception($this->lang($code.'.message'));
    }

    /**
     * Dışarıdan gelen data ile varolan datayı birleştir
     *
     * @param $code
     * @return array
     */
    private function make($code)
    {
        return array_merge([
            'title'   => $this->lang($code.'.title'),
            'code'    => $code,
            'message' => $this->lang($code.'.message')
        ], $this->publicData);
    }

    /**
     * Hata koduna ait dil dosyası
     *
     * @param $file
     * @return mixed
     */
    private function lang($file)
    {
        return Lang::get('error/'.$file);
    }
}