@foreach (config('tenant_langs') as $lang)
    <div class="ui tab right action input {!! $lang['id'] == lang('id') ? 'active' : '' !!}" data-tab="lang{!! $id !!}Tab-{!! $lang['id'] !!}">
        <input
            name="{!! isset($name) ? str_replace('[lang]', '['.$lang['id'].']', $name) : 'texts['.$lang['id'].']['.$id.']' !!}"
            value=""
            placeholder="{!! $lang['name'] !!}"
            type="text"
        >
    </div>
@endforeach