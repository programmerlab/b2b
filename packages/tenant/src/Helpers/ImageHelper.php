<?php

namespace Ribrit\Tenant\Helpers;

use Illuminate\Support\Facades\File;
use Intervention\Image\Facades\Image;

class ImageHelper
{
    /**
     * Resim yoksa
     *
     * @var string
     */
    protected $noImage = 'storage/site/noimage.png';

    /**
     * Resim dışardan tanımlanacak
     *
     * @var null
     */
    protected $realImage = null;

    /**
     * Resim genişlikleri
     *
     * @var array
     */
    protected $size = [];
    /**
     * Resim özellikleri
     *
     * @var array
     */
    protected $image = [];

    /**
     * Önbellek ayarları
     *
     * @var array
     */
    protected $cache = [];

    /**
     * Resim ile ilgili genel ayarlar
     *
     * @return void
     */
    public function load()
    {
        if (tenant_site('id')) {
            $this->setSiteOption();
        }
    }

    /**
     * Boyutlandırma işlemine bala
     *
     * @param $imagePath
     * @return void
     */
    public function run($imagePath)
    {
        $data            = [];
        $this->realImage = $imagePath;

        $this->existImage();
        $this->setImageOption();

        foreach ($this->size as $key => $size) {

            $this->setCacheOption($size[0], $size[1]);

            $data[ $key ] = $this->resize();
        }

        $data['org'] = [
            'src'    => $this->image['path'],
            'alt'    => $this->image['name'],
            'width'  => $this->image['width'],
            'height' => $this->image['height'],
            'attr'   => 'src="'
                . $this->image['path']
                . '" width="'
                . $this->image['width']
                . '" height="'
                . $this->image['height']
                . '" alt="'
                . $this->image['name']
                . '"'
        ];

        return $data;
    }

    protected function resize()
    {
        if (
            File::exists($this->cache['realPath']) ||
            @File::lastModified($this->image['realPath']) <
            @File::lastModified($this->cache['realPath'])
        ) {

        } else {
            $this->createImage();
        }

        return $this->format();
    }

    protected function format()
    {
        return [
            'src'    => $this->cache['path'],
            'alt'    => $this->image['name'],
            'width'  => $this->cache['width'],
            'height' => $this->cache['height'],
            'attr'   => 'src="'
                . $this->cache['path']
                . '" width="'
                . $this->cache['width']
                . '" height="'
                . $this->cache['height']
                . '" alt="'
                . $this->image['name']
                . '"'
        ];
    }

    protected function createImage()
    {
        return Image::canvas($this->cache['width'], $this->cache['height'])
            ->insert(Image::make($this->image['realPath'])->fit($this->cache['width'], $this->cache['height'], function ($constraint) {
                $constraint->upsize();
            }), 'center')
            ->save($this->cache['realPath'], 80);

        return Image::canvas($this->cache['width'], $this->cache['height'])
            ->insert(Image::make($this->image['realPath'])->resize($this->cache['width'], $this->cache['height'], function ($constraint) {
                $constraint->aspectRatio();
            }), 'center')
            ->save($this->cache['realPath'], 80);

        return Image::make($this->image['realPath'])
            ->resize($this->cache['width'], $this->cache['height'])
            ->save($this->cache['realPath'], 80);
    }

    protected function setCacheOption($width, $height)
    {
        $name = $width . 'x' . $height . '-' . $this->image['name'];

        $this->cache['realPath'] = $this->cache['realDirectory'] . '/' . $name . '.' . $this->image['extension'];
        $this->cache['path']     = $this->cache['directory'] . '/' . $name . '.' . $this->image['extension'];
        $this->cache['name']     = $name;
        $this->cache['width']    = $width;
        $this->cache['height']   = $height;
    }

    protected function setImageOption()
    {
        $realPath       = public_path($this->realImage);
        $size           = list($width, $height, $type, $attr) = getimagesize($realPath);
        $name           = File::name($realPath);
        $extension      = File::extension($realPath);
        $directory      = substr($this->realImage, 0, strlen($this->realImage) - strlen('/' . $name . '.' . $extension));
        $cacheDirectory = 'storage/cache' . substr($directory, 7);

        $this->image = [
            'realDirectory' => public_path($directory),
            'directory'     => $directory,
            'realPath'      => $realPath,
            'path'          => $this->realImage,
            'name'          => $name,
            'extension'     => $extension,
            'width'         => $size[0],
            'height'        => $size[1]
        ];

        $this->cache = [
            'realDirectory' => public_path($cacheDirectory),
            'directory'     => $cacheDirectory,
            'realPath'      => null,
            'path'          => null,
            'name'          => null,
            'width'         => null,
            'height'        => null,
        ];

        $this->existDirectory($this->image['directory']);
        $this->existDirectory($this->cache['directory']);
    }

    /**
     * Siteye bağlı resim ayarları
     *
     * @return array
     */
    protected function setSiteOption()
    {
        foreach (config('mars.site.images', []) as $image) {
            $this->size[$image] = [(int)tenant_site('image_'.$image.'_weight'), (int)tenant_site('image_'.$image.'_height')];
        }

        $this->noImage = tenant_site('image_nopic') == '' ? $this->noImage : tenant_site('image_nopic');
    }

    protected function existDirectory($path)
    {
        $public = public_path();

        foreach (explode('/', $path) as $directory) {

            if (!$directory) {
                continue;
            }

            $public .= '/' . $directory;

            if (!File::exists($public)) {
                File::makeDirectory($public, 0755);
            }
        }
    }

    protected function existImage()
    {
        if (!$this->realImage) {
            $this->realImage = $this->noImage;
        }

        if (!File::exists(public_path($this->realImage))) {
            $this->realImage = $this->noImage;
        }
    }
}
