@extends('admin::layout.box')

@section('boxContent')
    <form id="{!! $appRouter['current']['as'] !!}" data-action="{!! route_action('add') !!}" class="ui form">
        <div class="ui button submit transition hidden"></div>
        <input name="_token" value="{{ csrf_token() }}" type="hidden">
        <div class="field">
            <label for="">Başlık</label>
            <input name="title" value="" placeholder="Başlık" type="text">
        </div>

        @include($pathLayout.'_parts.route')
    </form>
@stop

@section('jsCode')
    @parent
    <script>
        $(document).ready(function () {
            App.form.validate('#{!! $appRouter['current']['as'] !!}', {});

            $('.route.access').on('change', function () {
                var text = '';
                $.each($('.route.access:checked'), function (i, el) {
                    text += ',' + $(el).val();
                });
                $('#routeAccess').val(text.substring(1));
            });
        });
    </script>
@stop