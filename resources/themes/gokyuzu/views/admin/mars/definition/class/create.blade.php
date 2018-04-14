@extends('admin::layout.box')

@section('boxContent')
    <form id="{!! $appRouter['current']['as'] !!}" data-action="{!! route_action('add') !!}" class="ui form">
        <div class="ui button submit transition hidden"></div>
        <input name="_token" value="{{ csrf_token() }}" type="hidden">

        <div class="field lang">
            <label for="">Başlık</label>
            @include('admin::_parts.lang.lang', ['id' => 'title', 'layout' => 'text_create'])
        </div>

    </form>
@stop

@section('jsCode')
    @parent
    <script>
        $(document).ready(function() {
            App.form.validate('#{!! $appRouter['current']['as'] !!}', {
                /**/
            });
        });
    </script>
@stop