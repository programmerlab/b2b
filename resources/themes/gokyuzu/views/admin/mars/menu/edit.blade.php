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
            <label for="">Görünüm</label>
            <div class="ui selection dropdown multiple">
                <input name="layout_path" value="{!! $row['layout_path'] !!}" type="hidden">
                <i class="dropdown icon"></i>
                <div class="default text">@lang('admin::public.selection')</div>
                <div class="menu">
                    <div class="item" data-value="vertical">@lang('public.vertical')</div>
                    <div class="item" data-value="horizontal">@lang('public.horizontal')</div>
                </div>
            </div>
        </div>
    </form>
@stop

@section('boxAfter')
	@parent
	<div id="menuLinkGetIndex"></div>
	<div id="buttonMenuLinkGetIndex"></div>
@stop

@section('jsCode')
    @parent
    <script>
        $(document).ready(function() {
            App.form.validate('#{!! $appRouter['current']['as'] !!}', {
                /**/
            });

			$('#buttonMenuLinkGetIndex').on('click', function() {
				App.load('#menuLinkGetIndex', '{!! route_name($appRouter['name'].'LinkGetIndex', 'menu='.$row['id']) !!}');
			});

			$('#buttonMenuLinkGetIndex').click();
        });
    </script>
@stop

@section('script')
	@parent
	<script src="{!! assets('js/plugin.min.js') !!}"></script>
@stop

@section('style')
	@parent
	<link href="{!! assets('css/plugin.min.css') !!}" rel="stylesheet">
@stop