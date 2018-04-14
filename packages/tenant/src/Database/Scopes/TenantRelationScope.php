<?php

namespace Ribrit\Tenant\Database\Scopes;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\ScopeInterface;

class TenantRelationScope implements ScopeInterface
{
    public function apply(Builder $builder, Model $model)
    {
        $builder->where($model->getTable().'.tenant_id', tenant('id'));
    }

    public function remove(Builder $builder, Model $model)
    {
    	$builder->where('tenant_id', tenant('id'));
    }
}