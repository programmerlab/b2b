@foreach (config('tenant_langs') as $lang)
	<div class="ui tab right action input {!! $lang['id'] == lang('id') ? 'active' : '' !!}" data-tab="lang{!! $id !!}Tab-{!! $lang['id'] !!}">
		<div class="ui tag multiple search selection dropdown fluid">
			<input
				name="{!! isset($name) ? str_replace('[lang]', '['.$lang['id'].']', $name) : 'texts['.$lang['id'].']['.$id.']' !!}"
				value=""
				type="hidden">
			<div class="default text">{!! $lang['name'] !!}</div>
			<div class="menu"></div>
		</div>
	</div>
@endforeach