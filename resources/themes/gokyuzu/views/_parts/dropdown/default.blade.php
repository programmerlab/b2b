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
        @foreach ($items as $item)
            <div class="item" data-value="{!! $item['id'] !!}">
                {{ array_get($item, $key, null) }}
            </div>
        @endforeach
    </div>
</div>