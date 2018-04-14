<?php

namespace Ribrit\Mars\Helpers;

use Illuminate\Support\Facades\File;
use Symfony\Component\Yaml\Yaml;

class ConfigHelper
{
    /**
     * Yml uzantılı dosyaların tutulduğu dizin
     *
     * @var string
     */
    public $configDirectoryPath = 'config/mars';

    /**
     * Yml formatı
     *
     * @var int
     */
    public $yamlFormat = 2;

    /**
     * Yml uzantılı dosyayı dizi tipine çevirip verir
     *
     * @param $name
     * @return mixed
     */
    public static function get($name)
    {
        return yaml_parsed((new static)->filePath($name));
    }

    /**
     * Yml uzantılı dosya oluşturup ilgili dizi verisinin içine yazar
     *
     * @param       $name
     * @param array $data
     * @return void
     */
    public function make($name, array $data = [])
    {
        return $this->append(
            $this->filePath($name),
            $this->createData($data)
        );
    }

    /**
     * Dosyaya yaz
     *
     * @param $path
     * @param $data
     * @return void
     */
    protected function append($path, $data)
    {
        File::delete($path);
        File::append($path, $data);
    }

    /**
     * Yml formatıan çevir
     *
     * @param $data
     * @return string
     */
    protected function createData($data)
    {
        return Yaml::dump($data, $this->yamlFormat);
    }

    /**
     * Dosyaının isimi ile bulundugu alan
     *
     * @param $name
     * @return string
     */
    protected function filePath($name)
    {
        return base_path($this->configDirectoryPath . '/' . $name . '.yml');
    }
}