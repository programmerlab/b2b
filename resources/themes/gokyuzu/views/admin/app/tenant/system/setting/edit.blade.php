@extends('admin::layout.box')

@section('boxContent')
    <form id="{!! $appRouter['current']['as'] !!}" data-action="{!! route_action('update') !!}" class="ui form">
        <div class="ui button submit transition hidden"></div>
        <input name="_token" value="{{ csrf_token() }}" type="hidden">
        <input name="id" value="{!! $row['id'] !!}" type="hidden">

        <h3 class="ui header font400">Genel Ayarlar</h3>
        <div class="ui segment">
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
        <h3 class="ui header font400">Firma Bilgileri</h3>
        <div class="ui segment">
            <div class="three fields">
                <div class="field">
                    <label>Resmi Adı</label>
                    <input name="accessory[store_realname]" value="{!! $row['store_realname'] !!}" placeholder="Resmi Adı" type="text">
                </div>
                <div class="field">
                    <label>Adı</label>
                    <input name="accessory[store_name]" value="{!! $row['store_name'] !!}" placeholder="Adı" type="text">
                </div>
                <div class="field">
                    <label>Firma Sahibi</label>
                    <input name="accessory[store_owner]" value="{!! $row['store_owner'] !!}" placeholder="Firma Sahibi" type="text">
                </div>
            </div>
            <div class="three fields">
                <div class="field">
                    <label>Eposta Adresi</label>
                    <div class="ui left icon input">
                        <i class="at icon"></i>
                        <input name="accessory[store_email]" value="{!! $row['store_email'] !!}" placeholder="Eposta Adresi" type="email">
                    </div>
                </div>
                <div class="field">
                    <label>Sabit Telefon</label>
                    <div class="ui left icon input">
                        <i class="call icon"></i>
                        <input name="accessory[store_phone]" value="{!! $row['store_owner'] !!}" class="telMask" placeholder="Sabit Telefon" type="text">
                    </div>
                </div>
                <div class="field">
                    <label>Fax</label>
                    <div class="ui left icon input">
                        <i class="fax icon"></i>
                        <input name="accessory[store_fax]" value="{!! $row['store_fax'] !!}" class="telMask" placeholder="Fax" type="text">
                    </div>
                </div>
            </div>
            <div class="field">
                <label>Adres</label>
                <div class="ui left icon input">
                    <i class="map icon"></i>
                    <input name="accessory[store_address]" value="{!! $row['store_address'] !!}" placeholder="Adres" type="text">
                </div>
            </div>
        </div>
    </form>
@stop

@section('jsCode')
    @parent
    <script>
        $(document).ready(function () {
            App.form.validate('#{!! $appRouter['current']['as'] !!}', {});
        });
    </script>
@stop