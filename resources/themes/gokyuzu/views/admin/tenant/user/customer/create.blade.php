@extends('admin::layout.box')

@section('boxContent')
    <form id="{!! $appRouter['current']['as'] !!}" data-action="{!! route_action('add') !!}" class="ui form">
        <div class="ui button submit transition hidden"></div>
        <input name="_token" value="{{ csrf_token() }}" type="hidden">

        <div class="ui grid">
            <div class="two wide column">
                <div class="field">
                    <label for="">Kullanıcı Resmi</label>
                    @include('admin::_parts.image.one', $dataAvatar)
                </div>
            </div>
            <div class="fourteen wide column">
                <div class="field">
                    <label for="">Kullanıcı Adı</label>
                    <input name="name" placeholder="Kullanıcı Adı" type="text">
                </div>
                <div class="field">
                    <label for="">Eposta Adresi</label>
                    <input name="email" placeholder="Eposta Adresi" type="email">
                </div>
                <div class="field">
                    <label for="">Şifre</label>
                    <input name="password" placeholder="Şifre" type="password">
                </div>
            </div>
        </div>
    
        <h3 class="ui header f600">Genel Bilgiler</h3>
        <div class="ui segment">
			<div class="two fields">
				<div class="field">
					<label for="">Dil</label>
					@include('admin::_parts.dropdown.icon', [
						'name' => 'accessory[lang]',
						'value' => lang('id'),
						'key' => 'name',
						'icon' => 'icon_text',
						'items' => config('tenant_langs')
					])
				</div>
				<div class="field">
					<label for="">Para Birimi</label>
					@include('admin::_parts.dropdown.icon', [
						'name' => 'accessory[currency]',
						'value' => currency('id'),
						'key' => 'name',
						'icon' => 'icon_text',
						'items' => config('currencies')
					])
				</div>
			</div>
            <div class="two fields">
                <div class="field">
                    <label for="">@lang($pathLang.'.namesurname')</label>
                    <input name="accessory[namesurname]" placeholder="@lang($pathLang.'.namesurname')" type="text">
                </div>
                <div class="field form-group">
                    <label for="">@lang($pathLang.'.gender')</label>
                    <div class="ui selection dropdown">
                        <input type="hidden" name="accessory[gender]" value="">
                        <i class="dropdown icon"></i>
                        <div class="default text">@lang('admin::public.selection')</div>
                        <div class="menu">
                            <div class="item" data-value="woman">
                                <i class="woman icon"></i>
                                @lang($pathLang.'.woman')
                            </div>
                            <div class="item" data-value="man">
                                <i class="man icon"></i>
                                @lang($pathLang.'.man')
                            </div>
                        </div>
                    </div>
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
                name    : ['empty', 'maxLength[65]'],
                email   : ['empty', 'maxLength[96]', 'email'],
                password: ['empty', 'minLength[6]']
            });
        });
    </script>
@stop