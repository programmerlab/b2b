@extends('admin::layout.box')

@section('boxContent')
    <form id="{!! $appRouter['current']['as'] !!}" data-action="{!! route_action('add') !!}" class="ui form">
        <div class="ui button submit transition hidden"></div>
        <input name="_token" value="{{ csrf_token() }}" type="hidden">

        <div class="field">
            <label for="">Bayi Adı</label>
            <input name="name" placeholder="Bayi Adı" type="text">
        </div>

        <div class="field">
            <label for="">Bayi Kodu</label>
            <input name="code" placeholder="Bayi Kodu" type="text">
        </div>
    </form>
@stop

@section('jsCode')
    @parent
    <script>
        $(document).ready(function () {
            App.form.validate('#{!! $appRouter['current']['as'] !!}', {
                name: ['empty', 'maxLength[200]']
            });
        });
    </script>
@stop