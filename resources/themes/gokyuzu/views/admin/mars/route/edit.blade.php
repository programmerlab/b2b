@extends('admin::layout.load_box')

@section('boxContent')
    <form id="{!! $appRouter['current']['as'] !!}" data-action="{!! route_action('update') !!}" class="ui form">
        <div class="ui button submit transition hidden"></div>
        <input name="_token" value="{{ csrf_token() }}" type="hidden">
        <input name="id" value="{!! $row['id'] !!}" type="hidden">
        <input name="parent_id" value="{!! $row['parent_id'] !!}" type="hidden">

        <div class="field lang">
            <label for="">Başlık</label>
            @include('admin::_parts.lang.lang', ['id' => 'title', 'layout' => 'text_edit'])
        </div>

        <div class="field lang">
            <label for="">Ana Bağlantı Adresi</label>
            @include('admin::_parts.lang.lang', ['id' => 'url', 'layout' => 'text_edit'])
        </div>

        <div class="field">
            <label for="">Metodlar</label>
            <div class="ui selection dropdown multiple">
                <input type="hidden" name="methods" value="{!! $rowMethods !!}">
                <i class="dropdown icon"></i>
                <div class="default text">Metodlar</div>
                <div class="menu">
                    @foreach (config('route.methods') as $method)
                        <div class="item" data-value="{!! $method['code'] !!}">{!! $method['title'] !!}</div>
                    @endforeach
                </div>
            </div>
        </div>

        <div class="fields two">
            <div class="field">
                <label for="">Ad</label>
                <input name="name" value="{!! $row['name'] !!}" placeholder="Ad" type="text">
            </div>
            <div class="field">
                <label for="">Controller Sınıf Adı</label>
                <input name="controller" value="{!! $row['controller'] !!}" placeholder="Controller Sınıf Adı" type="text">
            </div>
        </div>

        <div class="two fields">
            <div class="field">
                <label for="">Dil Klasörü</label>
                <input name="lang_path" value="{!! $row['lang_path'] !!}" placeholder="Dil Klasörü" type="text">

            </div>
            <div class="field">
                <label for="">Şablon Klasörü</label>
                <input name="layout_path" value="{!! $row['layout_path'] !!}" placeholder="Şablon Klasörü" type="text">
            </div>
        </div>
    </form>
@stop

@section('jsCode')
    @parent
    <script>
        $(document).ready(function() {
            App.form.validate('#{!! $appRouter['current']['as'] !!}', {
                //
            });
            App.modal.open('#modalUrl', {closable: false});
        });
    </script>
@stop