@if ($row['active'] == 'yes')
    @if (check_route_access('active'))
        <button
            data-id="{!! $row['id'] !!}"
            data-actionactive="{!! route_action('active') !!}"
            data-actionpassive="{!! route_action('passive') !!}"
            class="ui toggle button active red negative icon">
            <i class="unhide icon"></i>
        </button>
    @endif
@else
    @if (check_route_access('passive'))
        <button
            data-id="{!! $row['id'] !!}"
            data-actionactive="{!! route_action('active') !!}"
            data-actionpassive="{!! route_action('passive') !!}"
            class="ui toggle button red negative icon">
            <i class="hide icon"></i>
        </button>
    @endif
@endif
