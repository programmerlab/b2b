@extends('admin::layout.box')

@section('boxContent')
    <form id="{!! $appRouter['current']['as'] !!}" data-action="{!! route_action('update') !!}" class="ui form">
        <div class="ui button submit transition hidden"></div>
        <input name="_token" value="{{ csrf_token() }}" type="hidden">
        <input name="theme_id" value="{!! $row['id'] !!}" type="hidden">
        <div class="tabs">
            <div class="ui fluid two item menu top attached tabular default">
                <a class="item active" data-tab="tabCommon">
                    <i class="settings icon"></i> Genel Ayarlar
                </a>
                <a class="item " data-tab="tabEditor">
                    <i class="file outline icon"></i> Editor
                </a>
            </div>
        </div>
        <div class="ui bottom attached tab active" data-tab="tabCommon">
            @include($pathLayout.'_parts.common')
        </div>
        <div class="ui bottom attached tab " data-tab="tabEditor">
            @include($pathLayout.'_parts.editor')
        </div>
    </form>
@stop

@section('style')
    @parent
    <link href="{!! assets('css/editor.min.css') !!}" rel="stylesheet">
@stop

@section('script')
    @parent
    <script src="{!! assets('js/editor.min.js') !!}"></script>
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