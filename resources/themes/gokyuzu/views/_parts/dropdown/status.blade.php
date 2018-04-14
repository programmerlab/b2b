<div class="ui selection dropdown search {!! isset($multiple) ? 'multiple' : null !!}">
    <input type="hidden" name="{!! $name !!}" value="{!! $value or null !!}">
    <i class="dropdown icon"></i>
    <div class="default text">@lang('admin::public.selection')</div>
    <div class="menu">
        @if (!isset($multiple))
            <div class="item" data-value="0">
                @lang('admin::public.selection')
            </div>
        @endif
        @foreach (config('status.'.$type, []) as $statusRow)
            <div class="item" data-value="{!! $statusRow['id'] !!}" data-text="{!! $statusRow['text']['title'] !!}">
                <div class="ui empty circular label" style="background: {!! $statusRow['bg_color'] !!}"></div>
                {!! $statusRow['text']['title'] !!}
            </div>
        @endforeach
    </div>
</div>