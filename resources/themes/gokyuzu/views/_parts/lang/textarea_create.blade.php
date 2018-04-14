@foreach (config('langs') as $lang)
    <div class="ui tab right action input {!! $lang['id'] == lang('id') ? 'active' : '' !!}" data-tab="lang{!! $id !!}Tab-{!! $lang['id'] !!}">
        <textarea name="texts[{!! $lang['id'] !!}][{!! $id !!}]" placeholder="{!! $lang['name'] !!}"></textarea>
    </div>
@endforeach