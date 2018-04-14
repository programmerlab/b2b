@extends('admin::layout.box')

@section('boxContent')
    <form id="{!! $appRouter['current']['as'] !!}" data-action="{!! route_action('update') !!}" class="ui form">
        <div class="ui button submit transition hidden"></div>
        <input name="_token" value="{{ csrf_token() }}" type="hidden">
        <input name="id" value="{!! $row['id'] !!}" type="hidden">

        <div class="ui grid">
            <div class="two wide column">
                <div class="field">
                    <label for="">Kullanıcı Resmi</label>
                    @include('admin::_parts.image.one', $dataAvatar)
                </div>
            </div>
            <div class="fourteen wide column">
                <div class="field">
                    <label for="">Ad Soyad</label>
                    <input name="name" placeholder="Ad Soyad" value="{!! $row['name'] !!}" type="text">
                </div>
                <div class="field">
                    <label for="">Eposta Adresi</label>
                    <input name="email" placeholder="Eposta Adresi" value="{!! $row['email'] !!}" type="email">
                </div>
                <div class="field">
                    <label for="">Şifre</label>
                    <input name="password" placeholder="Şifre" type="password">
                </div>
            </div>
        </div>
    </form>
@stop

@section('boxAfter')
    @parent
    <div class="ui fluid steps tabular no margin top bottom">
        <a class="step item active" data-tab="tabUserAddressGetIndex">
            <i class="marker icon"></i>
            <div class="content">
                <div class="title">Adresler</div>
                <div class="description">Detaylı adres tanımları</div>
            </div>
        </a>
        <a class="step item" data-tab="tabProcessInfo">
            <i class="alarm outline icon"></i>
            <div class="content">
                <div class="title">İşlemler</div>
                <div class="description">İşlem kayıtları ve personel notları</div>
            </div>
        </a>
    </div>
    <div style="min-height: 500px; margin-top: 20px">
        <div class="ui tab active" data-tab="tabUserAddressGetIndex">
            <div id="loadUserAddressGetIndex"></div>
            <div id="buttonUserAddressGetIndex"></div>
        </div>
        <div class="ui tab" data-tab="tabProcessInfo">
            <section class="ui stackable responsive grid state-overview">
                <div class="column twelve wide">
                    <div id="loadNoteGetIndex"></div>
                    <div id="buttonNoteGetIndex"></div>
                </div>
                <div class="column four wide">
                    <div id="loadLogGetIndex"></div>
                    <div id="buttonLogGetIndex"></div>
                </div>
            </section>
        </div>
    </div>
@stop

@section('jsCode')
    @parent
    <script>
        $(document).ready(function () {
            App.form.validate('#{!! $appRouter['current']['as'] !!}', {
                name: ['empty', 'maxLength[65]'],
                email: ['empty', 'maxLength[96]', 'email']
            });

            $('#buttonUserAddressGetIndex').on('click', function () {
                App.load('#loadUserAddressGetIndex', '{!! route_name('userAddressGetIndex', 'user='.$row['id']) !!}');
            });

            $('#buttonNoteGetIndex').on('click', function () {
                App.load('#loadNoteGetIndex', '{!! route_name('noteGetIndex', 'parent='.$row['id'].'&group=user&path='.request()->path()) !!}');
            });

            $('#buttonLogGetIndex').on('click', function () {
                App.load('#loadLogGetIndex', '{!! route_name('logGetIndex', 'layout=route&path='.request()->path()) !!}');
            });

            $('#buttonUserAddressGetIndex').click();
            $('#buttonNoteGetIndex').click();
            $('#buttonLogGetIndex').click();
        });
    </script>
@stop