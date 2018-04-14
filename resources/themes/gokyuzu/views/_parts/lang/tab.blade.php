<div class="ui left right icon pointing dropdown button teal small">
    <span class="text">{!! lang('iso_code') !!}</span>
    <div class="menu">
        @foreach (config('langs') as $lang)
            <div
                data-tab="lang{!! $id !!}Tab-{!! $lang['id'] !!}"
                class="item {!! $lang['id'] == lang('id') ? 'active' : '' !!}"
                data-text="{!! $lang['iso_code'] !!}">
                <i class="{!! $lang['iso_code'] !!} flag"></i>
                {!! $lang['name'] !!}
            </div>
        @endforeach
    </div>
</div>