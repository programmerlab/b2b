<?php

namespace Ribrit\Mars\Database\Traits;

trait TextRelationTrait
{
    protected $namespaceKey = null;

    private function getTextClassName()
    {
        if ($this->namespaceKey) {
            $namespace = explode(',', $this->namespaceKey);

            return str_replace(ucfirst($namespace[0]), ucfirst($namespace[1]), get_class($this)) . 'Text';
        }

        return get_class($this).'Text';
    }

    public function text()
    {
        return $this->hasOne($this->getTextClassName())->where('lang_id', lang('id'));
    }

    public function texts()
    {
        return $this->hasMany($this->getTextClassName());
    }

    public function getLangTextsAttribute()
    {
        return $this->setTextsToLang('langs');
    }

    public function getLangTenantTextsAttribute()
    {
        return $this->setTextsToLang('tenant_langs');
    }

    protected function setTextsToLang($group = 'langs')
    {
        $rows  = [];
        $texts = array_el_to_key($this->texts, 'lang_id');

        foreach (config($group) as $id => $lang) {
            $data          = !empty($texts[ $id ]) ? $texts[ $id ] : $lang;
            $data->lang_id = $id;
            $data->name    = $lang->name;
            $rows[ $id ]   = $data;
        }

        return $rows;
    }
}
