@extends('admin::layout.auth')

@section('main')
    <div class="ui segment">
        <div class="text center">
            <h2 class="ui icon header font600 green">
                <i class="circular check icon"></i>
                <div class="content">
                    @lang('public.congratulations')
                    <div class="sub header">@lang($pathLang.'.success.send')</div>
                </div>
            </h2>
        </div>
    </div>
    <div class="text right">
        <a href="{!! route_name('adminAuthLoginGetIndex') !!}" class="ui right labeled icon button blue">
            <i class="right arrow icon"></i>
            @lang($pathLang.'.login')
        </a>
    </div>
@stop

@section('jsCode')
    @parent
    <script>
        $(document).ready(function() {
            App.form.validate('#{!! $appRouter['current']['as'] !!}', {
                //
            });
        });
    </script>
@stop