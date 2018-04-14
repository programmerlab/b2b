<?php

namespace Ribrit\Tenant\Services;

use Illuminate\Support\Facades\Request;
use Illuminate\Support\Facades\View;

class PluginService
{
    /**
     * İlgili eklentiye ait veri tabanı bilgisi
     *
     * @var
     */
    public $plugin;

    /**
     * Şablona gönderilecek verilerin toplamı
     *
     * @var
     */
    public $data;

    /**
     * Sınıfa ait repository sınıfı
     *
     * @var
     */
    public $repository;

    /**
     * Yüklenecek sınıf
     *
     * @var
     */
    public $className;

    /**
     * Temaya ait veriler
     *
     * @var
     */
    public $theme;

    /**
     * Şablona ait veriler
     *
     * @var
     */
    public $layout;

    /**
     * Temaya ait alanlar
     *
     * @var array
     */
    protected $containers = [];

    /**
     * Şablonu dönderir
     *
     * @param $name
     * @return mixed
     */
    protected function layout($name)
    {
        $this->data['plugin'] = $this->plugin;

        return View::make($this->layoutPath($name))
            ->with($this->data)
            ->render();
    }

    /**
     * Şablon dizin yolunu verir
     *
     * @param $name
     * @return mixed
     */
    protected function layoutPath($name)
    {
        return join('.', [
            Request::getRouter()->group->code.'::plugins',
            $this->plugin->group_code,
            $this->plugin->name,
            $name
        ]);
    }

    /**
     * İlgili sınıfı yükle
     *
     * @return bool
     */
    public function run()
    {
        return $this->validHandle();
    }

    /**
     * Sınıf ve method kontrol
     *
     * @return bool
     */
    protected function validHandle()
    {
        if (!$handle = $this->handle()) {
            return $this->data;
        }
        
        return $handle;
    }

    /**
     * İşlem
     *
     * @return bool
     */
    protected function handle()
    {
        $name = $this->className();

        if (!class_exists($name)) {
            return $this->data;
        }

        $class         = new $name;
        $class->plugin = $this->plugin;
        $class->data   = $this->data;

        return $class->handle();
    }

    /**
     * Formata uygun olarak sınıfın ismini üret
     *
     * @return string
     */
    protected function className()
    {
        return '\Plugin\\' . ucfirst($this->plugin->group_code) . '\\' . ucfirst($this->plugin->name) . '\\' . $this->className;
    }

    public function load()
    {
        foreach ($this->layout['containers'] as $container) {

            if ($container['active'] != 'yes') {
                continue;
            }

            $grids = [];

            foreach ($container['grids'] as $grid) {

                if ($grid['active'] != 'yes') {
                    continue;
                }

                $blocks  = [];
                $layouts = [];

                foreach ($grid['blocks'] as $block) {

                    if ($block['active'] != 'yes') {
                        continue;
                    }

                    if (!$block = $this->getBlock($block)) {
                        continue;
                    }

                    $blocks[]                = $block;
                    $layouts[ $block['id'] ] = $block['layout'];
                }

                $grid->setAttribute('blocks', $blocks);
                $grid->setAttribute('layouts', $layouts);

                $grids[] = $grid;
            }

            $container->setAttribute('grids', $this->gridNested($grids));

            $this->containers[] = $container;
        }

        return $this->containers;
    }

    protected function getBlock($themeBlock)
    {
        if (!$themeBlock['block']['plugin']) {
            return null;
        }

        $themeBlock->setAttribute('layout', 'site::plugins.module.' . $themeBlock['block']['plugin']['name'] . '.index');
        $themeBlock->setAttribute('plugin', $this->runPluginBlock($themeBlock['block']['plugin'], $themeBlock['block'], $themeBlock));

        if (!View::exists($themeBlock->layout)) {
            return null;
        }

        return $themeBlock;
    }

    protected function runPluginBlock($plugin, $block, $themeBlock)
    {
        $plugin->setAttribute('layout_path', 'site::plugins.module.' . $plugin->name . '.');
        $plugin->setAttribute('lang_path', 'site::plugins/module/' . $plugin->name . '/');

        $this->plugin    = $plugin;
        $this->className = 'SiteBlock';
        $this->data      = [
            'row'        => $plugin,
            'block'      => $block,
            'themeBlock' => $themeBlock
        ];

        return $this->run();
    }

    protected function gridNested($rows = [], $parent = 0, $compact = [])
    {
        $data = [];

        foreach ($rows as $row) {

            if ($row->parent_id != $parent) {
                continue;
            }

            $row->setAttribute('childs', $this->gridNested($rows, $row->id, $compact));
            $data[ $row->id ] = $row;
        }

        return $data;
    }
}