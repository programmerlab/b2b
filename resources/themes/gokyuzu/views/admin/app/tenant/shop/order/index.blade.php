@extends('admin::layout.box')

@section('boxBefore')
    <form id="formFilter" class="ui form" action="" method="get">
        <div class="ui button submit transition hidden"></div>
        <input name="_token" value="{{ csrf_token() }}" type="hidden">
        <div class="panel panel-bd panel-filter">
            <div class="panel-heading">
                <div class="panel-title">
                    <h4>Ara</h4>
                </div>
            </div>
            <div class="panel-body">
                <div class="ui grid two column">
                    <div class="column">
                        <div class="field">
                            <label for="">Sipariş Durumu</label>
                            @include('admin::_parts.dropdown.status', [
                                'name' => 'status_id',
                                'value' => request('status_id'),
                                'type' => 'order',
                                'multiple' => true
                            ])
                        </div>
                        <div class="field">
                            <label for="">Ödeme Durumu</label>
                            @include('admin::_parts.dropdown.status', [
                                'name' => 'status_id',
                                'value' => request('status_id'),
                                'type' => 'order',
                                'multiple' => true
                            ])
                        </div>
                        <div class="field">
                            <label for="">Sipariş Tarihi</label>
                            <div class="ui action input multiple labeled">
                                <input name="start_at" value="{{ request('start_at') }}" type="text"
                                       placeholder="Başlangıç Tarihi" class="datetime">
                                <div class="ui label icon">
                                    <i class="exchange icon mr-0"></i>
                                </div>
                                <input name="finish_at" value="{{ request('finish_at') }}" type="text"
                                       placeholder="Bitiş Tarihi" class="datetime">
                            </div>
                        </div>
                    </div>
                    <div class="column">
                        <div class="field">
                            <label for="">Bayi Adı</label>
                            <input name="dealer" value="{{ request('dealer') }}" type="text" placeholder="Bayi Adı">
                        </div>
                        <div class="field">
                            <label for="">Teslimat Şekli</label>
                            @include('admin::_parts.dropdown.default', [
                                'name' => 'delivery_definition_id',
                                'value' => request('delivery_definition_id'),
                                'key' => 'text.title',
                                'items' => config('tenant_definitions.delivery', []),
                                'multiple' => true
                            ])
                        </div>
                        <div class="field">
                            <label for="">Fiyat Aralığı</label>
                            <div class="ui action input multiple labeled">
                                <input name="min_price" value="{{ request('min_price') }}" type="text"
                                       placeholder="Başlangıç Fiyatı">
                                <div class="ui label icon">
                                    <i class="exchange icon mr-0"></i>
                                </div>
                                <input name="max_price" value="{{ request('max_price') }}" type="text"
                                       placeholder="Bitiş Fiyatı">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="panel-footer text right">
                <div onclick="App.click('#formFilter .submit')" class="ui blue labeled button icon">
                    <i class="search icon"></i> Sonuçları Listele
                </div>
            </div>
        </div>
    </form>
@stop

@section('jsCode')
    @parent
    <script>
        $(document).ready(function () {
            App.component.semanticui.form('#formFilter', {});
            App.tool.date.datepicker('.datetime');
        });
    </script>
@stop

@section('boxContent')
    <table class="ui compact celled padded striped table checkboxs sortable">
        <thead>
        <tr>
            <th width="1" class="center aligned">ID</th>
            <th>Bayi</th>
            <th>Ödeme Türü</th>
            <th>Teslimat Şekli</th>
            <th width="155" class="right aligned">Toplam Tutar</th>
            <th width="1" class="center aligned">Sipariş Durumu</th>
            <th width="155" class="center aligned">@lang('admin::admin.theadDate')</th>
            <th class="no-sort" width="1"></th>
        </tr>
        </thead>
        <tbody id="table-{!! $appRouter['current']['as'] !!}">
        @foreach($rows as $row)
            <tr id="row-{!! $appRouter['current']['as'] !!}-{!! $row['id'] !!}">
                <td class="center aligned">
                    {!! $row['id'] !!}
                </td>
                <td class="title">
                    <h3 class="ui header font400">
                        {!! $row['site']['name'] !!}
                        <div class="sub header">
                            {!! $row['site']['code'] !!}
                        </div>
                    </h3>
                </td>
                <td>
                    {{ $row['payment']['text']['title'] }}
                </td>
                <td>
                    {{ $row['delivery']['text']['title'] }}
                </td>
                <td class="right aligned">
                    <span class="set currency format" data-price="{!! $row['total_price'] !!}"></span>
                </td>
                <td class="center aligned">
                    {!! status_format($row['status']) !!}
                </td>
                <td class="center aligned">@include('admin::_parts.table.date')</td>
                <td class="right aligned">
                    <div class="ui icon buttons small">
                        @include('admin::_parts.table.status')
                        @if (check_route_access('edit') || check_route_access('destroy'))
                            <div class="ui right pointing dropdown icon button black">
                                <i class="setting icon"></i>
                                <div class="menu">
                                    @include('admin::layout._parts.box.button_list')
                                </div>
                            </div>
                        @endif
                    </div>
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