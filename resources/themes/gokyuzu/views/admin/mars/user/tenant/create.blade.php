@extends('admin::layout.load_box')

@section('boxContent')
    <form id="{!! $appRouter['current']['as'] !!}" data-action="{!! route_action('add') !!}" class="ui form">
        <div class="ui button submit transition hidden"></div>
        <input name="_token" value="{{ csrf_token() }}" type="hidden">
        <input name="user_id" value="{!! request('user') !!}" type="hidden">

        <div class="field">
            <label for="">Uygulama</label>
			@include('admin::_parts.dropdown.default', [
				'name' => 'app_id',
				'value' => null,
				'key' => 'name',
				'items' => $tenants
			])
        </div>

    </form>
@stop

@section('jsCode')
    @parent
    <script>
        $(document).ready(function() {
            App.form.validate('#{!! $appRouter['current']['as'] !!}', {
                //
            });
            App.modal.open('#modalUrl', {closable: false});
        });
    </script>
@stop