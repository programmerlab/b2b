@foreach ($row['lang_tenant_texts'] as $text)
	<div class="ui tab right action input {!! $text['lang_id'] == lang('id') ? 'active' : '' !!}" data-tab="lang{!! $id !!}Tab-{!! $text['lang_id'] !!}">
		<div class="ui tag multiple search selection dropdown fluid">
			<input
				name="{!! isset($name) ? str_replace('[lang]', '['.$text['lang_id'].']', $name) : 'texts['.$text['lang_id'].']['.$id.']' !!}"
				value="{!! $text[$id] !!}"
				type="hidden">
			<div class="default text">{!! $text['name'] !!}</div>
			<div class="menu"></div>
		</div>
	</div>
@endforeach