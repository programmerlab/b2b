@extends('admin::layout.box')

@section('boxContent')
    <div class="ui cards three">
        @foreach($rows as $row)
            <div id="row-{!! $appRouter['current']['as'] !!}-{!! $row['id'] !!}" class="ui card">
                <div class="content">
                    <a href="{!! $row['link'] !!}" target="_blank">
                        <img class="right floated ui image" src="{!! $row['assets'].'image/logo.png' !!}">
                    </a>
                    <div class="header">{!! ucfirst($row['name']) !!}</div>
                    <div class="meta">{!! $row['author'] !!}</div>
                    <div class="description">{!! $row['description'] !!}</div>
                </div>
                <div class="extra content">
                    <div class="ui icon buttons fluid">
                        @if (check_route_access('edit'))
                            <a
                                href="{!! isset($appRouter['methods']['edit']['modal']) ? "javascript:App.load('#modalUrlData','".route_action('edit', $row['id'])."')" : route_action('edit', $row['id']) !!}"
                                class="ui default button {!! $appRouter['methods']['edit']['method'] !!} ">
                                <i class="icon route method  {!! $appRouter['methods']['edit']['code'] !!}"></i>
                                {!! $appRouter['methods']['edit']['title'] !!}
                            </a>
                        @endif
                        @if (check_route_access('destroy'))
                            <a data-action="{!! route_action('destroy', $row['id']) !!}"
                               class="modalDelete ui button red {!! $appRouter['methods']['destroy']['method'] !!}">
                                <i class="icon route method download cloud"></i>
                                @lang('admin::public.uninstall')
                            </a>
                        @endif
                    </div>
                    <div class="destroy data">
                        <input name="id" value="{!! $row['id'] !!}" type="hidden">
                        <input name="row_id" value="#row-{!! $appRouter['current']['as'] !!}-" type="hidden">
                    </div>
                </div>
            </div>
        @endforeach
    </div>

    <div class="ui right floated">
        {!! $rows->appends(request()->only(['status']))->links() !!}
    </div>
@stop