<?php

namespace Ribrit\Mars\Console\Commands;

use Illuminate\Console\GeneratorCommand;

abstract class CreateCommand extends GeneratorCommand
{
    /**
     * Get the stub file for the generator.
     *
     * @return string
     */
    protected function getStub()
    {
        return __DIR__.'/Create/stubs/'.$this->stubName;
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
        $fileName = $name . '\\' . $class . $this->type;

        return $this->laravel['path'].'/'.str_replace('\\', '/', $fileName).'.php';
    }

    /**
     * Get the default namespace for the class.
     *
     * @param  string  $rootNamespace
     * @return string
     */
    protected function getDefaultNamespace($rootNamespace)
    {
        return $rootNamespace.'\\'.$this->installPath;
    }

    /**
     * Replace the class name for the given stub.
     *
     * @param  string  $stub
     * @param  string  $name
     * @return string
     */
    protected function replaceClass($stub, $name)
    {
        $class = str_replace($this->getNamespace($name).'\\', '', $name);

        return str_replace('DummyName', $class, $stub);
    }
}