<?php

namespace Ribrit\Mars\Database\Contracts;

interface Contract
{
	public function rows();

    public function activeRows();

    public function groupRows($groupId);

    public function paginate();

    public function groupPaginate($groupId);

    public function orderByParentRows($parentId);

    public function row($id);

    public function groupRow($id, $groupId);

    public function findOrFail($id);

    public function add($request);

    public function addRelation($row, $method, $fields);

    public function addRelationText($row, $texts, $type = '');

    public function addRelationAccessory($row, $accessories = []);

    public function addRelationStringMany($row, $fields, $id);

    public function update($request);

    public function destroy($request);

    public function destroyChild($request);

    public function active($request);

    public function passive($request);

    public function changeRow($request);

    public function setWith($with);
}
