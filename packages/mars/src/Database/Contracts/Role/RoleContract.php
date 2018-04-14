<?php

namespace Ribrit\Mars\Database\Contracts\Role;

use Ribrit\Mars\Database\Contracts\Contract;

interface RoleContract extends Contract
{
	public function codeFind($code);

    public function add($request);

    public function addRelationAccess($row, $access = []);

    public function addRelationAccessRoute($row, $access);

    public function update($request);

    public function destroy($request);

    public function getAccessFields();

    public function getAccessRoute($id, $methods);

    public function allRoute($id);
}