<?php

namespace Ribrit\Mars\Http\Controllers;

use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Lang;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Request;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\View;
use Ribrit\Tenant\Database\Contracts\Draft\DraftContract;

abstract class Controller extends BaseController
{
	use DispatchesJobs, ValidatesRequests;

	/**
	 * Rota bilgisi
	 *
	 * @sea RouteMiddleware
	 */
	protected $appRouter;

	/**
	 * Group bilgisi
	 *
	 * @sea GroupMiddleware
	 */
	protected $appGroup;

	/**
	 * Siteyi kullanan kişi bilgisi
	 *
	 * @var
	 */
	protected $user;

	/**
	 * İlgili sınıfının contract sınıfı
	 *
	 * @var Contract
	 */
	protected $contract;

	/**
	 * Yapıda kullanılacak dizin yapısını tutar
	 *
	 * @var string
	 */
	protected $pathNamespace = '';

	/**
	 * Şablon dosyasının tam yolu
	 *
	 * @var string
	 */
	protected $pathLayout = '';

	/**
	 * Dil dosyasının tam yolu
	 *
	 * @var string
	 */
	protected $pathLang = '';

	/**
	 * Şablon adı rota kodundan farklı ise
	 *
	 * @var null
	 */
	protected $layoutCode = null;

	/**
	 * Meta etiketleri
	 *
	 * @var array
	 */
	protected $metaData = [];

	/**
	 * Json verisinde bulunması gereken zorunlu alanlar
	 *
	 * @var array
	 */
	protected $jsonFormData = [
		'success' => '',
		'error'   => '',
		'data'    => '',
	];

	/**
	 * Şablona gönderilecek tüm data
	 *
	 * @var array
	 */
	protected $data = [];

	public function __construct()
	{
		$this->appRouter     = Request::getRouter();
		$this->appGroup      = Request::getGroup();
		$this->pathNamespace = setting('system.currentPath') . '::';
		$this->user          = Auth::user();

		$this->createLangPath();
	}

	/**
	 * Varsayılan değişken değerleri
	 *
	 * @return void
	 */
	protected function defaultData()
	{
		$this->data['pathLang']   = $this->pathLang;
		$this->data['pathLayout'] = substr($this->pathLayout, 0, strlen($this->pathLayout) - strlen($this->appRouter->current['code']));
		$this->data['user']       = $this->user;
		$this->data['appRouter']  = $this->appRouter;
		$this->data['meta']       = $this->createMetaTag();
	}

	/**
	 * Kullanılan temaya ait şablon
	 *
	 * @param array $data
	 * @return mixed
	 */
	protected function layout(array $data = [])
	{
		$this->createLayoutPath();
		$this->defaultData();

		return $this->response(array_merge($this->data, $data));
	}

	/**
	 * Görünüm
	 *
	 * @param $with
	 * @return mixed
	 */
	protected function response($with)
	{
		if (Request::get('json') == 'true') {
			return Response::json($with, 200);
		}

		return View::make($this->pathLayout)
		           ->with($with);
	}

	/**
	 * Meta etiketleri
	 *
	 * @return array
	 */
	protected function createMetaTag()
	{
		$code  = $this->appRouter->current['code'];
		$title = $this->appRouter->text->title;

		if ($code != 'index') {
			$title = $this->getLangValue($code);
		}

		$meta = [
			'title'       => $title,
			'description' => '',
			'keywords'    => '',
			'favicon'     => theme('favicon'),
			'base'        => url('/'),
			'canonical'   => Request::url(),
			'author'      => '',
			'image'       => url(theme('logo')),
			'rss'         => url('/rss'),
		];

		return array_merge($meta, $this->metaData);
	}

	/**
	 * createFormData
	 *
	 * @param array $data
	 * @return array
	 */
	protected function createFormData(array $data = [])
	{
		return $this->jsonFormData = array_merge($this->jsonFormData, $data);
	}

	/**
	 * responseFormData
	 *
	 * @param int $code
	 * @return mixed
	 */
	protected function responseFormData($code = 400)
	{
		return Response::json($this->jsonFormData, $code);
	}

	/**
	 * Hata sayfası
	 *
	 * @param int  $code
	 * @param null $layout
	 * @return mixed
	 */
	protected function errorHandler($code = 404, $layout = null)
	{
		return error($code, $layout);
	}

	/**
	 * İlgili sınıfın dil dosyasını yükler
	 *
	 * @param $key
	 * @return mixed
	 */
	protected function getLangValue($key)
	{
		return Lang::get($this->pathLang . '.' . $key);
	}

	/**
	 * Genel dil değerleri
	 *
	 * @param $key
	 * @return mixed
	 */
	protected function getPublicLangValue($key)
	{
		return Lang::get('public.' . $key);
	}

	/**
	 * Dil dosya yolu
	 *
	 * @return void
	 */
	protected function createLangPath()
	{
		$code = $this->appRouter->group->code;

		if ($code == 'components') {
			$code = 'plugins/' . str_slug(Request::segment(3));
		} else {
			$code = 'admin';
		}

		return $this->pathLang = join('/', [
			$this->pathNamespace . $code,
			str_replace('.', '/', $this->appRouter->lang_path)
		]);
	}

	/**
	 * Şablon dosya yolu
	 *
	 * @return void
	 */
	protected function createLayoutPath()
	{
		$code = $this->appRouter->group->code;

		if ($code == 'components') {
			$code = 'plugins.' . str_slug(Request::segment(3));
		} else {
			$code = 'admin';
		}

		return $this->pathLayout = join('.', [
			$this->pathNamespace . $code,
			$this->appRouter->layout_path,
			$this->layoutCode ? $this->layoutCode : $this->appRouter->current['code']
		]);
	}

	/**
	 * Standart mail gönderimi
	 *
	 * @param $data
	 * @return mixed
	 */
	protected function draftMail($data)
	{
		$config  = config('mail');
		$draft   = app(DraftContract::class)->row($data['draft']);
		$message = str_replace($config['find'], $data['replace'], $draft->text->content);
		$subject = $draft->text->subject;

		return Mail::send('email.draft', ['draft' => $message], function ($mail) use ($data, $subject, $config) {

			$mail->subject($subject);
			$mail->from($config['from']['address'], $config['from']['name']);
			$mail->to($data['to']['email'], $data['to']['name']);
		});
	}
}