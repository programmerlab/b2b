@extends('admin::layout.box')

@section('boxContent')
    <form id="{!! $appRouter['current']['as'] !!}" data-action="{!! route_action('update') !!}" class="ui form">
        <div class="ui button submit transition hidden"></div>
        <input name="_token" value="{{ csrf_token() }}" type="hidden">
        <input name="id" value="{!! $row['id'] !!}" type="hidden">

        <div class="field lang">
            <label for="">Başlık</label>
            <input name="name" value="{{ $row['name'] }}" placeholder="Başlık" type="text">
        </div>

        <div class="field lang">
            <label for="">Konu</label>
            @include('admin::_parts.lang.tenant.lang', ['id' => 'subject', 'layout' => 'text_edit'])
        </div>

        <div class="field lang">
            <label for="">Mesaj</label>
            @include('admin::_parts.lang.tenant.lang', ['id' => 'content', 'layout' => 'editor_edit'])
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

            App.editor.tinymce();
        });
    </script>
@stop