@if (check_route_access('create'))
    <a
        href="{!! isset($appRouter['methods']['create']['modal']) ? $appRouter['methods']['create']['modal'] : $appRouter['methods']['create']['url'] !!}"
        title="{!! $appRouter['methods']['create']['title'] !!}"
        class="ui icon button primary">
        <i class="icon route method {!! $appRouter['methods']['create']['code'] !!}"></i>
        <span>
            {!! $appRouter['methods']['create']['title'] !!}
        </span>
    </a>
@endif
@if (check_route_access('update'))
    <a
        id="{!! $appRouter['methods']['update']['as'] !!}"
        onclick="App.form.submit('#{!! $appRouter['current']['as'] !!}')"
        title="{!! $appRouter['methods']['update']['title'] !!}"
        class="ui icon button green {!! $appRouter['methods']['update']['method'] !!}">
        <i class="icon route method {!! $appRouter['methods']['update']['code'] !!}"></i>
        <span>
            @lang('admin::public.save')
        </span>
    </a>
@endif