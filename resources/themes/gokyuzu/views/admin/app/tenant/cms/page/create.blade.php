@extends('admin::layout.box')

@section('boxContent')
    <form id="{!! $appRouter['current']['as'] !!}" data-action="{!! route_action('add') !!}" class="ui form">
        <div class="ui button submit transition hidden"></div>
        <input name="_token" value="{{ csrf_token() }}" type="hidden">
        <div class="field">
            <label for="">Başlık</label>
            <input name="title" value="" placeholder="Başlık" type="text">
        </div>
        <div class="field">
            <label for="">İçerik</label>
            <textarea name="content" class="editor"></textarea>
        </div>
    </form>
@stop

@section('jsCode')
    @parent
    <script>
        $(document).ready(function () {
            App.form.validate('#{!! $appRouter['current']['as'] !!}', {});
            App.editor.tinymce();
        });
    </script>
@stop

@section('style')
    @parent
    <link href="{!! assets('css/editor.min.css') !!}" rel="stylesheet">
    <link href="{!! assets('css/plugin.min.css') !!}" rel="stylesheet">
@stop

@section('script')
    @parent
    <script src="{!! assets('js/editor.min.js') !!}"></script>
    <script src="{!! assets('js/plugin.min.js') !!}"></script>
@stop