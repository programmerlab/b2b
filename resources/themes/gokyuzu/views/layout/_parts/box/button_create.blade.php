@if (check_route_access('add'))
    <a
        onclick="App.form.submit('#{!! $appRouter['current']['as'] !!}')"
        title="{!! $appRouter['methods']['add']['title'] !!}"
        class="ui icon button green {!! $appRouter['methods']['add']['method'] !!}">
        <i class="icon route method {!! $appRouter['methods']['add']['code'] !!}"></i>
        <span>
            @lang('admin::public.save')
        </span>
    </a>
@endif