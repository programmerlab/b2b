<?php

namespace Ribrit\Mars\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class ReloadCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'mars:reload';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Sistem ile ilgili tüm yapıları silip yeniden yükler!';

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $this->call('optimize');
        $this->call('migrate:rollback');
        $this->call('migrate');
        $this->call('db:seed');
        $this->call('route:clear');
        $this->call('cache:clear');
        $this->call('config:clear');
        $this->call('view:clear');
        $this->call('mars:publish');
        //$this->call('auth:clear-resets');
        $this->call('clear-compiled');
        Session::flush();
        Auth::logout();
        $this->call('optimize');
    }
}