@extends('admin::layout.box')

@section('boxContent')
    <form id="{!! $appRouter['current']['as'] !!}" data-action="{!! route_action('update') !!}" class="ui form">
        <div class="ui button submit transition hidden"></div>
        <input name="_token" value="{{ csrf_token() }}" type="hidden">
        <input name="id" value="{!! $row['id'] !!}" type="hidden">

        <div class="field">
            <label for="">Kiracı Adı</label>
            <input name="name" value="{!! $row['name'] !!}" placeholder="Kiracı Adı" type="text">
        </div>
        <div class="two fields">
            <div class="field">
                <label for="">Kişisel Anahtar</label>
                <input value="{!! $row['private_key'] !!}" placeholder="Kişisel Anahtar" type="text">
            </div>
            <div class="field">
                <label for="">Genel Anahtar</label>
                <input value="{!! $row['public_key'] !!}" placeholder="Genel Anahtar" type="text">
            </div>
        </div>
    </form>
@stop

@section('boxAfter')
    @parent
    <div class="ui fluid steps tabular no margin top bottom">
        <a class="step item active" data-tab="tabTenantSettings">
            <i class="settings icon"></i>
            <div class="content">
                <div class="title">Ayarlar</div>
                <div class="description">Müşteriye özel ayarlar</div>
            </div>
        </a>
        <a class="step item" data-tab="tabTenantDomains">
            <i class="linkify icon"></i>
            <div class="content">
                <div class="title">Alan Adları</div>
                <div class="description">Müşteriye özel bağlanacak alan adları</div>
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
        <div class="ui tab active" data-tab="tabTenantSettings">
            <div id="contentTenantBaseAccessoryGetIndex"></div>
        </div>
        <div class="ui tab" data-tab="tabTenantDomains">
            <div id="loadTenantDomainGetIndex"></div>
            <div id="buttonTenantDomainGetIndex"></div>
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
        $(document).ready(function() {
            App.form.validate('#{!! $appRouter['current']['as'] !!}', {
                name : ['empty', 'maxLength[200]']
            });

            App.load('#contentTenantBaseAccessoryGetIndex', '{!! route_name('tenantBaseAccessoryGetIndex', 'tenant='.$row['id']) !!}');

	        $('#buttonTenantDomainGetIndex').on('click', function() {
		        App.load('#loadTenantDomainGetIndex', '{!! route_name('tenantDomainGetIndex', 'tenant='.$row['id']) !!}');
	        });

	        $('#buttonNoteGetIndex').on('click', function() {
		        App.load('#loadNoteGetIndex', '{!! route_name('noteGetIndex', 'parent='.$row['id'].'&group=tenant&path='.request()->path()) !!}');
	        });

	        $('#buttonLogGetIndex').on('click', function() {
		        App.load('#loadLogGetIndex', '{!! route_name('logGetIndex', 'layout=route&path='.request()->path()) !!}');
	        });

	        $('#buttonTenantDomainGetIndex').click();
	        $('#buttonNoteGetIndex').click();
	        $('#buttonLogGetIndex').click();
        });
    </script>
@stop