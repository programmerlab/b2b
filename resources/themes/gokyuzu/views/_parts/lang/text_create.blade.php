@foreach (config('langs') as $lang)
    <div class="ui tab right action input {!! $lang['id'] == lang('id') ? 'active' : '' !!}" data-tab="lang{!! $id !!}Tab-{!! $lang['id'] !!}">
        <input
            name="texts[{!! $lang['id'] !!}][{!! $id !!}]"
            value=""
            placeholder="{!! $lang['name'] !!}"
            type="text"
        >
    </div>
@endforeach