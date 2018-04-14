<?php

namespace Ribrit\Mars\Console\Commands\Create;

use Ribrit\Mars\Console\Commands\CreateCommand;

class RequestCommand extends CreateCommand
{
    protected $groups = [
        'Add',
        'Update',
        'Destroy'
    ];

    protected $group;
    protected $name        = 'create:request';
    protected $description = 'Request sınıfı üretildi';
    protected $type        = 'Request';
    protected $stubName    = 'request.stub';
    protected $installPath = 'Http/Requests/Admin';

    /**
     * Execute the console command.
     *
     * @return bool|null
     */
    public function fire()
    {
        foreach ($this->groups as $group) {
            $this->group = $group;
            parent::fire();
        }
    }

    /**
     * Get the destination class path.
     *
     * @param  string  $name
     * @return string
     */
    protected function getPath($name)
    {
        $class    = str_replace($this->getNamespace($name) . '\\', '', $name);
        $name     = str_replace($this->laravel->getNamespace(), '', $name);
        $fileName = $name . '\\' . $class . $this->group . $this->type;

        return $this->laravel['path'] . '/' . str_replace('\\', '/', $fileName) . '.php';
    }


    /**
     * Build the class with the given name.
     *
     * @param  string  $name
     * @return string
     */
    protected function buildClass($name)
    {
        $stub = $this->files->get($this->getStub());

        return $this->replaceNamespace($stub, $name)
            ->replaceRequestClass($stub, $name)
            ->replaceClass($stub, $name);
    }

    /**
     * Replace the namespace for the given stub.
     *
     * @param  string  $stub
     * @param  string  $name
     * @return $this
     */
    protected function replaceRequestClass(&$stub, $name)
    {
        $class = str_replace($this->getNamespace($name) . '\\', '', $name);
        $stub  = str_replace('DummyClassName', $class . $this->group, $stub);

        return $this;
    }
}