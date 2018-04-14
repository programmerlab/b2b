<?php

namespace Ribrit\Mars;

use Barryvdh\Debugbar\ServiceProvider as DebugbarServiceProvider;
use Barryvdh\Debugbar\Facade as Debugbar;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\ServiceProvider;
use Intervention\Image\Facades\Image;
use Intervention\Image\ImageServiceProvider;
use Laravel\Socialite\Facades\Socialite;
use Laravel\Socialite\SocialiteServiceProvider;
use Maatwebsite\Excel\ExcelServiceProvider;
use Maatwebsite\Excel\Facades\Excel;
use Ribrit\Elfinder\ElfinderServiceProvider;
use Ribrit\Mars\Providers\CommandProvider;
use Ribrit\Mars\Providers\ComponentServiceProvider;

class MarsServiceProvider extends ServiceProvider
{
    /**
     * Indicates if loading of the provider is deferred.
     *
     * @var bool
     */
    protected $defer = false;

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        $this->contracts();
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->registerProvider();
        $this->registerAliases();
    }

    /**
     * Get the services provided by the provider.
     *
     * @return array
     */
    protected function registerProvider()
    {
        $this->app->register(ComponentServiceProvider::class);
        $this->app->register(CommandProvider::class);
        $this->app->register(DebugbarServiceProvider::class);
        $this->app->register(ExcelServiceProvider::class);
        $this->app->register(ElfinderServiceProvider::class);
        $this->app->register(SocialiteServiceProvider::class);
        $this->app->register(ImageServiceProvider::class);
    }

    /**
     * Facedes
     *
     * @return void
     */
    protected function registerAliases()
    {
        $this->app->bind('Excel', Excel::class);
        $this->app->bind('Debugbar', Debugbar::class);
        $this->app->bind('Socialite', Socialite::class);
        $this->app->bind('Image', Image::class);
    }

    /**
     * Bağlantı kurulacak contractları listeler
     *
     * @return void
     */
    protected function contracts()
    {
        foreach ($this->getConfigRepositoryToContract() as $row) {

            if (is_array($row['name'])) {
                $this->contractName($row);
                continue;
            }

            $this->registerContract($row, $row['name']);
        }
    }

    /**
     * Aynı isim havuzunu kullanıyorlarsa
     *
     * @param $row
     * @return void
     */
    protected function contractName($row)
    {
        foreach ($row['name'] as $name) {
            $this->registerContract($row, $name);
        }
    }

    /**
     * Contract ve repository ilişkisi
     *
     * @param $row
     * @param $name
     * @return void
     */
    protected function registerContract($row, $name)
    {
        $this->app->bind(
            '\\' . $row['namespace'] . '\\Database\Contracts\\' . $row['path'] . '\\' . $name . 'Contract',
            '\\' . $row['namespace'] . '\\Database\Repositories\\' . $row['path'] . '\\' . $name . 'Repository'
        );
    }

    /**
     * Verilerin listesini ara
     *
     * @return array
     */
    protected function getConfigRepositoryToContract()
    {
        $configRepositories = config('mars.repositories');
        $components         = Cache::get('componentRepositoriesToContracts');

        return array_merge($configRepositories['core'], $components, $configRepositories['app']);
    }
}