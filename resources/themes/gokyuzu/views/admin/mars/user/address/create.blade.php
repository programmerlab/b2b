@extends('admin::layout.load_box')

@section('boxContent')
    <form id="{!! $appRouter['current']['as'] !!}" data-action="{!! route_action('add') !!}" class="ui form">
        <div class="ui button submit transition hidden"></div>
        <input name="_token" value="{{ csrf_token() }}" type="hidden">
        <input name="user_id" value="{!! request('user') !!}" type="hidden">
    
        <div class="field">
            <div class="ui checkbox">
                <input name="default" value="yes" type="checkbox">
                <label>Geçerli adresim olarak ayarla</label>
            </div>
        </div>
        <div class="field">
            <label for="">Başlık</label>
            <input name="title" placeholder="Başlık" type="text">
        </div>
        <div class="field">
            <label for="">Ad & Soyad</label>
            <div class="ui labeled left action input">
                <div class="ui dropdown label">
                    <input type="hidden" name="name_tag" value="Mrs">
                    <div class="text">@lang($pathLang.'.mrs')</div>
                    <i class="dropdown icon"></i>
                    <div class="menu">
                        <div class="item" data-value="Mrs" data-text="@lang($pathLang.'.mrs')">
                            <i class="woman icon"></i>
                            @lang($pathLang.'.mrs')
                        </div>
                        <div class="item" data-value="Mr" data-text="@lang($pathLang.'.mr')">
                            <i class="man icon"></i>
                            @lang($pathLang.'.mr')
                        </div>
                    </div>
                </div>
                <input name="name" placeholder="Ad" type="text">
                <input name="surname" placeholder="Soyad" type="text">
            </div>
        </div>
        <div class="four fields">
            <div class="field">
                <label for="">Gsm</label>
                <input name="gsm" placeholder="Gsm" type="text">
            </div>
            <div class="field">
                <label for="">Sabit Telefon</label>
                <input name="phone" placeholder="Sabit Telefon" type="text">
            </div>
            <div class="field">
                <label for="">Fax</label>
                <input name="fax" placeholder="Fax" type="text">
            </div>
            <div class="field">
                <label for="">Eposta</label>
                <input name="email" placeholder="Eposta" type="email">
            </div>
        </div>
        <div class="four fields">
            <div class="field fill title" data-fill="#fillCity" data-child="#fillCity,#fillTown,#fillLocality" data-type="zone" data-uri="{!! route_name('zoneCityGetSearch') !!}?type=fill">
                <label for="">Ülke</label>
				@include('admin::_parts.dropdown.default', [
					'name' => 'country_zone_id',
					'value' => null,
					'key' => 'text.title',
					'items' => $countries
				])
            </div>
            <div id="fillCity" class="field fill title" data-fill="#fillTown" data-child="#fillTown,#fillLocality" data-type="zone" data-uri="{!! route_name('zoneTownGetSearch') !!}?type=fill">
                <label for="">İl</label>
                <div class="ui selection search dropdown">
                    <input type="hidden" name="city_zone_id" value="">
                    <i class="dropdown icon"></i>
                    <div class="default text">@lang('admin::public.selection')</div>
                    <div class="menu"></div>
                </div>
            </div>
            <div id="fillTown" class="field fill title" data-fill="#fillLocality" data-child="#fillLocality" data-type="zone" data-uri="{!! route_name('zoneLocalityGetSearch') !!}?type=fill">
                <label for="">İlçe</label>
                <div class="ui selection search dropdown">
                    <input type="hidden" name="town_zone_id" value="">
                    <i class="dropdown icon"></i>
                    <div class="default text">@lang('admin::public.selection')</div>
                    <div class="menu"></div>
                </div>
            </div>
            <div id="fillLocality" class="field title">
                <label for="">Semt</label>
                <div class="ui selection search dropdown">
                    <input type="hidden" name="locality_zone_id" value="">
                    <i class="dropdown icon"></i>
                    <div class="default text">@lang('admin::public.selection')</div>
                    <div class="menu"></div>
                </div>
            </div>
        </div>
        <div class="field">
            <label for="">Posta Kodu</label>
            <input name="pk" placeholder="Posta Kodu" type="text">
        </div>
        <div class="field">
            <label for="">Adres 1</label>
            <input name="address_1" placeholder="Adres 1" type="text">
        </div>
        <div class="field">
            <label for="">Adres 2</label>
            <input name="address_2" placeholder="Adres 2" type="text">
        </div>
        <div class="field">
            <label>Google Map Kordinat</label>
            <div class="ui action input">
                <input name="geo_location" value="" placeholder="Google Map Kordinat" type="text">
                <a class="ui icon button blue" href="javascript:App.tool.googleMap()">
                    <i class="marker icon"></i>
                </a>
            </div>
        </div>
    </form>
@stop

@section('jsCode')
    @parent
    <script>
        $(document).ready(function () {
            App.form.validate('#{!! $appRouter['current']['as'] !!}', {
                //
            });
            App.modal.open('#modalUrl', {closable: false});
        });
    </script>
@stop