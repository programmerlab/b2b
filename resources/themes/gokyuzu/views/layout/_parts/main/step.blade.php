@if ($appRouter['parent']['childs'])
	<div class="ui fluid steps small">
		@foreach ($appRouter['parent']['childs'] as $child)
			@if (check_role_access_route($child['mainLink']['id']))
				<a class="step {!! $child['id'] == $appRouter['id'] ? 'active' : '' !!}" href="{!! $child['mainLink']['text']['url'] !!}">
					<div class="content">
						<div class="title">{!! $child['text']['title'] !!}</div>
					</div>
				</a>
			@endif
		@endforeach
	</div>
@endif