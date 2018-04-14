@extends('admin::layout.box')

@section('boxContent')
    <form id="{!! $appRouter['current']['as'] !!}" data-action="{!! route_action('update') !!}" class="ui form">
        <div class="ui button submit transition hidden"></div>
        <input name="_token" value="{{ csrf_token() }}" type="hidden">
        <input name="id" value="{!! $row['id'] !!}" type="hidden">

        <div class="field">
            <label for="">Bayi Adı</label>
            <input name="name" value="{!! $row['name'] !!}" placeholder="Bayi Adı" type="text">
        </div>

        <div class="field">
            <label for="">Bayi Kodu</label>
            <input name="code" value="{{ $row['code'] }}" placeholder="Bayi Kodu" type="text">
        </div>
    </form>
@stop

@section('boxAfter')
    <div class="ui two steps tabular sekme sekme-tabs blue">
        <a class="step item active" data-tab="tabTenantSettings">
            <i class="settings icon"></i>
            <div class="content">
                <div class="title">@lang($pathLang.'.tabSetting')</div>
                <div class="description">@lang($pathLang.'.tabSettingDesc')</div>
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
            <div id="contentSiteAccessoryGetIndex"></div>
        </div>
        <div class="ui tab" data-tab="tabProcessInfo">
            <section class="ui stackable responsive grid state-overview">
                <div class="column ten wide">
                    <div id="loadNoteGetIndex"></div>
                    <div id="buttonNoteGetIndex"></div>
                </div>
                <div class="column six wide">
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

            App.load('#contentSiteAccessoryGetIndex', '{!! route_name('b2bTenantDealerSettingGetIndex', 'site='.$row['id']) !!}');

            $('#buttonNoteGetIndex').on('click', function() {
                App.load('#loadNoteGetIndex', '{!! route_name('noteGetIndex', 'parent='.$row['id'].'&group=tenant&path='.request()->path()) !!}');
            });

            $('#buttonLogGetIndex').on('click', function() {
                App.load('#loadLogGetIndex', '{!! route_name('logGetIndex', 'layout=route&path='.request()->path()) !!}');
            });

            $('#buttonNoteGetIndex').click();
            $('#buttonLogGetIndex').click();
        });
    </script>
@stop