<?php

namespace Ribrit\Tenant\Database\Traits;

use Ribrit\Tenant\Database\Models\Tenant\Tenant;
use Ribrit\Tenant\Database\Scopes\TenantRelationScope;

trait TenantRelationTrait
{
	public static function bootTenantRelationTrait()
    {
        static::addGlobalScope(new TenantRelationScope());
    }

    public function tenant()
    {
        return $this->belongsTo(Tenant::class);
    }

    public function save(array $options = [])
    {
        $this->tenant_id = tenant('id');

        parent::save($options);
    }
}
