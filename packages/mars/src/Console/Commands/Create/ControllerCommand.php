<?php

namespace Ribrit\Mars\Console\Commands\Create;

use Ribrit\Mars\Console\Commands\CreateCommand;

class ControllerCommand extends CreateCommand
{
    protected $name        = 'create:controller';
    protected $description = 'Controller sınıfı üretildi';
    protected $type        = 'Controller';

    protected $stubName    = 'controller.stub';
    protected $installPath = 'Http/Controllers/Admin';
}