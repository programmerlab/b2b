<?php

namespace Ribrit\Mars\Services;

use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\File;

class ComponentService
{
    /**
     * Varsayılan dizinler
     *
     * @var array
     */
    protected $locations = [
        'themes'     => [
            'admin' => 'resources/themes',
            'site'  => 'themes'
        ],
        'plugins'    => 'plugins',
        'components' => 'components'
    ];

    /**
     * Ayarların tutulduğu dosya
     *
     * @var string
     */
    protected $configFile = 'config.yml';

    /**
     * Bileşen için zorunlu alanlar
     *
     * @var array
     */
    protected $info = [
        'group_code'  => '',
        'name'        => '',
        'description' => '',
        'author'      => '',
        'link'        => '',
        'preview'     => '',
        'directory'   => '',
        'assets'      => ''
    ];

    /**
     * Döngülerde depolama işlemi için kullanılır
     *
     * @var array
     */
    protected $storage = [];

    /**
     * Önbellekte var ise önbellekten yoksa önbelleğe al
     *
     * @return mixed
     */
    public function boot()
    {
        $components              = $this->bootComponents();
        $routes                  = $this->bootRoutes($components);
        $providers               = $this->bootProviders($components);
        $repositoriesToContracts = $this->bootRepositoriesToContracts($components);

        return $components;
    }

    /**
     * Bileşenleri boot ettir
     *
     * @return mixed
     */
    protected function bootComponents()
    {
        return Cache::rememberForever('components', function() {
            return $this->all();
        });
    }

    /**
     * Bileşen rotalarını önbelleğe al
     *
     * @param $components
     * @return void
     */
    protected function bootRoutes($components)
    {
        return Cache::rememberForever('componentRoutes', function() use($components) {
            return $this->addonsCall($components, 'Routes');
        });
    }

    /**
     * Bileşenlere ait providerları yükle
     *
     * @param $components
     * @return mixed
     */
    protected function bootProviders($components)
    {
        return Cache::rememberForever('componentProviders', function() use($components) {
            return $this->addonsCall($components, 'Providers');
        });
    }

    /**
     * bootRepositoriesToContracts
     *
     * @param $components
     * @return mixed
     */
    protected function bootRepositoriesToContracts($components)
    {
        return Cache::rememberForever('componentRepositoriesToContracts', function() use($components) {
            return $this->addonsCall($components, 'RepositoriesToContracts');
        });
    }

    /**
     * Bileşenler için geri çağrım uygulaması dönderir
     *
     * @param $all
     * @param $call
     * @return array
     */
    protected function addonsCall($all, $call)
    {
        $this->storage = [];

        unset($all['themes']);

        foreach ($all as $group => $groups) {

            if ($group == 'plugins') {
                $group = 'plugin';
            }

            if ($group == 'components') {
                $group = 'component';
            }

            foreach ($groups as $components) {
                foreach ($components as $component) {
                    $this->{'get' . $call}($group, $component);
                }
            }
        }
        
        return $this->storage;
    }

    /**
     * Rotaları verir
     *
     * @param $group
     * @param $component
     * @return null
     */
    protected function getRoutes($group, $component)
    {
        if (!isset($component['routes'])) {
            return null;
        }

        foreach ($component['routes'] as $prefix => $routes) {
            foreach ($routes as $name => $router) {

                if ($prefix == 'group') {
                    $router = $this->setGroupRoutes($router);
                } else {
                    $router = $this->setGlobalRoutes($component, $router, $group, $prefix);
                }

                if ($router) {
                    $this->storage[ $prefix ][ $name ] = $router;
                }
            }
        }
    }

    /**
     * Site ve admin grubu için
     *
     * @param $component
     * @param $router
     * @param $group
     * @param $prefix
     * @return bool
     */
    protected function setGlobalRoutes($component, $router, $group, $prefix)
    {
        $router['namespace'] = join('\\', [
            ucfirst($group),
            ucfirst($component['info']['group_code']),
            ucfirst($component['info']['name']),
            'Http\Controllers',
        ]);

        $router['mixController'] = $router['namespace'] . '\\' . ucfirst($prefix) . '\\' . $router['controller'];

        if (!class_exists($router['mixController'])) {
            return false;
        }

        return $router;
    }

    /**
     * Route Controller altında çalışacak yapı için
     *
     * @param $router
     * @return mixed
     */
    protected function setGroupRoutes($router)
    {
        return $router;
    }

