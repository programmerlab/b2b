<?php

namespace Ribrit\Mars\Http\Middleware;

use Carbon\Carbon;
use Illuminate\Support\Facades\Config;
use Ribrit\Mars\Database\Contracts\Currency\CurrencyContract;
use Ribrit\Mars\Database\Contracts\Lang\LangContract;

trait Localization
{
    protected function localizationSet($request)
    {
        $this->langLocalizationSet($request);
        $this->currencyLocalizationSet($request);

        if ($request->currency_change) {
            $this->currencyChange($request);
        }

        if ($request->lang_change) {
            $this->langChange($request);
        }

        if (!lang('id')) {
            return error(4050);
        }

        if (!currency('id')) {
            return error(4060);
        }

        $this->appSet(lang('iso_code'));
    }

    protected function langLocalizationSet($request)
    {
        $langs = array_el_to_key(app(LangContract::class)->cacheRows(), 'id');
        Config::set('langs', $langs);

        if (!$request->session()->has('localization.lang.' . current_path())) {
            $request->session()->set('localization.lang.' . current_path(), setting('system.lang'));
        }
    }

    protected function currencyLocalizationSet($request)
    {
        $currencies = array_el_to_key(app(CurrencyContract::class)->cacheRows(), 'id');
        Config::set('currencies', $currencies);

        if (!$request->session()->has('localization.currency.' . current_path())) {
            $request->session()->set('localization.currency.' . current_path(), setting('system.currency'));
        }
    }

    protected function currencyChange($request)
    {
        if (config('currencies.'.$request->currency_change)) {
            $request->session()->set('localization.currency.' . current_path(), $request->currency_change);
        }
    }

    protected function langChange($request)
    {
        if (config('langs.'.$request->lang_change)) {
            $request->session()->set('localization.lang.' . current_path(), $request->lang_change);
        }
    }

    protected function appSet($isoCode)
    {
        Carbon::setLocale($isoCode);
        app()->setLocale($isoCode);
    }
}