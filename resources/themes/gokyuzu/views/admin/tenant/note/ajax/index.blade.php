@extends('admin::layout.load_box')

@section('boxContent')
    <div class="overflow500">
        <div class="ui comments" id="list-{!! $appRouter['current']['as'] !!}">
            @foreach($rows as $row)
                <div id="row-{!! $appRouter['current']['as'] !!}-{!! $row['id'] !!}" class="comment">
                    <div class="avatar">
                        <img src="{!! $row['user']['avatar'] or assets('image/avatar.png') !!}" alt="{!! $row['author'] !!}">
                    </div>
                    <div class="content">
                        <a class="author">{!! $row['author'] !!}</a>
                        <div class="metadata">
                            <div class="date">{!! $row['created_at']->diffForHumans() !!}</div>
                        </div>
                        <div class="text">
                            {!! $row['content'] !!}
                        </div>
                        @if ($user['id'] == $row['user_id'])
                            <div class="actions">
                                @include('admin::._parts.button.list')
                            </div>
                            <div class="destroy data">
                                <input name="id" value="{!! $row['id'] !!}" type="hidden">
                                <input name="row_id" value="#row-{!! $appRouter['current']['as'] !!}-" type="hidden">
                            </div>
                        @endif
                    </div>
                </div>
            @endforeach
        </div>
    </div>
@stop
@section('jsCode')
    @parent
    <script>
        $('#contentNoteGetIndex .box .ui.icons.buttons').remove();
    </script>
@stop