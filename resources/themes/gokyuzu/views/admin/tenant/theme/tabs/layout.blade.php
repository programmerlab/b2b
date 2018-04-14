<div class="ui tabular menu large orange">
    @foreach ($layouts as $key => $layout)
        <a class="item {!! $key == 0 ? 'active' : null !!}" data-tab="layout-{!! $id !!}-{!! $layout['id'] !!}" onclick="$('#layout-{!! isset($site['ilayouts'][$layout['id']]) ? $site['ilayouts'][$layout['id']]['id'] : null !!} a.layout.reload').click()">
            {!! $layout['text']['title'] !!}
        </a>
    @endforeach
    <div class="ui dropdown icon item right">
        <i class="setting icon"></i>
        <div class="menu">
            <a class="item" href="javascript:App.load('#modalUrlData','{!! route_name('themeSiteLayoutGetEdit') !!}/{!! $site['id'] !!}')">
                <i class="recycle icon"></i> Şablon Kopyala
            </a>
        </div>
    </div>
</div>
@foreach ($layouts as $key => $layout)
    <input name="{!! $name !!}[{!! $layout['id'] !!}][layout_id]" value="{!! $layout['id'] !!}" type="hidden">
    <div id="layout-{!! isset($site['ilayouts'][$layout['id']]) ? $site['ilayouts'][$layout['id']]['id'] : null !!}" class="ui tab {!! $key == 0 ? 'active' : null !!}" data-tab="layout-{!! $id !!}-{!! $layout['id'] !!}">
        <div class="containers"></div>
        <div class="text right margin top twelve">
            <a class="ui button blue" href="javascript:App.load('#modalUrlData', '{!! route_name('themeSiteLayoutContainerGetCreate', 'theme='.(isset($site['theme_id']) ? $site['theme_id'] : null).'&layout=') !!}{!! isset($site['ilayouts'][$layout['id']]) ? $site['ilayouts'][$layout['id']]['id'] : null !!}')">
                <i class="plus icon"></i> Kapsayıcı Ekle
            </a>
        </div>
        <a class="layout reload" onclick="App.load('#layout-{!! isset($site['ilayouts'][$layout['id']]) ? $site['ilayouts'][$layout['id']]['id'] : null !!} .containers', '{!! route_name('themeSiteLayoutContainerGetIndex', 'layout=') !!}{!! isset($site['ilayouts'][$layout['id']]) ? $site['ilayouts'][$layout['id']]['id'] : null !!}')"></a>
    </div>
@endforeach