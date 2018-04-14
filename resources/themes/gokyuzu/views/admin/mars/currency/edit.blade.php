@extends('admin::layout.box')

@section('boxContent')
    <form id="{!! $appRouter['current']['as'] !!}" data-action="{!! route_action('update') !!}" class="ui form">
        <div class="ui button submit transition hidden"></div>
        <input name="_token" value="{{ csrf_token() }}" type="hidden">
        <input name="id" value="{!! $row['id'] !!}" type="hidden">

        <div class="field">
            <label for="">Başlık</label>
            <input name="name" value="{!! $row['name'] !!}" type="text" placeholder="Başlık">
        </div>

        <div class="field">
            <label for="">Değer</label>
            <input name="conversion_rate" value="{!! $row['conversion_rate'] !!}" type="text" placeholder="Değer">
        </div>

        <div class="two fields">
            <div class="field">
                <label for="">ISO Kod</label>
                <input name="iso_code" value="{!! $row['iso_code'] !!}" type="text" placeholder="ISO Kod">
            </div>
            <div class="field">
                <label for="">Numeric ISO Kod</label>
                <input name="iso_code_num" value="{!! $row['iso_code_num'] !!}" type="text" placeholder="Numeric ISO Kod">
            </div>
        </div>

        <div class="two fields">
            <div class="field">
                <label for="">Sembol</label>
                <input name="symbol" value="{!! $row['symbol'] !!}" type="text" placeholder="Sembol">
            </div>
            <div class="field">
                <label for="">Format</label>
                <input name="format" value="{!! $row['format'] !!}" type="text" placeholder="Sembol">
            </div>
        </div>

        <div class="three fields">
            <div class="field">
                <label for="">Virgülden Sonra Kaç Basamak</label>
                <input name="step" value="{!! $row['step'] !!}" type="text" placeholder="Virgülden Sonra Kaç Basamak">
            </div>
            <div class="field">
                <label for="">Ondalık Ayracı</label>
                <input name="decimal" value="{!! $row['decimal'] !!}" type="text" placeholder="Ondalık Ayracı">
            </div>
            <div class="field">
                <label for="">Binler Ayracı</label>
                <input name="thousand" value="{!! $row['thousand'] !!}" type="text" placeholder="Binler Ayracı">
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