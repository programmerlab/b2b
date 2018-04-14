@extends('admin::layout.auth')

@section('main')
    <h1 class="ui header font600">@lang($pathLang.'.title')</h1>
    <div class="ui segment">
        <form id="{!! $appRouter['current']['as'] !!}" data-action="{!! route_action('check') !!}" class="ui large form">
            <input name="_token" value="{{ csrf_token() }}" type="hidden">
            <p class="no margin top">
                @lang($pathLang.'.form.message')
            </p>
            <div class="field">
                <div class="ui left icon action input ">
                    <i class="mail outline icon"></i>
                    <input name="email" placeholder="@lang($pathLang.'.form.email')" type="email">
                    <div class="ui green submit button icon" title="@lang($pathLang.'.form.next')">
                        <i class="check icon"></i>
                    </div>
                </div>
            </div>
        </form>
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