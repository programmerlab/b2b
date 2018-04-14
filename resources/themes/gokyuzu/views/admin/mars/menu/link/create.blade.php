@extends('admin::layout.load_box')

@section('boxContent')
    <form id="{!! $appRouter['current']['as'] !!}" data-action="{!! route_action('add') !!}" class="ui form">
        <div class="ui button submit transition hidden"></div>
        <input name="_token" value="{{ csrf_token() }}" type="hidden">
        
        <input name="menu_id" value="{!! request('menu') !!}" type="hidden">
        
        <div class="field lang">
            <label for="">Başlık</label>
            @include('admin::_parts.lang.lang', ['id' => 'title', 'layout' => 'text_create'])
        </div>
        <div class="field lang">
            <label for="">Ana Bağlantı Adresi</label>
            @include('admin::_parts.lang.lang', ['id' => 'url', 'layout' => 'text_create'])
            <div class="ui input helper">
                Dış bağlantı oluşturmak için başına <u>http://</u> koymayı unutmayın. Örn: <u>http://google.com</u>
            </div>
        </div>
        <div class="ui accordion global field">
            <div class="title">
                <i class="icon dropdown"></i>
                Ekstra Özellikler
            </div>
            <div class="content field">
                <div class="fields two">
                    <div class="field">
                        <label for="">Link Yapısı</label>
                        <div class="ui selection dropdown">
                            <input type="hidden" name="accessory[target]" value="_self">
                            <i class="dropdown icon"></i>
                            <div class="default text">@lang('admin::public.selection')</div>
                            <div class="menu">
                                <div class="item" data-value="_self">
                                    <i class="reply icon"></i>
                                    Sayfa İçinde Aç
                                </div>
                                <div class="item" data-value="_target">
                                    <i class="share icon"></i>
                                    Ayrı Sayfada Aç
                                </div>
                            </div>
                        </div>
                    </div>
					<div class="field">
						<label for="">Icon</label>
						@include('admin::_parts.dropdown.icons', ['name' => 'accessory[icon_definition_id]'])
					</div>
                </div>
				<div class="field">
					<label for="">Link Html Class</label>
					<input name="accessory[item_class]" value="" placeholder="Link Html Class" type="text">
				</div>
                <div class="fields two">
                    <div class="field">
                        <label for="">Yazi Rengi</label>
                        <input name="accessory[text_color]" value="" class="color picker" placeholder="Yazı Rengi" type="text">
                    </div>
                    <div class="field">
                        <label for="">Arkaplan Rengi</label>
                        <input name="accessory[bg_color]" value="" class="color picker" placeholder="Arkaplan Rengi" type="text">
                    </div>
                </div>
            </div>
        </div>
    </form>
@stop

@section('jsCode')
    @parent
    <script>
        $(document).ready(function () {
            App.form.validate('#{!! $appRouter['current']['as'] !!}', {
                //
            });
            App.modal.open('#modalUrl', {closable: false});
        });
    </script>
@stop