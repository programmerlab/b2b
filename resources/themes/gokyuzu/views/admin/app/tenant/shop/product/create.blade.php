@extends('admin::layout.box')

@section('boxContent')
    <form id="{!! $appRouter['current']['as'] !!}" data-action="{!! route_action('add') !!}" class="ui form">
        <div class="ui button submit transition hidden"></div>
        <input name="_token" value="{{ csrf_token() }}" type="hidden">

        <div class="field">
            <label for="">Kategoriler</label>
            <div class="ui fluid multiple normal selection dropdown">
                <input name="categories" type="hidden">
                <i class="dropdown icon"></i>
                <div class="default text">Kategoriler</div>
                <div class="menu">{!! $categoryDropdowns !!}</div>
            </div>
        </div>
        <div class="field">
            <label for="">Marka</label>
            @include('admin::_parts.dropdown.default', [
                'name' => 'brand_id',
                'value' => null,
                'items' => $brands,
                'key' => 'title'
            ])
        </div>
        <div class="field">
            <div class="ui grid">
                <div class="fourteen wide column">
                    <div class="field">
                        <label for="">Başlık</label>
                        <input name="title" value="" placeholder="Başlık" type="text">
                    </div>
                    <div class="two fields">
                        <div class="field">
                            <label for="">Stok Kodu</label>
                            <input name="sku" value="{!! uniqid() !!}" placeholder="Stok Kodu" type="text">
                        </div>
                        <div class="field">
                            <label for="">Stok Miktarı</label>
                            <input name="quantity" value="" placeholder="Stok Miktarı" type="number">
                        </div>
                    </div>
                    <div class="field">
                        <label for="">Fiyat</label>
                        <input name="price" placeholder="Fiyat" type="text">
                    </div>
                </div>
                <div class="two wide column">
                    <div class="field">
                        <label for="">Resim</label>
                        @include('admin::_parts.image.one', [
                            'id' => 'ProductImage',
                            'name' => 'image',
                            'value' => '',
                        ])
                    </div>
                </div>
            </div>
        </div>

        <div class="ui header">Bağlı Ürünler</div>
        <div class="ui segment">
            @for ($i = 1; $i <= 10; $i++)
                <div class="four fields">
                    <div class="field">
                        <label for="">Başlık</label>
                        <input name="relations[{!! $i !!}][title]" value="" placeholder="Başlık" type="text">
                    </div>
                    <div class="field">
                        <label for="">Stok Kodu</label>
                        <input name="relations[{!! $i !!}][sku]" value="" placeholder="Stok Kodu" type="text">
                    </div>
                    <div class="field">
                        <label for="">Adet</label>
                        <input name="relations[{!! $i !!}][quantity]" value="" placeholder="Adet" type="text">
                    </div>
                    <div class="field">
                        <label for="">Birim Fiyatı</label>
                        <input name="relations[{!! $i !!}][price]" value="" placeholder="Birim Fiyatı" type="text">
                    </div>
                </div>
            @endfor
        </div>
    </form>
@stop

@section('jsCode')
    @parent
    <script>
        $(document).ready(function () {
            App.form.validate('#{!! $appRouter['current']['as'] !!}', {
                /**/
            });

            $('.field.short.description textarea').each(function (key, val) {
                $(val).attr('rows', 6);
            });

            App.editor.tinymce();
            App.tool.date.datetimepicker('.datetimepicker');
        });
    </script>
@stop

@section('style')
    @parent
    <link href="{!! assets('css/editor.min.css') !!}" rel="stylesheet">
    <link href="{!! assets('css/plugin.min.css') !!}" rel="stylesheet">
@stop

@section('script')
    @parent
    <script src="{!! assets('js/editor.min.js') !!}"></script>
    <script src="{!! assets('js/plugin.min.js') !!}"></script>
@stop