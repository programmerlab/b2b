<?php

namespace Ribrit\Mars\Database\Traits;

trait AccessoryRelationTrait
{
    /**
     * Değer varlık ilişkisini bağlı oluşan veri
     *
     * @var array
     */
    public $accessoryFields = [];

    /**
     * Accessory anahtar değerlerinin tutulduğu dizin
     *
     * @var string
     */
    public $accessoryPath = 'database/accessories/';

    /**
     * Sınıfın accessory alt sınıfı ikle ilişkisi
     *
     * @return mixed
     */
    public function accessories()
    {
        return $this->hasMany($this->getAccessoryClassName());
    }

    /**
     * Accessory yapısını özellik yapısı yüklendiğinde aktif et
     *
     * @param array      $attributes
     * @param bool|false $sync
     * @return $this
     */
    public function setRawAttributes(array $attributes, $sync = false)
    {
        $this->attributes = $attributes;

        $this->setAccessories();

        if ($sync) {
            $this->syncOriginal();
        }

        return $this;
    }

    /**
     * Convert the model instance to an array.
     *
     * @return array
     */
    public function toArray()
    {
        $merge = parent::toArray();
        unset($merge['accessories']);

        return $merge;
    }

    /**
     * Accessory değerini eloquent özellik yapısına entegre et
     *
     * @return array
     */
    protected function setAccessories()
    {
        return $this->attributes = array_merge($this->attributes, $this->accessoryHandle());
    }

    /**
     * Varsayılan elemanları yok et
     *
     * @return void
     */
    public function unsetAccessories()
    {
        foreach ($this->accessoryFields as $key => $value) {
            unset($this->$key);
            unset($this->attributes[ $key ]);
        }
    }

    public function getAccessories()
    {
        return $this->accessoryFields;
    }

    /**
     * Accessory yapısını model sınıfına dahil et
     *
     * @return void
     */
    protected function accessoryHandle()
    {
        $this->setFieldKeys();

        $this->sqlToAccessories();

        return $this->accessoryFields;
    }

    /**
     * Varsayılan anahtar değerleri ile veri tabanındaki anahtar değerlerini karsılastır
     *
     * @return array
     */
    protected function sqlToAccessories()
    {
        foreach ($this->accessories as $accessory) {

            /*
            if (!array_key_exists($accessory->key, $this->accessoryFields)) {
                continue;
            }
            */

            $this->accessoryFields[ $accessory->key ] = $this->validValue($accessory->value);
        }

        return $this->accessoryFields;
    }

    /**
     * $type değerine göre veriyi süzüp geri dönderir
     * TODO: Eav modeline uygun olarak type alanları oluşturulursa bu alan buradan yazılacak.
     *
     * @param      $value
     * @param null $type
     * @return mixed
     */
    protected function validValue($value, $type = null)
    {

        if ($jsonValue = json_decode($value, true)) {

            if (is_array($jsonValue)) {
                return $this->setMultipleArray($jsonValue);
            }

            if (is_object($jsonValue)) {
                return $this->setMultipleArray((array)$jsonValue);
            }
        }

        return $value;
    }

    /**
     * Obje tipinin değiştir
     *
     * @param $value
     * @return array
     */
    protected function setArray($value)
    {
        return is_object($value) ? (array)$value : $value;
    }

    /**
     * Multi object
     *
     * @param $value
     * @return array
     */
    protected function setMultipleArray($value)
    {
        $data = [];

        foreach ($value as $key => $val) $data[ $key ] = $this->setArray($val);

        return $data;
    }

    /**
     * Anahtar değerlerini depola
     *
     * @return array
     */
    protected function setFieldKeys()
    {
        foreach ($this->loadFieldKeys() as $field) {
            $this->accessoryFields[ $field ] = null;
        }

        return $this->accessoryFields;
    }

    /**
     * Sınıfa ait accessory anahtarları
     *
     * @return array
     */
    protected function loadFieldKeys()
    {
        return $this->loadAccessoryFieldFile();
    }

    /**
     * Yüklenen dosya içerisinde field yapısı varmı kontrol et
     *
     * @return array
     */
    protected function loadAccessoryFieldFile()
    {
        $data = yaml_parsed($this->createPath());

        return isset($data['fields']) ? $data['fields'] : [];
    }

    /**
     * Accessory yml dosyasının bulunduğu dizin
     *
     * @return string
     */
    protected function createPath()
    {
        return base_path($this->accessoryPath.$this->getTable().'.yml');
    }

    /**
     * getClassName
     *
     * @return string
     */
    private function getAccessoryClassName()
    {
        if ($this->namespaceKey) {
            $namespace = explode(',', $this->namespaceKey);

            return str_replace(ucfirst($namespace[0]), ucfirst($namespace[1]), get_class($this)) . 'Accessory';
        }

        return get_class($this).'Accessory';
    }
}