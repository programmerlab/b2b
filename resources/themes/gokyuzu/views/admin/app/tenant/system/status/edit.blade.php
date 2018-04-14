@extends('admin::layout.box')

@section('boxContent')
    <form id="{!! $appRouter['current']['as'] !!}" data-action="{!! route_action('update') !!}" class="ui form">
        <div class="ui button submit transition hidden"></div>
        <input name="_token" value="{{ csrf_token() }}" type="hidden">
        <input name="id" value="{!! $row['id'] !!}" type="hidden">

        <div class="field lang">
            <label for="">Başlık</label>
            @include('admin::_parts.lang.tenant.lang', ['id' => 'title', 'layout' => 'text_edit'])
        </div>

        <div class="two fields">
            <div class="field">
                <label for="">Ikon</label>
				@include('admin::_parts.dropdown.icons', ['name' => 'icon_definition_id', 'value' => $row['icon_definition_id']])
            </div>
            <div class="field">
                <label for="">Yazı Rengi</label>
                <input name="text_color" value="{!! $row['text_color'] !!}" placeholder="Yazı Rengi" type="text">
            </div>
            <div class="field">
                <label for="">Arkaplan Rengi</label>
                <input name="bg_color" value="{!! $row['bg_color'] !!}" placeholder="Arkaplan Rengi" type="text">
            </div>
        </div>

        <div class="field">
            <label for="">Sıra</label>
            <input name="row" value="{!! $row['row'] !!}" placeholder="Sıra" type="number">
        </div>

    </form>
@stop

@section('style')
    @parent
    <link href="{!! assets('css/plugin.min.css') !!}" rel="stylesheet">
@stop

@section('script')
    @parent
    <script src="{!! assets('js/plugin.min.js') !!}"></script>
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