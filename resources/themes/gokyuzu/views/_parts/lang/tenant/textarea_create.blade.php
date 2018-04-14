@foreach (config('tenant_langs') as $lang)
    <div class="ui tab right action input {!! $lang['id'] == lang('id') ? 'active' : '' !!}" data-tab="lang{!! $id !!}Tab-{!! $lang['id'] !!}">
        <textarea
			name="{!! isset($name) ? str_replace('[lang]', '['.$lang['id'].']', $name) : 'texts['.$lang['id'].']['.$id.']' !!}"
			placeholder="{!! $lang['name'] !!}"></textarea>
    </div>
@endforeach