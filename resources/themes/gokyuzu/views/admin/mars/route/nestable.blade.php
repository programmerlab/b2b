<li id="row-{!! $appRouter['current']['as'] !!}-{!! $row['id'] !!}" class="row-{!! $row['id'] !!} dd-item dd3-item dd-route" data-id="{!! $row['id'] !!}">
    <div class="dd-handle dd3-handle"></div>
    <div class="dd3-content">
        <h3 class="ui header font400 no margin top bottom">
            <div class="content">
                {!! $row['text']['title'] !!}
                <div class="sub header">{!! $row['name'] !!}</div>
                <div class="sub header">{!! $row['text']['url'] !!}</div>
            </div>
        </h3>
        <div class="ns-actions">
            <div class="ui icon buttons small">
                @include('admin::_parts.table.status')
                <div class="ui right pointing dropdown icon button black">
                    <i class="setting icon"></i>
                    <div class="menu">
                        @include('admin::layout._parts.box.button_list')
                    </div>
                </div>            </div>
            <div class="destroy data">
                <input name="id" value="{!! $row['id'] !!}" type="hidden">
                <input name="row_id" value="#row-{!! $appRouter['current']['as'] !!}-" type="hidden">
            </div>
        </div>
    </div>
    @if ($child)
        <ol class="dd-list">{!! $child !!}</ol>
    @else
        {!! $child !!}
    @endif
</li>