    /**
     * Bileşenlere ait providerler varir
     *
     * @param $group
     * @param $component
     * @return void
     */
    protected function getProviders($group, $component)
    {
        $path = $component['info']['directory'];
        $file = base_path($path . 'src/Providers/RunProvider.php');

        if (!File::exists($file)) {
            return false;
        }

        $namespace = '';

        foreach (explode('/', $path) as $dir) {
            $namespace .= ucfirst($dir) . '\\';
        }

        $this->storage[ $component['info']['name'] ] = $namespace.'Providers\RunProvider';
    }

    /**
     * Repository ve contract ilşişkisi
     *
     * @param $group
     * @param $component
     * @return null
     */
    protected function getRepositoriesToContracts($group, $component)
    {
        if (!isset($component['repositoriesToContracts'])) {
            return null;
        }

        foreach ($component['repositoriesToContracts'] as $row) {
            $this->storage[] = $row;
        }

        return $this->storage;
    }

    /**
     * İlgili anahtara bağlı olarak verileri verir
     *
     * @param $key
     * @return mixed
     */
    public function get($key)
    {
        $get = array_get($this->all(), $key);

        return $get ? $get : [];
    }

    /**
     * Gruplara göre ayar dosyalarını toplayıp diziye atar
     *
     * @return array
     */
    public function all()
    {
        $data = [];

        foreach ($this->locations as $name => $locations) {
            if (is_string($locations)) {

                if (!$component = $this->getLocation($locations)) {
                    continue;
                }

                $data[ $name ] = $component;
            } else {
                foreach ($locations as $keyName => $location) {

                    if (!$component = $this->getLocation($location)) {
                        continue;
                    }

                    $data[ $name ][ $keyName ] = $component[ $keyName ];
                }
            }
        }

        return $data;
    }

    public function getLocation($location)
    {
        $data = [];

        if (!$directoryPath = $this->checkDirectory($location)) {
            return $data;
        }

        foreach (File::directories($directoryPath) as $directory) {

            if (!$config = $this->getConfigFile($directory)) {
                continue;
            }

            $data[ $config['info']['group_code'] ][ $config['info']['name'] ] = $config;
        }

        return $data;
    }

    /**
     * Ayar dosyası
     *
     * @param $directory
     * @return array|null
     */
    protected function getConfigFile($directory)
    {
        if (!$config = $this->getYamlFile($directory, $this->configFile)) {
            return null;
        }

        if (!$this->validInfo($config['info'])) {
            return null;
        }

        return $config;
    }

    /**
     * Zorunlu alan kontrolü
     *
     * @param $info
     * @return bool
     */
    protected function validInfo($info)
    {
        foreach ($this->info as $key => $value) {
            if (!array_key_exists($key, $info)) {
                return false;
            }
        }

        return true;
    }

    /**
     * Yml uzantılı ayar dosayasını dizi tipine çevirir
     *
     * @param $directory
     * @param $fileName
     * @return mixed|null
     */
    protected function getYamlFile($directory, $fileName)
    {
        if (!$file = $this->getFile($directory, $fileName)) {
            return null;
        }

        return yaml_parsed($file);
    }

    /**
     * Yml dosyası
     *
     * @param $path
     * @param $fileName
     * @return null|string
     */
    protected function getFile($path, $fileName)
    {
        $file = $path. '/'. $fileName;

        if (!File::isFile($file)) {
            return null;
        }

        return $file;
    }

    /**
     * Dizin kontrolü
     *
     * @param $directory
     * @return null|string
     */
    protected function checkDirectory($directory)
    {
        $path = $this->getBasePath($directory);

        if (!File::isDirectory($path)) {
            return null;
        }

        return $path;
    }

    /**
     * Bileşenleri bulunduğu dizin
     *
     * @param $path
     * @return string
     */
    protected function getBasePath($path)
    {
        if (isset($this->tenant)) {
            return $this->tenant['storage_path'] . '/' . $path;
        }

        return base_path($path);
    }

    /**
     * Sınıfın varlıgını kontrol et
     *
     * @param $name
     * @return bool
     */
    protected function existsClass($name)
    {
        return class_exists($name);
    }

    /**
     * Sınıf içeriisndeki methodun varlıgını kontrol
     *
     * @param $class
     * @param $method
     * @return bool
     */
    protected function existsClassMethod($class, $method)
    {
        return method_exists($class, $method);
    }
}