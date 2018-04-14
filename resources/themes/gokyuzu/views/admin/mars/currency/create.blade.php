@extends('admin::layout.box')

@section('boxContent')
    <form id="{!! $appRouter['current']['as'] !!}" data-action="{!! route_action('add') !!}" class="ui form">
        <div class="ui button submit transition hidden"></div>
        <input name="_token" value="{{ csrf_token() }}" type="hidden">

        <div class="field">
            <label for="">Başlık</label>
            <input name="name" type="text" placeholder="Başlık">
        </div>

        <div class="field">
            <label for="">Değer</label>
            <input name="conversion_rate" type="text" placeholder="Değer">
        </div>

        <div class="two fields">
            <div class="field">
                <label for="">ISO Kod</label>
                <input name="iso_code" type="text" placeholder="ISO Kod">
            </div>
            <div class="field">
                <label for="">Numeric ISO Kod</label>
                <input name="iso_code_num" type="text" placeholder="Numeric ISO Kod">
            </div>
        </div>

        <div class="two fields">
            <div class="field">
                <label for="">Sembol</label>
                <input name="symbol" type="text" placeholder="Sembol">
            </div>
            <div class="field">
                <label for="">Format</label>
                <input name="format" type="text" placeholder="Sembol">
            </div>
        </div>

        <div class="three fields">
            <div class="field">
                <label for="">Virgülden Sonra Kaç Basamak</label>
                <input name="step" type="text" placeholder="Virgülden Sonra Kaç Basamak">
            </div>
            <div class="field">
                <label for="">Ondalık Ayracı</label>
                <input name="decimal" type="text" placeholder="Ondalık Ayracı">
            </div>
            <div class="field">
                <label for="">Binler Ayracı</label>
                <input name="thousand" type="text" placeholder="Binler Ayracı">
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