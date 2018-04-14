@extends('admin::layout.box')

@section('boxContent')
    <form id="{!! $appRouter['current']['as'] !!}" data-action="{!! route_action('add') !!}" class="ui form">
        <div class="ui button submit transition hidden"></div>
        <input name="_token" value="{{ csrf_token() }}" type="hidden">

        <div class="field">
            <label for="">Başlık</label>
            <input name="name" type="text" placeholder="Başlık">
        </div>
        <div class="four fields">
            <div class="field">
                <label for="">ISO Kod</label>
                <input name="iso_code" type="text" placeholder="ISO Kod">
            </div>
            <div class="field">
                <label for="">Dil Kodu</label>
                <input name="language_code" type="text" placeholder="Dil Kodu">
            </div>
            <div class="field">
                <label for="">Tarih Formatı</label>
                <input name="date_format_lite" type="text" placeholder="Tarih Formatı">
            </div>
            <div class="field">
                <label for="">Tam Tarih Formatı</label>
                <input name="date_format_full" type="text" placeholder="Tam Tarih Formatı">
            </div>
        </div>
    </form>
@stop

@section('jsCode')
    @parent
    <script>
        $(document).ready(function() {
            App.form.validate('#{!! $appRouter['current']['as'] !!}', {
                name: ['empty']
            });
        });
    </script>
@stop