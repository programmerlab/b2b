<?php

namespace Ribrit\Mars\Helpers;

class TreeMenuHelper
{
    /**
     * Varsayılan şablon konumu
     *
     * @var string
     */
    public $layout = '';

    /**
     * Theme namespace
     *
     * @var string
     */
    public $namespace = '';

    /**
     * İlgili ver ile şablonu eşleyip sınırsız menu ağacı oluştur
     *
     * @param array $rows
     * @param int   $parent
     * @param array $compact
     * @return string
     */
    public function render($rows = [], $parent = 0, $compact = [])
    {
        $html = '';

        foreach ($rows as $row) {

            if ($row->parent_id != $parent) {
                continue;
            }

            $html .= view($this->layout)->with(array_merge([
                'row'   => $row,
                'child' => $this->render($rows, $row->id, $compact)
            ], $compact))->render();
        }

        return $html;
    }

    /**
     * İlgili ver ile şablonu eşleyip sınırsız menu ağacı oluştur
     *
     * @param array $rows
     * @param int   $parent
     * @param array $compact
     * @return string
     */
    public function renderArray($rows = [], $parent = 0, $compact = [])
    {
        $html = '';

        foreach ($rows as $row) {

            if ($row['parent_id'] != $parent) {
                continue;
            }

            $html .= view($this->layout)->with(array_merge([
                'row'   => $row,
                'child' => $this->renderArray($rows, $row['id'], $compact)
            ], $compact))->render();
        }

        return $html;
    }

    /**
     * Json tipinde gelen veriyi ayrıştırıp dizi şekline sunar
     *
     * @param  int $parentId
     * @param  array $jsonArray
     * @return Array
     */
    public function renderJson($jsonArray, $parentId = 0)
    {
        $return = [];

        foreach ($jsonArray as $subArray) {

            $returnSubArray = [];

            if (isset($subArray['children'])) {
                $returnSubArray = $this->renderJson($subArray['children'], $subArray['id']);
            }

            $return[] = [
                'parent' => $parentId,
                'id'     => $subArray['id']
            ];

            $return = array_merge($return, $returnSubArray);
        }

        // Array
        return $return;
    }

    public $childsData = [];

    /**
     * İlgili verinin cocuklarını verir
     *
     * @param array $rows
     * @param int   $parent
     * @return string
     */
    public function renderChild($rows = [], $parent = 0)
    {
        foreach ($rows as $row) {

            if ($row->parent_id != $parent) {
                continue;
            }

            $this->renderChild($rows, $row->id);

            $this->childsData[ $row->id ] = $row->id;
        }

        return $this->childsData;
    }

    public function renderDropdown($rows = [], $parent = 0)
    {
        $html = '';

        foreach ($rows as $row) {

            if ($row->parent_id != $parent) {
                continue;
            }

            if ($child = $this->renderDropdown($rows, $row->id)) {
                $child = str_replace(' data-type="">', ' data-type="">'.$row['text']['title'].'<i class="angle double right icon" style="margin-left:5px"></i>', $child);
            }

            $html .= '<div id="helperDropdown-'.$row['id'].'" class="item" data-value="'.$row['id'].'" data-type="">'.$row['text']['title'].'</div>';
            $html .= $child;
        }

        return $html;
    }

    /**
     * İlgili ver ile şablonu eşleyip sınırsız menu ağacı oluştur
     *
     * @param array $rows
     * @param int   $parent
     * @param array $compact
     * @return string
     */
    public function renderLayouts($rows = [], $parent = 0, $compact = [])
    {
        foreach ($this->layout as $value) {
            $html[ $value ] = '';
        }

        foreach ($rows as $row) {

            if ($row->parent_id != $parent) {
                continue;
            }

            foreach ($this->layout as $value) {

                $html[ $value ] .= view($this->createLayout($value))->with(array_merge([
                    'row'   => $row,
                    'child' => $this->renderLayouts($rows, $row->id, $compact)[ $value ]
                ], $compact))->render();
            }
        }

        return $html;
    }

    protected function createLayout($name)
    {
        return $this->namespace . '_parts.treemenu.' . $name;
    }
}