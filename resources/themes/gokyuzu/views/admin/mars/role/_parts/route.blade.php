<h3 class="ui top attached header">
    Rota İzinleri
</h3>
<div class="ui attached secondary segment">
    <input id="routeAccess" name="routeAccess" value="{!! join(',', $roleAccessRoute) !!}" type="hidden">
    <div class="tabs" style="margin: -15px -15px 15px -15px;">
        <div class="ui tabular menu default three item large {!! number_to_words(count(config('groups.route'))) !!}">
            @foreach (config('groups.route') as $key => $group)
                <a class="item ui button {!! $key == 'admin' ? 'active' : '' !!}" data-tab="routeTab-{!! $key !!}">
                    {!! $group['text']['title'] !!}
                </a>
            @endforeach
        </div>
    </div>
    @foreach (config('groups.route') as $key => $group)
        <div class="ui tab {!! $key == 'admin' ? 'active' : '' !!}" data-tab="routeTab-{!! $key !!}">
            @foreach (isset($accessRoute[$group['id']]) ? $accessRoute[$group['id']] : [] as $groupRoute)
                <div class="ui card fluid group route access">
                    <div class="content grey">
                        <div class="right floated meta">
                            <div id="routeCheckbox-{!! $groupRoute['id'] !!}" class="ui checkbox all select">
                                <input id="route-{!! $groupRoute['id'] !!}" type="checkbox" data-class=".route-{!! $groupRoute['id'] !!}" data-id="routeCheckbox-{!! $groupRoute['id'] !!}" tabindex="0" class="hidden">
                                <label for="route-{!! $groupRoute['id'] !!}"> @lang('admin::public.selectall')</label>
                            </div>
                        </div>
                        <div class="header">
                            <div class="ui breadcrumb">
                                @foreach ($groupRoute['parents'] ? $groupRoute['parents'] : [] as $parent)
                                    @foreach ($parent['parents'] ? $parent['parents'] : [] as $parent2)
                                        @foreach ($parent2['parents'] ? $parent2['parents'] : [] as $parent3)
                                            <a href="{!! $parent3['text']['url'] !!}" class="section" target="_blank">
                                                {!! $parent3['text']['title'] !!}
                                            </a>
                                            <i class="right chevron icon divider"></i>
                                        @endforeach
                                        <a href="{!! $parent2['text']['url'] !!}" class="section" target="_blank">
                                            {!! $parent2['text']['title'] !!}
                                        </a>
                                        <i class="right chevron icon divider"></i>
                                    @endforeach
                                    <a href="{!! $parent['text']['url'] !!}" class="section" target="_blank">
                                        {!! $parent['text']['title'] !!}
                                    </a>
                                    <i class="right chevron icon divider"></i>
                                @endforeach
                                <a href="{!! $groupRoute['text']['url'] !!}" class="section" target="_blank">
                                    {!! $groupRoute['text']['title'] !!}
                                </a>
                            </div>
                        </div>
                    </div>
                    <div class="content">
                        <div class="ui stackable responsive grid eight column">
                            @foreach($groupRoute['links'] as $link)
                                <div class="column">
                                    <div class="ui checkbox route-{!! $link['route_id'] !!}">
                                        <input {!! isset($roleAccessRoute[$link['id']]) ? 'checked' : '' !!} value="{!! $link['id'] !!}" type="checkbox" tabindex="0" class="route access">
                                        <label for="">{!! $link['method']['text']['title'] !!}</label>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    @endforeach
</div>