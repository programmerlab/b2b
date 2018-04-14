@extends('admin::layout.load_box')

@section('boxContent')
    <div class="overflow500">
        <div class="ui feed">
            @foreach ($rows as $row)
                <div class="event">
                    <div class="label">
                        <i class="icon log route method {!! $row['route']['event'] !!}"></i>
                    </div>
                    <div class="content">
                        <div class="date">
                            {!! $row['created_at']->diffForHumans() !!}
                        </div>
                        <div class="summary">
                            <a>{!! $row['user'] !!}</a>
                            @lang($pathLang.'.action', [
                                'path'  => $row['path'],
                                'title' => $row['route']['route']['text']['title'],
                                'event' => trans($pathLang . '.actions.' . $row['route']['event'])
                            ])
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
@stop

@section('jsCode')
    @parent
    <script>
        $('#contentLogGetIndex .box .ui.icons.buttons').remove();
    </script>
@stop