@extends('admin::layout.box')

@section('boxContent')
    <table class="ui compact celled padded striped table checkboxs sortable">
        <thead>
            <tr>
                <th class="no-sort" width="1">
                    <div class="ui fitted toggle checkbox tableToggleSelect">
                        <input type="checkbox">
                    </div>
                </th>
                <th width="1" class="center aligned">Kod</th>
                <th>Başlık</th>
                <th width="155" class="center aligned">@lang('admin::admin.theadDate')</th>
                <th class="no-sort" width="1"></th>
            </tr>
        </thead>
        <tbody id="table-{!! $appRouter['current']['as'] !!}">
            @foreach($rows as $row)
                <tr id="row-{!! $appRouter['current']['as'] !!}-{!! $row['id'] !!}">

                    <td>@include('admin::_parts.table.toggle')</td>
                    <td class="center aligned">
                        <div class="ui label small teal">{!! $row['code'] !!}</div>
                    </td>
                    <td>
                        <h3 class="ui header font600">
                            <div class="content">
                                {!! $row['text']['title'] !!}
                                <div class="sub header">{!! $row['text']['redirect'] !!}</div>
                            </div>
                        </h3>
                    </td>
                    <td class="center aligned">@include('admin::_parts.table.date')</td>
                    <td class="right aligned">
                        <div class="ui icon buttons small">
                            @include('admin::_parts.table.status')
                            <div class="ui right pointing dropdown icon button black">
                                <i class="setting icon"></i>
                                <div class="menu">
                                    @include('admin::layout._parts.box.button_list')
                                </div>
                            </div>                        </div>
                        <div class="destroy data">
                            <input name="id" value="{!! $row['id'] !!}" type="hidden">
                            <input name="row_id" value="#row-{!! $appRouter['current']['as'] !!}-" type="hidden">
                        </div>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
    <div class="ui right floated">
        {!! $rows->appends(request()->only(['status']))->links() !!}
    </div>
@stop