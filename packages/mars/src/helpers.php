<?php

use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Request;
use Illuminate\Support\Facades\File;
use Symfony\Component\Yaml\Yaml;

/**
 * Genel ayarlar
 *
 * @param null $key
 * @return mixed
 */
function setting($key = null)
{
	return array_get(config('setting'), $key);
}

/**
 * Bileşen listesi
 *
 * @param null $key
 * @return mixed
 */
function default_component($key = null)
{
	return array_get(Cache::get('components'), $key);
}

/**
 * Aktif dil bilgisi
 *
 * @param null $key
 * @return mixed
 */
function lang($key = null)
{
	return array_get(config('langs.' . session('localization.lang.' . current_path())), $key);
}

/**
 * Aktif para birimi
 *
 * @param null $key
 * @return mixed
 */
function currency($key = null)
{
	return array_get(config('currencies.' . session('localization.currency.' . current_path())), $key);
}

/**
 * İlgili rota adına ait url adresi
 *
 * @param       $name
 * @param null  $query
 * @return mixed
 */
function route_name($name, $query = null)
{
	return $query ? config('route.names.' . $name . '.url') . '?' . $query : config('route.names.' . $name . '.url');
}

/**
 * url adresini modal da acılacak şekilde züenler
 *
 * @param $url
 * @return mixed|string
 */
function route_modal_url($url = '')
{
	return "javascript:App.load('#modalUrlData', '" . $url . "')";
}

/**
 * Para birimine uygun olarak formatını verir
 *
 * @param      $price
 * @param null $currency
 * @param null $rate
 * @return mixed
 */
function currency_format($price, $currency = null, $rate = null)
{
	if ($currency) {
		if (intval($currency)) {
			$currency = currency(null, $currency);
		}
	} else {
		$currency = currency();
	}

	$rate = $rate ? $rate : $currency['conversion_rate'];
	$style = number_format($price * $rate, $currency['step'], $currency['decimal'], $currency['thousand']);

	return str_replace([
		'%s',
		'%v'
	], [
		$currency['symbol'],
		$style
	], $currency['format']);
}

/**
 * Rol ve rota ilişkisine bağlı olarak ilgili metoda erşimini olup olmadıgını kontrol eder
 *
 * @param $method
 * @return bool
 */
function check_route_access($method)
{
	if (!$method = route_method($method)) {
		return false;
	}

	$roleRouteAccess = Request::getAccessRoute();

	if (!isset($roleRouteAccess[ $method['id'] ])) {
		return false;
	}

	if ($roleRouteAccess[ $method['id'] ] !== 'yes') {
		return false;
	}

	return true;
}

/**
 * Rol işlem durum kontrolü
 *
 * @param $routeLinkId
 * @return bool
 */
function check_role_access_route($routeLinkId)
{
	$routes = config('roleAccessRoute');

	if (!isset($routes[ $routeLinkId ])) {
		return false;
	}

	if ($routes[ $routeLinkId ]['status'] !== 'yes') {
		return false;
	}

	return true;
}

/**
 * Rota adına göre rolün erişimini kontrol eder
 *
 * @param $name
 * @return bool
 */
function chech_route_name($name)
{
	$names = config('route.names');

	if (!isset($names[ $name ])) {
		return false;
	}

	return check_role_access_route($names[ $name ]['original']['id']);
}

/**
 * Rotaya ait method var ise ilgili metodun url adresini verir
 *
 * @param        $method
 * @param string $join
 * @return null
 */
function route_action($method, $join = null)
{
	$route = getRoute();
	$data = [isset($route['methods'][ $method ]) ? $route['methods'][ $method ]['url'] : null];

	if ($join) {
		if (is_array($join)) {
			$data = array_merge($data, $join);
		} else {
			$data[] = $join;
		}
	}

	return join('/', $data);
}

/**
 * İlgili rotanın isteğe bağlı metodu
 *
 * @param $method
 * @return null
 */
function route_method($method)
{
	$route = getRoute();

	return isset($route['methods'][ $method ]) ? $route['methods'][ $method ] : null;
}

/**
 * İlgili rota bilgisi
 *
 * @return mixed
 */
function getRoute()
{
	return Request::getRouter();
}

/**
 * Rota tanımları için uygun isim formatı
 *
 * @param $name
 * @param $segment
 * @return string
 */
function route_name_format($name, $segment)
{
	return $name . ucfirst(Request::segment($segment));
}

