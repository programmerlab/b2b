@if ($appRouter['current']['code'] == 'index' && check_route_access('export'))
	<a href="{!! route_action('export') !!}" class="item" target="_blank">
		<i class="sign out icon pink"></i> @lang('admin::public.resultExport')
	</a>
@endif
@if ($appRouter['current']['code'] == 'edit' && check_route_access('add'))
    <a onclick="App.form.copy('{!! $appRouter['methods']['add']['url'] !!}', '#{!! $appRouter['current']['as'] !!}')" class="item">
        <i class="icon olive route method copy"></i>
        @lang('admin::public.copy')
    </a>
@endif
@if ($appRouter['current']['code'] == 'index' && check_route_access('destroy'))
	<a data-action="{!! route_action('destroy') !!}" class="multiple destroy item {!! $appRouter['methods']['destroy']['method'] !!}">
		<i class="icon route method red {!! $appRouter['methods']['destroy']['code'] !!}"></i>
		@lang('admin::public.selectDestroy')
	</a>
@endif
<a href="/" class="item" target="_blank">
    <i class="life ring icon green"></i> @lang('admin::public.help')
</a>