@extends('admin::layout.box')

@section('boxContent')
    <div class="ui cards four">
        @foreach($rows as $row)
            <div id="row-{!! $appRouter['current']['as'] !!}-{!! $row['id'] !!}" class="ui special card">
                <div class="content">
                    <a href="{!! $row['link'] !!}" target="_blank">
                        <img class="right floated mini ui image" src="{!! $row['assets'].'image/author.png' !!}">
                    </a>
                    <div class="header">{!! ucfirst($row['title']) !!}</div>
                    <div class="meta">{!! $row['author'] !!}</div>
                    <div class="description">{!! $row['description'] !!}</div>
                </div>
                <div class="blurring dimmable image">
                    <div class="ui dimmer">
                        <div class="content">
                            <div class="center">
                                @if (check_route_access('edit'))
                                    <a
                                        href="{!! isset($appRouter['methods']['edit']['modal']) ? "javascript:App.load('#modalUrlData','".route_action('edit', $row['id'])."')" : route_action('edit', $row['id']) !!}"
                                        class="ui massive teal button icon {!! $appRouter['methods']['edit']['method'] !!}">
                                        <i class="icon settings"></i>
                                    </a>
                                @endif
                                @if (check_route_access('destroy'))
                                    <a data-action="{!! route_action('destroy', $row['id']) !!}"
                                       class="modalDelete ui massive button red icon {!! $appRouter['methods']['destroy']['method'] !!}">
                                        <i class="icon route method trash outline"></i>
                                    </a>
                                @endif
                            </div>
                        </div>
                    </div>
                    <img src="{!! $row['preview'] !!}" alt="">
                </div>
                <div class="destroy data">
                    <input name="id" value="{!! $row['id'] !!}" type="hidden">
                    <input name="row_id" value="#row-{!! $appRouter['current']['as'] !!}-" type="hidden">
                </div>
            </div>
        @endforeach
    </div>

    <div class="ui right floated">
        {!! $rows->appends(request()->only(['status']))->links() !!}
    </div>
@stop