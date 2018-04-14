<div class="ui selection dropdown">
    <input type="hidden" name="{!! $name !!}" value="{!! $value or null !!}">
    <i class="dropdown icon"></i>
    <div class="default text">@lang('admin::public.selection')</div>
    <div class="menu">
        <div class="item" data-value="yes">
            <div class="ui empty circular label olive vertical"></div>
            @lang('admin::public.active')
        </div>
        <div class="item" data-value="no">
            <div class="ui empty circular label vertical"></div>
            @lang('admin::public.passive')
        </div>
    </div>
</div>