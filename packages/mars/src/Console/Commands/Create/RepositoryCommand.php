<?php

namespace Ribrit\Mars\Console\Commands\Create;

use Ribrit\Mars\Console\Commands\CreateCommand;

class RepositoryCommand extends CreateCommand
{
    protected $name        = 'create:repository';
    protected $description = 'Repository sınıfı üretildi';
    protected $type        = 'Repository';

    protected $stubName    = 'repository.stub';
    protected $installPath = 'Database/Repositories';

}