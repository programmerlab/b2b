@extends('admin::layout.box')

@section('boxBefore')
    @parent
    <div class="ui fluid steps small tabular no margin top bottom">
        @foreach (tenant('sites') as $key => $site)
            <a class="step item {!! $key == 0 ? 'active' : '' !!}" data-tab="tabSite-{!! $key !!}">
                <i class="globe icon"></i>
                <div class="content">
                    <div class="title">{!! $site['name'] !!}</div>
                    <div class="description">Ait eklenti ayarları.</div>
                </div>
            </a>
        @endforeach
    </div>
@stop

@section('boxContent')
    <form id="{!! $appRouter['current']['as'] !!}" data-action="{!! route_action('update') !!}" class="ui form">
        <div class="ui button submit transition hidden"></div>
        <input name="_token" value="{{ csrf_token() }}" type="hidden">
        <input name="id" value="{!! $row['id'] !!}" type="hidden">

        @foreach (tenant('sites') as $key => $site)
            <div class="ui tab {!! $key == 0 ? 'active' : '' !!}" data-tab="tabSite-{!! $key !!}">
                <input name="site[{!! $site['id'] !!}][site_id]" value="{!! $site['id'] !!}" type="hidden">

                <div class="field">
                    <div class="ui selection dropdown">
                        <input type="hidden" name="site[{!! $site['id'] !!}][active]" value="{!! $sites[$site['id']]['active'] or '' !!}">
                        <i class="dropdown icon"></i>
                        <div class="default text">@lang('admin::public.selection')</div>
                        <div class="menu">
                            <div class="item" data-value="yes">
                                <div class="ui empty circular label olive vertical"></div>
                                Aktif
                            </div>
                            <div class="item" data-value="no">
                                <div class="ui empty circular label vertical"></div>
                                Pasif
                            </div>
                        </div>
                    </div>
                </div>
                @include($plugin_layout, [
                    'id'   => $site['id'],
                    'name' => 'site['.$site['id'].'][accessory]',
                    'val'  => isset($sites[$site['id']]) ? $sites[$site['id']] : $site
                ])
            </div>
        @endforeach
    </form>
@stop

@section('boxAfter')
    <div id="pluginBlockGetIndexContent"></div>
    <div id="buttonPluginBlockGetIndex"></div>
@stop

@section('jsCode')
    @parent
    <script>
        $(document).ready(function() {
            App.form.validate('#{!! $appRouter['current']['as'] !!}', {
                /**/
            });

            $('#buttonPluginBlockGetIndex').on('click', function() {
                App.load('#pluginBlockGetIndexContent', '{!! route_name('pluginBlockGetIndex', 'id='.$row['id']) !!}');
            });

            @if ($row['group_code'] == 'module')
                $('#buttonPluginBlockGetIndex').click();
            @endif
        });
    </script>
@stop