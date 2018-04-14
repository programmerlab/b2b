@extends('admin::layout.box')

@section('boxContent')
    <form id="{!! $appRouter['current']['as'] !!}" data-action="{!! route_action('update') !!}" class="ui form">
        <div class="ui button submit transition hidden"></div>
        <input name="_token" value="{{ csrf_token() }}" type="hidden">
        <input name="id" value="{!! $row['id'] !!}" type="hidden">

        <div class="field">
            <label for="">Bağlı Olduğu Kıta</label>
            <input name="parent_id" value="{!! $row['parent_id'] !!}" type="text" placeholder="Bağlı Olduğu Kıta">
        </div>

        <div class="field">
            <label for="">currency_id</label>
            <div class="ui selection dropdown fluid">
                <input name="currency_id" value="{!! $row['currency']['currency_id'] !!}" type="hidden">
                <i class="dropdown icon"></i>
                <div class="default text">@lang('admin::public.selection')</div>
                <div class="menu">
                    @foreach(config('currencies') as $currency)
                        <div class="item" data-value="{!! $currency['id'] !!}">
                            <i class="{!! $currency['small_iso_code'] !!} icon"></i>
                            {!! $currency['name'] !!}
                        </div>
                    @endforeach
                </div>
            </div>
        </div>

        <div class="field lang">
            <label for="">Başlık</label>
            @include('admin::_parts.lang.lang', ['id' => 'title', 'layout' => 'text_edit'])
        </div>

        <div class="three fields">
            <div class="field">
                <label for="">iso_code</label>
                <input name="iso_code" value="{!! $row['iso_code'] !!}" type="text" placeholder="iso_code">
            </div>
            <div class="field">
                <label for="">call_prefix</label>
                <input name="call_prefix" value="{!! $row['call_prefix'] !!}" type="text" placeholder="call_prefix">
            </div>
            <div class="field">
                <label for="">zip_code_format</label>
                <input name="zip_code_format" value="{!! $row['zip_code_format'] !!}" type="text" placeholder="zip_code_format">
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