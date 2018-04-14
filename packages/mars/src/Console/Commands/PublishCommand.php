<?php

namespace Ribrit\Mars\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;
use Ribrit\Mars\Services\ComponentService;

class PublishCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'mars:publish';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Public altına gönderilecek dosyalar için tarama yapıp ilgili dizinlere kopyalar';

    /**
     * Konsol açıklama
     *
     * @var string
     */
    protected $comment = 'Laravel, Mars uygulama yardımcısı ek yapılar yayına alındı!';

    /**
     * Dizin listesi
     *
     * @var array
     */
    protected $directories = [
        'resources/themes',
        'themes',
        'plugins',
        'storage',
        'storage/tenant',
        'storage/app',
        'storage/logs',
        'storage/framework',
        'storage/framework/cache',
        'storage/framework/sessions',
        'storage/framework/views',
        'public_html/storage'
    ];

    /**
     * Ek yükelenen paketlerin bilgileri
     *
     * @var array
     */
    protected $orderPackages = [
        'elfinder:publish'
    ];

    /**
     * Bileşen grupları
     *
     * @var array
     */
    protected $groups = [];

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $this->createDirectory($this->directories);
        $this->callOrderPackages();

        $this->components((new ComponentService()), [
            'themes',
            'plugins'
        ]);

        $this->comment($this->comment);
    }

    /**
     * Bileşenleri ilgili gruplara göre paylaş
     *
     * @param $service
     * @param $types
     */
    protected function components($service, $types)
    {
        foreach ($types as $type) {
            $this->groups[ $type ] = $service->get($type);
            $this->share($type);
        }
    }

    /**
     * Bileşenleri ayır
     *
     * @param $type
     */
    protected function share($type)
    {
        foreach ($this->groups[ $type ] as $key => $group) {
            foreach ($group as $component) {

                if (empty($component['info']['directory'])) {
                    continue;
                }

                $this->{'share'.Str::studly($type)}($component);

                $this->info($component['info']['name']. ' : bileşenine ait işlemler gerçekleştirildi!');
            }
        }
    }

    /**
     * Eklentiler
     *
     * @param $plugin
     */
    protected function sharePlugins($plugin)
    {
        $this->copyDirectory(
            base_path($plugin['info']['directory'] . 'resources/render/assets'),
            base_path('public_html' . $plugin['info']['assets']),
            true
        );

        foreach ($this->groups['themes'] as $themes) {
            foreach ($themes as $theme) {
                $this->pluginSycTheme($plugin, $theme);
            }
        }
    }

    /**
     * Plugine ait verileri yüklü temalara dağıt
     *
     * @param $plugin
     * @param $theme
     * @return bool
     */
    protected function pluginSycTheme($plugin, $theme)
    {
        //$this->databasePluginSycTheme($plugin, $theme);
        $this->viewPluginSycTheme($plugin, $theme);
        $this->langPluginSycTheme($plugin, $theme);

        return true;
    }

    /**
     * Dil dosyaları
     *
     * @param $plugin
     * @param $theme
     * @return bool
     */
    protected function langPluginSycTheme($plugin, $theme)
    {
        $directories = base_path($plugin['info']['directory'] . 'resources/lang/' . $theme['info']['group_code']);

        if (!File::exists($directories)) {
            return true;
        }

        foreach (File::directories($directories) as $directory) {
            $this->copyDirectory(
                $directory,
                base_path($theme['info']['directory'] . 'lang/' . File::name($directory) . '/plugins/' . $plugin['info']['group_code'] . '/' . $plugin['info']['name'])
            );
        }

        return true;
    }

    /**
     * Blade şablonları
     *
     * @param $plugin
     * @param $theme
     * @return bool
     */
    protected function viewPluginSycTheme($plugin, $theme)
    {
        $copyDirectory = base_path($theme['info']['directory'] . 'views/plugins/' . $plugin['info']['group_code'] . '/' . $plugin['info']['name']);

        if (File::exists($copyDirectory)) {
            return false;
        }

        return $this->copyDirectory(
            base_path($plugin['info']['directory'] . 'resources/views/' . $theme['info']['group_code']),
            $copyDirectory
        );
    }

    /**
     * Veri tabanı dosyaları
     *
     * @param $plugin
     * @return bool
     */
    protected function databasePluginSycTheme($plugin)
    {
        return $this->copyDirectory(
            base_path($plugin['info']['directory'] . 'database/migrations'),
            base_path('database/migrations')
        );
    }

    /**
     * Temalar
     *
     * @param $theme
     */
    protected function shareThemes($theme)
    {
        $this->copyDirectory(
            base_path($theme['info']['directory'] . 'render/assets'),
            base_path('public_html' . $theme['info']['assets']),
            true
        );
    }

    /**
     * İlgili dizin kontrolü yapıp dosyaların kopyalama işlemini gerçekleştirir
     *
     * @param      $path
     * @param      $target
     * @param bool $delete
     * @return bool
     */
    protected function copyDirectory($path, $target, $delete = false)
    {
        if (!File::exists($path)) {
            return false;
        }

        if ($delete) {
            File::deleteDirectory($target);
        }

        File::copyDirectory($path, $target);

        return true;
    }

    /**
     * Yardımcı paketleri yayınla
     *
     * @return bool
     */
    protected function callOrderPackages()
    {
        foreach ($this->orderPackages as $package) {
            $this->call($package);
        }

        return true;
    }

    /**
     * Tanımlanan klasörlerin varlığını kontrol et yoksa oluştur
     *
     * @param $directories
     * @return bool
     */
    protected function createDirectory($directories)
    {
        foreach ($directories as $directory) {

            $path = base_path($directory);

            if (File::exists($path)) {
                continue;
            }

            File::makeDirectory($path);
        }

        return true;
    }
}