/**
 * Bölgesel veriler
 *
 * @param null $type
 * @return array
 */
function locality($type = null)
{
	$data = [
		'langs' => config('langs'),
		'currencies' => config('currencies')
	];

	return $type ? $data[ $type ] : $data;
}

/**
 * Geçerli yapı
 *
 * @return string
 */
function current_path()
{
	return in_array('adminApp', Request::route()->middleware()) ? 'admin' : 'site';
}

/**
 * Kolay nestable menu oluşturulmasını saglar
 *
 * @param $rows
 * @param $theme
 * @return string
 */
function nestableArray($rows, $theme)
{
	$tree = new \Ribrit\Mars\Helpers\TreeMenuHelper();
	$tree->layout = $theme;

	return $tree->renderArray($rows, 0, []);
}

/**
 * Kolay nestable menu oluşturulmasını saglar
 *
 * @param       $rows
 * @param       $theme
 * @param array $compact
 * @return string
 */
function nestable($rows, $theme, $compact = [])
{
	$tree = new \Ribrit\Mars\Helpers\TreeMenuHelper();
	$tree->layout = $theme;

	return $tree->render($rows, 0, $compact);
}

/**
 * Gelen url adresini temizler
 *
 * @param string $url
 * @return mixed|string
 */
function url_clear($url = '')
{
	return str_replace([
		'http://',
		'www.'
	], [
		'',
		''
	], $url);
}

/**
 * İlgili anahtar değerini alıp dsiğer elemanları siler
 *
 * @param $rows
 * @param $el
 * @return array
 */
function array_el_to_el($rows, $el)
{
	$data = [];

	if (!$rows) {
		return $data;
	}

	foreach ($rows as $row) {
		$key = array_get($row, $el);
		$data[ $key ] = $key;
	}

	return $data;
}

/**
 * İlgili anahtar değere göre dizileri tekrardan oluşturur
 *
 * @param $rows
 * @param $el
 * @return array
 */
function array_el_to_key($rows = [], $el)
{
	$data = [];

	if (!$rows) {
		return $data;
	}

	foreach ($rows as $row) $data[ $row[ $el ] ] = $row;

	return $data;
}

/**
 * Blade için hazırlanmış ekstrra fonksiyon
 *
 * @param $rows
 * @return mixed
 */
function array_shuffle($rows)
{
	shuffle($rows);

	return $rows;
}

/**
 * İlgili değerin o dildeki karşılığını verir
 *
 * @param        $number
 * @param string $locale
 * @return mixed
 */
function number_to_words($number, $locale = null)
{
	return (new Numbers_Words)->toWords($number, $locale);
}

/**
 * İsteğe göre hata basar
 *
 * @param        $code
 * @param null   $layout
 * @param string $method
 * @return mixed
 */
function error($code, $layout = null, $method = 'view')
{
	$exception = new \Ribrit\Mars\Exceptions\ErrorHandler();

	if ($layout) {
		$exception->errorViewPath = $layout;
	}

	return $exception->$method($code);
}

/**
 * Yml uzantı dosyaları aç
 *
 * @param $path
 * @return mixed
 */
function yaml_parsed($path)
{
	if (!File::exists($path)) {
		return [];
	}

	return Yaml::parse(File::get($path));
}

/**
 * İlgili dizi içerisinde anahtar değerin varlıgını sorgular
 *
 * @param $data
 * @param $key
 * @return mixed
 */
function check_data_status($data, $key)
{
	return isset($data[ $key ]) ? $data[ $key ] : $data;
}

/**
 * Tanımlara bağlı olarak ikon yapısını verir
 *
 * @param $icon
 * @return string
 */
function def_icon($icon)
{
	$html = null;

	if ($icon['icon_type'] == 'image') {
		$html = '<img src="' . $icon['icon_src'] . '" alt="icon">';
	} else if ($icon['icon_type'] == 'class') {
		$html = '<div class="ui label icon"><i class="' . $icon['icon_src'] . '"></i></div>';
	}

	return $html;
}

/**
 * Mail formatında text oluşturur
 *
 * @param $data
 * @return string
 */
function create_key_mail($data)
{
	return $data . '@' . $data . '.com';
}

/**
 * Create api key
 *
 * @return bool|string
 */
function generate_api_key()
{
	$salt = sha1(time() . mt_rand());
	$newKey = substr($salt, 0, 40);

	return $newKey;
}