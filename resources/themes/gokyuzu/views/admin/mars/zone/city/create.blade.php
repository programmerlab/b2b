@extends('admin::layout.box')

@section('boxContent')
    <form id="{!! $appRouter['current']['as'] !!}" data-action="{!! route_action('add') !!}" class="ui form">
        <div class="ui button submit transition hidden"></div>
        <input name="_token" value="{{ csrf_token() }}" type="hidden">

        <div class="field">
            <label for="">Bağlı Olduğu Ülke</label>
            <input name="parent_id" type="text" placeholder="Bağlı Olduğu Ülke">
        </div>

        <div class="field lang">
            <label for="">Başlık</label>
            @include('admin::_parts.lang.lang', ['id' => 'title', 'layout' => 'text_create'])
        </div>

        <div class="two fields">
            <div class="field">
                <label for="">iso_code</label>
                <input name="iso_code" type="text" placeholder="iso_code">
            </div>
            <div class="field">
                <label for="">call_prefix</label>
                <input name="call_prefix" type="text" placeholder="call_prefix">
            </div>
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