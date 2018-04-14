@extends('admin::layout.load_box')

@section('boxContent')
    <div class="tabs">
        <div class="ui three item menu top attached tabular default">
            <a class="item active" data-tab="tabSetting">
                <i class="linkify icon"></i> Genel Ayarlar
            </a>
            <a class="item" data-tab="tabPackage">
                <i class="archive icon"></i> Paket Ayarları
            </a>
            <a class="item" data-tab="tabCompany">
                <i class="building outline icon"></i> Firma Bilgileri
            </a>
        </div>
    </div>
    <form id="{!! $appRouter['current']['as'] !!}" data-action="{!! route_action('update') !!}" class="ui form">
        <div class="ui button submit transition hidden"></div>
        <input name="_token" value="{{ csrf_token() }}" type="hidden">
        <input name="id" value="{!! $row['id'] !!}" type="hidden">

        <div class="ui bottom attached tab active" data-tab="tabSetting">
            <div class="ui segment">
                <div class="field">
                    <label for="">Varsayılan Tema</label>
                    @include('admin::_parts.dropdown.image', [
                        'name' => 'accessory[theme]',
                        'value' => $row['theme'],
                        'key' => 'name',
                        'image' => 'preview',
                        'items' => $adminThemes
                    ])
                </div>
                <div class="field">
                    <label for="">Aktif Diller</label>
                    @include('admin::_parts.dropdown.icon', [
                        'name' => 'accessory[langs]',
                        'value' => $row['langs'],
                        'key' => 'name',
                        'icon' => 'icon_text',
                        'items' => config('langs'),
                        'multiple' => true
                    ])
                </div>
                <div class="field">
                    <label for="">Aktif Para Birimleri</label>
                    @include('admin::_parts.dropdown.icon', [
                        'name' => 'accessory[currencies]',
                        'value' => $row['currencies'],
                        'key' => 'name',
                        'icon' => 'icon_text',
                        'items' => config('currencies'),
                        'multiple' => true
                    ])
                </div>
                <div class="two fields">
                    <div class="field">
                        <label for="">Varsayılan Dil</label>
                        @include('admin::_parts.dropdown.icon', [
                            'name' => 'accessory[lang]',
                            'value' => $row['lang'],
                            'key' => 'name',
                            'icon' => 'icon_text',
                            'items' => config('langs')
                        ])
                    </div>

                    <div class="field">
                        <label for="">Varsayılan Para Birimi</label>
                        @include('admin::_parts.dropdown.icon', [
                            'name' => 'accessory[currency]',
                            'value' => $row['currency'],
                            'key' => 'name',
                            'icon' => 'icon_text',
                            'items' => config('currencies')
                        ])
                    </div>
                </div>
                <div class="field">
                    <label for="">Plasiyer/Saha Elemanı Rolü</label>
                    @include('admin::_parts.dropdown.default', [
                        'name' => 'accessory[plasiyer_role_id]',
                        'value' => $row['plasiyer_role_id'],
                        'key' => 'title',
                        'items' => $roles
                    ])
                </div>
            </div>
        </div>
        <div class="ui bottom attached tab " data-tab="tabPackage">
            <div class="ui segment">
                <div class="field">
                    <label for="">Stok Limiti</label>
                    <input name="accessory[quantity_limit]" value="{{ $row['quantity_limit'] }}"
                           placeholder="Stok Limiti" type="number">
                </div>
                <div class="field">
                    <label for="">Cari Limiti</label>
                    <input name="accessory[dealer_limit]" value="{{ $row['dealer_limit'] }}" placeholder="Cari Limiti"
                           type="number">
                </div>
            </div>
        </div>
        <div class="ui bottom attached tab " data-tab="tabCompany">
            <div class="three fields">
                <div class="field">
                    <label>Resmi Adı</label>
                    <input name="accessory[store_realname]" value="{!! $row['store_realname'] !!}"
                           placeholder="Resmi Adı" type="text">
                </div>
                <div class="field">
                    <label>Adı</label>
                    <input name="accessory[store_name]" value="{!! $row['store_name'] !!}" placeholder="Adı"
                           type="text">
                </div>
                <div class="field">
                    <label>Firma Sahibi</label>
                    <input name="accessory[store_owner]" value="{!! $row['store_owner'] !!}" placeholder="Firma Sahibi"
                           type="text">
                </div>
            </div>
            <div class="three fields">
                <div class="field">
                    <label>Eposta Adresi</label>
                    <div class="ui left icon input">
                        <i class="at icon"></i>
                        <input name="accessory[store_email]" value="{!! $row['store_email'] !!}"
                               placeholder="Eposta Adresi" type="email">
                    </div>
                </div>
                <div class="field">
                    <label>Sabit Telefon</label>
                    <div class="ui left icon input">
                        <i class="call icon"></i>
                        <input name="accessory[store_phone]" value="{!! $row['store_owner'] !!}" class="telMask"
                               placeholder="Sabit Telefon" type="text">
                    </div>
                </div>
                <div class="field">
                    <label>Fax</label>
                    <div class="ui left icon input">
                        <i class="fax icon"></i>
                        <input name="accessory[store_fax]" value="{!! $row['store_fax'] !!}" class="telMask"
                               placeholder="Fax" type="text">
                    </div>
                </div>
            </div>
            <div class="field">
                <label>Adres</label>
                <div class="ui left icon input">
                    <i class="map icon"></i>
                    <input name="accessory[store_address]" value="{!! $row['store_address'] !!}" placeholder="Adres"
                           type="text">
                </div>
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
        });
    </script>
@stop