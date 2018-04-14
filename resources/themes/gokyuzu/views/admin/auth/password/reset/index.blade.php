@extends('admin::layout.auth')

@section('main')
    <h1 class="ui header font600">@lang($pathLang.'.reset')</h1>
    <form id="{!! $appRouter['current']['as'] !!}" data-action="{!! route_action('check') !!}" class="ui large form">
        <input name="_token" value="{{ csrf_token() }}" type="hidden">
        <input name="token" value="{{ request('token') }}" type="hidden">
        
        <div class="ui segment">
            <div class="field form-group">
                <label for="">@lang($pathLang.'.form.email')</label>
                <input name="email" value="{{ request('email') }}" placeholder="@lang($pathLang.'.form.email')" type="email">
            </div>
            
            <div class="field form-group">
                <label>@lang($pathLang.'.form.newPassword')</label>
                <input name="password" class="form-control" placeholder="@lang($pathLang.'.form.newPassword')" type="password">
            </div>
            
            <div class="field form-group">
                <label>@lang($pathLang.'.form.newPasswordConfirmation')</label>
                <input name="password_confirmation" class="form-control" placeholder="@lang($pathLang.'.form.newPasswordConfirmation')" type="password">
            </div>
        </div>
        
        <div class="field form-group text right">
            <div class="ui submit button labeled icon green">
                <i class="check icon"></i> @lang('admin::public.submit')
            </div>
        </div>
    </form>
@stop

@section('jsCode')
    @parent
    <script>
        $(document).ready(function () {
            App.form.validate('#{!! $appRouter['current']['as'] !!}', {
                email                : ['empty', 'email', 'maxLength[96]'],
                password             : ['empty', 'minLength[6]', 'maxLength[30]'],
                password_confirmation: ['match[password]', 'empty']
            });
        });
    </script>
@stop