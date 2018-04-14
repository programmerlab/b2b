<?php

namespace Ribrit\Tenant\Database\Repositories\Component;

use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;
use Ribrit\Mars\Database\Contracts\Contract;
use Ribrit\Mars\Database\Repositories\Repository;
use Ribrit\Tenant\Services\ComponentService;

class ComponentRepository extends Repository implements Contract
{
    public function groupPlugin($group, $name)
    {
        return $this->getLoadComponent('plugins.' . $group . '.' . $name);
    }

    public function getGroupPlugins($group)
    {
        return $this->getLoadComponent('plugins.' . $group);
    }

    public function groupTheme($group, $name)
    {
        return $this->getLoadComponent('themes.' . $group . '.' . $name);
    }

    public function getGroupThemes($group)
    {
        return $this->getLoadComponent('themes.' . $group);
    }

    protected function getLoadComponent($key)
    {
        $service         = new ComponentService();
        $service->tenant = tenant();
        $tenants         = $service->all();
        $service->tenant = null;
        $defaults        = $service->all();

        return array_get(array_merge_recursive($defaults, $tenants), $key, []);
    }

    public function nameRow($name)
    {
        return $this->model->whereName($name)->with($this->with)->first();
    }

    public function nameGroupRow($groupId, $name)
    {
        return $this->model
            ->where('group_id', $groupId)
            ->whereName($name)
            ->with($this->with)
            ->first();
    }

    protected function installMix($component)
    {
        $this->migrations($component->directory, 'up');
    }

    protected function uninstallMix($component)
    {
        $this->migrations($component->directory, 'down');
    }

    protected function migrations($path, $type)
    {
        $directories = base_path($path . 'database/migrations');

        if (!File::exists($directories)) {
            return null;
        }

        $directories = File::files($directories);

        if ($type == 'down') {
            rsort($directories);
        }

        foreach ($directories as $file) {
            include $file;

            $name = Str::substr(Str::studly(File::name($file)), 14);

            app($name)->$type();
        }
    }
}