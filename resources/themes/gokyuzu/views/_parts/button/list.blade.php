<div>
    <div>
        @if (check_route_access('edit'))
            <a
                href="{!! isset($appRouter['methods']['edit']['modal']) ? "javascript:App.load('#modalUrlData','".route_action('edit', $row['id'])."')" : route_action('edit', $row['id']) !!}"
                class="item {!! $appRouter['methods']['edit']['method'] !!}">
                <i class="icon route method green {!! $appRouter['methods']['edit']['code'] !!}"></i>
                {!! $appRouter['methods']['edit']['title'] !!}
            </a>
        @endif

        @if (check_route_access('destroy'))
            <a data-action="{!! route_action('destroy', $row['id']) !!}" class="modal delete item {!! $appRouter['methods']['destroy']['method'] !!}">
                <i class="icon route method red {!! $appRouter['methods']['destroy']['code'] !!}"></i>
                {!! $appRouter['methods']['destroy']['title'] !!}
            </a>
        @endif
    </div>
</div>