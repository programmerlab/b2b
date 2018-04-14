<div class="ui selection dropdown search">
    <input type="hidden" name="{!! $name !!}" value="{!! $value or null !!}">
    <i class="dropdown icon"></i>
    <div class="default text">@lang('admin::public.selection')</div>
    <div class="menu">
        <div class="item" data-value="">
            @lang('admin::public.selection')
        </div>
        @foreach (config('definitions.icon', []) as $definitionRow)
            <div class="item" data-value="{!! $definitionRow['id'] !!}">
                @if($definitionRow['icon_type'] == 'image')
                    <img src="{!! $definitionRow['icon_src'] !!}" alt="icon" class="image small">
                @else
                    <i class="{!! $definitionRow['icon_src'] !!} pink"></i>
                @endif
                {!! $definitionRow['text']['title'] !!}
            </div>
        @endforeach
    </div>
</div>