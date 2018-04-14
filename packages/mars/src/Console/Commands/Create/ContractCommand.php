<?php

namespace Ribrit\Mars\Console\Commands\Create;

use Ribrit\Mars\Console\Commands\CreateCommand;

class ContractCommand extends CreateCommand
{
    protected $name        = 'create:contract';
    protected $description = 'Contract sınıfı üretildi';
    protected $type        = 'Contract';

    protected $stubName    = 'contract.stub';
    protected $installPath = 'Database/Contracts';

}