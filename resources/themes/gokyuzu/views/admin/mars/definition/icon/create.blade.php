@extends('admin::layout.box')

@section('boxContent')
    <form id="{!! $appRouter['current']['as'] !!}" data-action="{!! route_action('add') !!}" class="ui form">
        <div class="ui button submit transition hidden"></div>
        <input name="_token" value="{{ csrf_token() }}" type="hidden">
        <div class="field lang">
            <label for="">Başlık</label>
            @include('admin::_parts.lang.lang', ['id' => 'title', 'layout' => 'text_create'])
        </div>
        <div class="two fields">
            <div class="field">
                <label for="">İkon</label>
                <div class="ui left icon input">
                    <input name="accessory[icon_src]" id="iconVal" value="" placeholder="İkon" type="text">
                    <i id="iconSrc" class=""></i>
                </div>
            </div>
            <div class="field">
                <label for="">İkon Türü</label>
                <div class="ui selection dropdown">
                    <input type="hidden" name="accessory[icon_type]" value="class">
                    <i class="dropdown icon"></i>
                    <div class="default text">@lang('admin::public.selection')</div>
                    <div class="menu">
                        <div class="item" data-value="image" data-tab="imageType">
                            <i class="image icon"></i>
                            Resim
                        </div>
                        <div class="item" data-value="class" data-tab="classType">
                            <i class="code icon"></i>
                            Html Class
                        </div>
                    </div>
                </div>
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
    
            $( "#iconVal" ).keyup(function() {
                $('#iconSrc').attr('class', $('#iconVal').val());
            });
        });
    </script>
@stop