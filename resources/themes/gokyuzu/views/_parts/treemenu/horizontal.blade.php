@if($child)
    <div class="ui dropdown item {!! $row['item_class'] !!}">
        {!! $row['icon'] !!}
        <div>
            {!! $row['parent_id'] != 0 ? '<i class="dropdown icon"></i>' : '' !!}
            {!! $row['text']['title'] !!}
            {!! $row['parent_id'] == 0 ? '<i class="dropdown icon"></i>' : '' !!}
        </div>
        <div class="menu">
            {!! $child !!}
        </div>
    </div>
@else
    <a href="{!! $row['text']['url'] !!}" class="item {!! $row['item_class'] !!}">
        {!! $row['icon'] !!}
        {!! $row['text']['title'] !!}
    </a>
@endif