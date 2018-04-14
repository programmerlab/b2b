@extends('admin::layout.box')

@section('boxContent')
    <form id="{!! $appRouter['current']['as'] !!}" data-action="{!! route_action('update') !!}" class="ui form">
        <div class="ui button submit transition hidden"></div>
        <input name="_token" value="{{ csrf_token() }}" type="hidden">
        <input name="id" value="{!! $row['id'] !!}" type="hidden">
        <input name="code" value="{!! $row['code'] !!}" type="hidden">
    
        <div class="field">
            <label for="">Varsayılan Admin Teması</label>
			@include('admin::_parts.dropdown.image', [
				'name' => 'accessory[admin]',
				'value' => $row['admin'],
				'key' => 'name',
				'image' => 'preview',
				'items' => $adminThemes
			])
        </div>
        <div class="field">
            <label for="">Varsayılan Site Teması</label>
			@include('admin::_parts.dropdown.image', [
				'name' => 'accessory[site]',
				'value' => $row['site'],
				'key' => 'name',
				'image' => 'preview',
				'items' => $siteThemes
			])
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