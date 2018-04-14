@extends('admin::layout.box')

@section('boxContent')
    <form id="{!! $appRouter['current']['as'] !!}" data-action="{!! route_action('update') !!}" class="ui form">
        <div class="ui button submit transition hidden"></div>
        <input name="_token" value="{{ csrf_token() }}" type="hidden">
        <input name="id" value="{!! $row['id'] !!}" type="hidden">

        <div class="field lang">
            <label for="">Başlık</label>
            @include('admin::_parts.lang.lang', ['id' => 'title', 'layout' => 'text_edit'])
        </div>
    
        <div class="field">
            <label for="">Renk Kodu</label>
            <input name="accessory[color]" value="{{ $row['color'] }}" placeholder="Renk Kodu" class="color picker" type="text">
        </div>
    </form>
@stop

@section('jsCode')
    @parent
    <script>
        $(document).ready(function() {
            App.form.validate('#{!! $appRouter['current']['as'] !!}', {
                /**/
            });
        });
    </script>
@stop

@section('style')
    @parent
    <link href="{!! assets('css/plugin.min.css') !!}" rel="stylesheet">
@stop

@section('script')
    @parent
    <script src="{!! assets('js/plugin.min.js') !!}"></script>
@stop