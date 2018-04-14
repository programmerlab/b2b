<?php
/**
 * Kiracı bilgileri
 *
 * @param null $key
 * @return void
 */
function tenant($key = null)
{
    return $key ? config('tenant.' . $key) : config('tenant');
}

/**
 * Kiracıya ait site
 *
 * @param null $key
 * @return void
 */
function tenant_site($key = null)
{
    return $key ? tenant('site.' . $key) : tenant('site');
}

/**
 * Bileşen listesi
 *
 * @param null $key
 * @return mixed
 */
function tenant_component($key = null)
{
    return array_get(\Illuminate\Support\Facades\Cache::get(cache_name('components')), $key);
}

/**
 * Bileşen listesi
 *
 * @param null $key
 * @return mixed
 */
function component($key = null)
{
    return array_get(array_merge_recursive(default_component(), tenant_component()), $key);
}

/**
 * Temanın asset yolunu verir
 *
 * @param string $misc
 * @return string
 */
function assets($misc = '')
{
    return theme('assets') . $misc;
}

/**
 * Temanın ayarlarını verir
 *
 * @param string $key
 * @return string
 */
function theme($key = null)
{
    return $key ? config('theme.' . $key) : config('theme');
}

/**
 * plugin_run_service
 *
 * @param       $plugin
 * @param       $className
 * @param array $data
 * @return bool
 */
function plugin_run_service($plugin, $className, $data = [])
{
    $service            = new \Ribrit\Tenant\Services\PluginService();
    $service->plugin    = $plugin;
    $service->className = $className;
    $service->data      = $data;

    return $service->run();
}

/**
 * Durum format
 *
 * @param      $status
 * @param null $text
 * @param null $class
 * @return string
 */
function status_format($status, $text = null, $class = null)
{
    $class = $class ? $class : 'ui label';

    return '<div class="' . $class . '" style="background: ' . $status['bg_color'] . '; color: ' . $status['text_color'] . '">' . $text .icon($status['icon']). $status['text']['title'] . '</div>';
}

/**
 * İsimlendirmelere otoamtik olarak tenant id ekler
 *
 * @param $name
 * @return string
 */
function cache_name($name)
{
    return join('-', [
        tenant('id'),
        $name
    ]);
}

/**
 * Seo link oluşturur
 *
 * @param null $href
 * @return null
 */
function seo_href($href = null)
{
    return $href;
}

/**
 * Tanımlara bağlı olarak menuye uygun ikon yapısını verir
 *
 * @param $icon
 * @return string
 */
function menu_icon($icon)
{
    return icon($icon);
}

/**
 * tanım iconlara göre icon formatı oluşturur
 *
 * @param $icon
 * @return null|string
 */
function icon($icon)
{
    $html = null;

    if ($icon['icon_type'] == 'image') {
        $html = '<img src="' . $icon['icon_src'] . '" alt="icon">';
    } else if ($icon['icon_type'] == 'class') {
        $html = '<i class="' . $icon['icon_src'] . '"></i>';
    }

    return $html;
}

/**
 * Tenanta ait asset dosyalarının bulundugu dizin
 *
 * @param string $item
 * @return string
 */
function storage($item = '')
{
    return 'storage/' . tenant('id') . '/' . $item;
}

/**
 * @param $string
 * @return null|string|string[]
 */
function mikro_string($string)
{
	return mb_convert_encoding($string, "UTF-8", "ISO-8859-1");
}