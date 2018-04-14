<?php

namespace Ribrit\Mars\Database\Contracts\User;

use Ribrit\Mars\Database\Contracts\Contract;

interface UserContract extends Contract
{
    public function add($request);

    public function addRelationMainRole($row, $roleId);

    public function update($request);

    public function codePaginate($code);

    public function codeGet($code);
}