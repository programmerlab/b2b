@if($child)
    <div class="ui dropdown item {!! $row['item_class'] !!}">
        <i class="dropdown icon {!! $row['parent_id'] == 0 ? 'ui transition hidden tab' : '' !!}"></i>
        {!! $row['icon'] !!}
        <span class="{!! $row['parent_id'] == 0 ? 'ui transition hidden tab' : '' !!} tab">{!! $row['text']['title'] !!}</span>
        <div class="menu">
            <div class="header">
               <span>{!! $row['text']['title'] !!}</span>
            </div>
            {!! $child !!}
        </div>
    </div>
@else
    <a href="{!! $row['text']['url'] !!}" class="item {!! $row['item_class'] !!}">
        {!! $row['icon'] !!}
        <span class="{!! $row['parent_id'] == 0 ? 'ui transition hidden tab' : '' !!} tab">{!! $row['text']['title'] !!}</span>
    </a>
@endif