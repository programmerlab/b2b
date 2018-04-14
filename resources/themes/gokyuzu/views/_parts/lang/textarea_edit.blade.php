@foreach ($row->lang_texts as $text)
    <div class="ui tab right action input {!! $text['lang_id'] == lang('id') ? 'active' : '' !!}" data-tab="lang{!! $id !!}Tab-{!! $text['lang_id'] !!}">
        <textarea name="texts[{!! $text['lang_id'] !!}][{!! $id !!}]" placeholder="{!! $text['name'] !!}">{!! $text[$id] !!}</textarea>
    </div>
@endforeach