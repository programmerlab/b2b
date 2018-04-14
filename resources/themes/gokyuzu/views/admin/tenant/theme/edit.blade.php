@extends('admin::layout.box')

@section('boxBefore')
    @parent
    <div class="ui fluid steps small code-tab no margin top bottom">
        @foreach (tenant('sites') as $key => $site)
            <a class="step item {!! $key == 0 ? 'active' : '' !!}" data-tab="tabSite-{!! $key !!}">
                <i class="globe icon"></i>
                <div class="content">
                    <div class="title">{!! $site['name'] !!}</div>
                    <div class="description">Ait tema ayarları</div>
                </div>
            </a>
        @endforeach
    </div>
@stop

@section('boxContent')
    <form id="{!! $appRouter['current']['as'] !!}" data-action="{!! route_action('update') !!}" class="ui form">
        <div class="ui button submit transition hidden"></div>
        <input name="_token" value="{{ csrf_token() }}" type="hidden">
        <input name="theme_id" value="{!! $row['id'] !!}" type="hidden">
        @foreach (tenant('sites') as $key => $site)
            <div class="ui tab {!! $key == 0 ? 'active' : '' !!}" data-tab="tabSite-{!! $key !!}">
                <input name="site[{!! $site['id'] !!}][site_id]" value="{!! $site['id'] !!}" type="hidden">
                <div class="tabs">
                    <div class="ui fluid three item menu top attached tabular default">
                        <a class="item active" data-tab="tabCommon-{!! $key !!}">
                            <i class="settings icon"></i> Genel Ayarlar
                        </a>
                        <a class="item " data-tab="tabEditor-{!! $key !!}">
                            <i class="file outline icon"></i> Editor
                        </a>
                        <a class="item " data-tab="tabLayout-{!! $key !!}">
                            <i class="columns icon"></i> Modul Yerleşimi
                        </a>
                    </div>
                </div>
                <div class="ui tab active" data-tab="tabCommon-{!! $key !!}">
                    @include($pathLayout.'tabs.common', [
                        'id'   => $site['id'],
                        'name' => 'site['.$site['id'].'][accessory]',
                        'val'  => isset($sites[$site['id']]) ? $sites[$site['id']] : $site
                    ])
                </div>
                <div class="ui tab " data-tab="tabEditor-{!! $key !!}">
                    @include($pathLayout.'tabs.editor', [
                        'id'   => $site['id'],
                        'name' => 'site['.$site['id'].'][accessory]',
                        'val'  => isset($sites[$site['id']]) ? $sites[$site['id']] : $site
                    ])
                </div>
            </div>
        @endforeach
    </form>
@stop

@section('jsCode')
    @parent
    <script>
        $(document).ready(function() {
            App.form.validate('#{!! $appRouter['current']['as'] !!}', {
                /**/
            });

            $('.code-tab .item, .tabular .item').tab({
                onLoad : function() {
                    $('.CodeMirror').each(function(i, el){
                        el.CodeMirror.refresh();
                    });
                }
            });

            $('.code.mirror').each(function(key, val) {
                App.editor.mirror($(this).attr('id'));
            });
        });
    </script>
@stop

@section('cssCode')
    @parent
    <style>
        .ui.segment.grids.row {
            padding-left: 0;
            padding-right: 0;
        }
    </style>
@stop

@section('style')
    @parent
    <link href="{!! assets('css/editor.min.css') !!}" rel="stylesheet">
@stop

@section('script')
    @parent
    <script src="{!! assets('js/editor.min.js') !!}"></script>
@stop
