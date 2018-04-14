@if (check_route_access('create'))
    <a
        href="{!! isset($appRouter['methods']['create']['modal']) ? "javascript:App.load('#modalUrlData','".$appRouter['methods']['create']['url']."')" : $appRouter['methods']['create']['url'] !!}"
        title="{!! $appRouter['methods']['create']['title'] !!}"
        class="ui icon button primary">
        <i class="icon route method {!! $appRouter['methods']['create']['code'] !!}"></i>
        <span>
            {!! $appRouter['methods']['create']['title'] !!}
        </span>
    </a>
@endif