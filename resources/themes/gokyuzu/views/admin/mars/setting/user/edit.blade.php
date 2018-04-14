@extends('admin::layout.box')

@section('boxContent')
    <form id="{!! $appRouter['current']['as'] !!}" data-action="{!! route_action('update') !!}" class="ui form">
        <div class="ui button submit transition hidden"></div>
        <input name="_token" value="{{ csrf_token() }}" type="hidden">
        <input name="id" value="{!! $row['id'] !!}" type="hidden">
        <input name="code" value="{!! $row['code'] !!}" type="hidden">
        <div class="field">
            <label for="">Giriş Yöntemi</label>
            <div class="ui selection dropdown">
                <input name="accessory[type]" value="{!! $row['type'] !!}" type="hidden">
                <i class="dropdown icon"></i>
                <div class="default text">@lang('admin::public.selection')</div>
                <div class="menu">
                    <div class="item" data-value="email">Eposta</div>
                    <div class="item" data-value="name">Kullanıcı Adı</div>
                </div>
            </div>
        </div>
        <div class="field">
            <label for="">Varsayılan Ziyaretçi Rolü</label>
			@include('admin::_parts.dropdown.default', [
				'name' => 'accessory[guest_role]',
				'value' => $row['guest_role'],
				'key' => 'text.title',
				'items' => $roles
			])
        </div>
        <div class="field">
            <label for="">Varsayılan Üye Rolü</label>
			@include('admin::_parts.dropdown.default', [
				'name' => 'accessory[user_role]',
				'value' => $row['user_role'],
				'key' => 'text.title',
				'items' => $roles
			])
        </div>
        <div class="field">
            <label for="">Varsayılan Root Rolü</label>
			@include('admin::_parts.dropdown.default', [
				'name' => 'accessory[root_role]',
				'value' => $row['root_role'],
				'key' => 'text.title',
				'items' => $roles
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