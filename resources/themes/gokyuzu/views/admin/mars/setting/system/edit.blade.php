@extends('admin::layout.box')

@section('boxContent')
    <form id="{!! $appRouter['current']['as'] !!}" data-action="{!! route_action('update') !!}" class="ui form">
        <div class="ui button submit transition hidden"></div>
        <input name="_token" value="{{ csrf_token() }}" type="hidden">
        <input name="id" value="{!! $row['id'] !!}" type="hidden">
        <input name="code" value="{!! $row['code'] !!}" type="hidden">
    
        <div class="field">
            <h3 class="ui header font600">
                Genel
            </h3>
            <div class="ui segment">
                <div class="field">
                    <label for="">Uygulama Türü</label>
                    <div class="ui selection dropdown">
                        <input name="accessory[type]" value="{!! $row['type'] !!}" type="hidden">
                        <i class="dropdown icon"></i>
                        <div class="default text">@lang('admin::public.selection')</div>
                        <div class="menu">
                            <div class="item" data-value="app">Uygulama</div>
                            <div class="item" data-value="site">Site</div>
                        </div>
                    </div>
                </div>
                <div class="field">
                    <label for="">Grup Rota</label>
                    <div class="ui selection dropdown">
                        <input name="accessory[group_route_id]" value="{!! $row['group_route_id'] !!}" type="hidden">
                        <i class="dropdown icon"></i>
                        <div class="default text">@lang('admin::public.selection')</div>
                        <div class="menu">
                            {!! $routeDropdown !!}
                        </div>
                    </div>
                </div>
                <div class="field">
                    <label for="">Rol Rota</label>
                    <div class="ui selection dropdown">
                        <input name="accessory[role_route_id]" value="{!! $row['role_route_id'] !!}" type="hidden">
                        <i class="dropdown icon"></i>
                        <div class="default text">@lang('admin::public.selection')</div>
                        <div class="menu">
                            {!! $routeDropdown !!}
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="field">
            <h3 class="ui header font600">
                Lokal
            </h3>
            <div class="ui segment">
                <div class="field">
                    <label for="">Varsayılan Dil</label>
					@include('admin::_parts.dropdown.icon', [
						'name' => 'accessory[lang]',
						'value' => $row['lang'],
						'key' => 'name',
						'icon' => 'icon_text',
						'items' => config('langs')
					])
                </div>
                <div class="field">
                    <label for="">Varsayılan Para Birimi</label>
					@include('admin::_parts.dropdown.icon', [
						'name' => 'accessory[currency]',
						'value' => $row['currency'],
						'key' => 'name',
						'icon' => 'icon_text',
						'items' => config('currencies')
					])
                </div>
            </div>
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