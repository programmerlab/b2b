<?php

namespace Ribrit\Mars\Console\Commands\Create;

use Illuminate\Console\Command;

class CruidCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'create:cruid {name}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Basit cruid yapısı oluşturmanızı sağlar';

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $data = [
            'name' => $this->argument('name')
        ];

        $model      = $this->call('create:model', $data);
        $contract   = $this->call('create:contract', $data);
        $repository = $this->call('create:repository', $data);
        $request    = $this->call('create:request', $data);
        $controller = $this->call('create:controller', $data);
    }
}