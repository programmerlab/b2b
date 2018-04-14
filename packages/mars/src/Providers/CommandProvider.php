<?php

namespace Ribrit\Mars\Providers;

use Illuminate\Support\ServiceProvider;
use Ribrit\Mars\Console\Commands\Create\ContractCommand;
use Ribrit\Mars\Console\Commands\Create\ControllerCommand;
use Ribrit\Mars\Console\Commands\Create\CruidCommand;
use Ribrit\Mars\Console\Commands\Create\ModelCommand;
use Ribrit\Mars\Console\Commands\Create\RepositoryCommand;
use Ribrit\Mars\Console\Commands\Create\RequestCommand;
use Ribrit\Mars\Console\Commands\InstallCommand;
use Ribrit\Mars\Console\Commands\PublishCommand;
use Ribrit\Mars\Console\Commands\ReloadCommand;
use Ribrit\Mars\Console\Commands\UninstallCommand;

class CommandProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        // App
        $this->registerReloadCommand();
        $this->registerPublishCommand();

        // Create
        $this->registerCruidCommand();
        $this->registerModelCommand();
        $this->registerContractCommand();
        $this->registerRepositoryCommand();
        $this->registerRequestCommand();
        $this->registerControllerCommand();
    }

    /**
     * Get the services provided by the provider.
     *
     * @return array
     */
    public function provides()
    {
        return [
            'command.mars.publish',
            'command.mars.reload',

            // create
            'command.create.cruid',
            'command.create.model',
            'command.create.contract',
            'command.create.repository',
            'command.create.request',
            'command.create.controller'
        ];
    }

    protected function registerReloadCommand()
    {
        $this->app->singleton('command.mars.publish', function($app) {
            return new PublishCommand();
        });

        $this->commands('command.mars.publish');
    }

    protected function registerPublishCommand()
    {
        $this->app->singleton('command.mars.reload', function($app) {
            return new ReloadCommand();
        });

        $this->commands('command.mars.reload');
    }

    protected function registerCruidCommand()
    {
        $this->app->singleton('command.create.cruid', function($app) {
            return $this->app->make(CruidCommand::class);
        });

        $this->commands('command.create.cruid');
    }

    protected function registerModelCommand()
    {
        $this->app->singleton('command.create.model', function($app) {
            return $this->app->make(ModelCommand::class);
        });

        $this->commands('command.create.model');
    }

    protected function registerContractCommand()
    {
        $this->app->singleton('command.create.contract', function($app) {
            return $this->app->make(ContractCommand::class);
        });

        $this->commands('command.create.contract');
    }

    protected function registerRepositoryCommand()
    {
        $this->app->singleton('command.create.repository', function($app) {
            return $this->app->make(RepositoryCommand::class);
        });

        $this->commands('command.create.repository');
    }

    protected function registerRequestCommand()
    {
        $this->app->singleton('command.create.request', function($app) {
            return $this->app->make(RequestCommand::class);
        });

        $this->commands('command.create.request');
    }

    protected function registerControllerCommand()
    {
        $this->app->singleton('command.create.controller', function($app) {
            return $this->app->make(ControllerCommand::class);
        });

        $this->commands('command.create.controller');
    }
}
