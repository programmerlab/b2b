<?php

namespace Ribrit\Mars\Console\Commands\Create;

use Ribrit\Mars\Console\Commands\CreateCommand;

class ModelCommand extends CreateCommand
{
    protected $name        = 'create:model';
    protected $description = 'Model sınıfı üretildi';
    protected $type        = '';

    protected $stubName    = 'model.stub';
    protected $installPath = 'Database/Models';

}