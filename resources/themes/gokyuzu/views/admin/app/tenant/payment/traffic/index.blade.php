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
                            <label for="">Bayi İsmi/Kodu</label>
                            <input name="dealer" value="{{ request('dealer') }}" type="text" placeholder="Bayi Adı">
                        </div>
                    </div>
                    <div class="column">
                        <div class="field">
                            <label for="">Tarih</label>
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
    <div class="row">
        <div class="col-sm-12 col-md-6">
            <div class="well">
                <h3></h3>
                <p></p>
            </div>
        </div>
        <div class="col-sm-12 col-md-3">
            <div class="statistic-box statistic-filled-2 outline">
                <h2 class="text-danger"><span class="count-number">-383,61</span> TL</h2>
                <div class="small text-danger">Genel Bakiye</div>
            </div>
        </div>
        <div class="col-sm-12 col-md-3">
            <div class="statistic-box statistic-filled-3 outline">
                <h2><span class="count-number">3,20</span> TL</h2>
                <div class="small">Ekran Bakiyesi</div>
            </div>
        </div>
    </div>

    <table class="ui compact celled padded striped table checkboxs sortable">
        <thead>
        <tr>
            <th width="1">Hareket Türü</th>
            <th>Hareket Cinsi</th>
            <th>Srmrk Kodu</th>
            <th>Seri No</th>
            <th>Sıra No</th>
            <th>Vade</th>
            <th width="1" class="right aligned">Fiyat</th>
            <th width="155" class="center aligned">@lang('admin::admin.theadDate')</th>
            <th class="no-sort" width="1"></th>
        </tr>
        </thead>
        <tbody id="table-{!! $appRouter['current']['as'] !!}">
        @foreach($rows as $row)
            <tr id="row-{!! $appRouter['current']['as'] !!}-{!! $row['id'] !!}">
                <td>
                    @if ($row['alias'] == 'input')
                        <div class="ui label red">@lang($pathLang.'.'.$row['alias'])</div>
                    @else
                        <div class="ui label blue">@lang($pathLang.'.'.$row['alias'])</div>
                    @endif
                </td>
                <td>{!! $row['type'] !!}</td>
                <td>-</td>
                <td>-</td>
                <td>-</td>
                <td>-</td>
                <td class="right aligned">
                    <div class="ui label set currency format" data-price="{!! $row['price'] !!}"></div>
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
                        </div>
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