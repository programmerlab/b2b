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
							<div class="ui left icon input">
								<i class="building outline icon"></i>
								<input name="q" value="{{ request('q') }}" placeholder="Bayi İsmi/Kodu" type="text">
							</div>
						</div>
						<div class="field">
							<label for="">Vergi No</label>
							<div class="ui left icon input">
								<i class="hourglass half icon"></i>
								<input name="tax_no" value="{{ request('tax_no') }}" placeholder="Vergi No" type="text">
							</div>
						</div>
						<div class="field">
							<label for="">Bölge</label>
							<div class="ui left icon input">
								<i class="globe icon"></i>
								<input name="zone" value="{{ request('zone') }}" placeholder="Bölge" type="text">
							</div>
						</div>
					</div>
					<div class="column">
						<div class="field">
							<label for="">Puan Adedi</label>
							<div class="ui right action left icon input">
								<i class="diamond icon"></i>
								<input name="point" type="text" value="{{ request('point') }}" placeholder="Puan Adedi">
								<div class="ui basic floating dropdown button">
									<input name="point_format" value="{{ request('point_format') }}" type="hidden">
									<div class="text">Format</div>
									<i class="dropdown icon"></i>
									<div class="menu">
										<div class="item" data-value="1">=</div>
										<div class="item" data-value="2">=></div>
										<div class="item" data-value="3"><=</div>
									</div>
								</div>
							</div>
						</div>
						<div class="field">
							<label for="">Güncel Bakiye</label>
							<div class="ui right action left icon input">
								<i class="payment icon"></i>
								<input name="total_price" type="text" value="{{ request('total_price') }}"
										placeholder="Güncel Bakiye">
								<div class="ui basic floating dropdown button">
									<input name="total_price_format" value="{{ request('total_price_format') }}"
											type="hidden">
									<div class="text">Format</div>
									<i class="dropdown icon"></i>
									<div class="menu">
										<div class="item" data-value="1">=</div>
										<div class="item" data-value="2">=></div>
										<div class="item" data-value="3"><=</div>
									</div>
								</div>
							</div>
						</div>
						<div class="field">
							<label for="">Risk Limiti</label>
							<div class="ui right action left icon input">
								<i class="diamond icon"></i>
								<input name="danger_limit" type="text" value="{{ request('danger_limit') }}"
										placeholder="Risk Limiti">
								<div class="ui basic floating dropdown button">
									<input name="danger_limit_format" value="{{ request('danger_limit_format') }}"
											type="hidden">
									<div class="text">Format</div>
									<i class="dropdown icon"></i>
									<div class="menu">
										<div class="item" data-value="1">=</div>
										<div class="item" data-value="2">=></div>
										<div class="item" data-value="3"><=</div>
									</div>
								</div>
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
        });
	</script>
@stop

@section('boxContent')
	<table class="ui compact celled padded striped table checkboxs sortable">
		<thead>
		<tr>
			<th width="">Bayi</th>
			<th width="">Vergi</th>
			<th width="">Bölge</th>
			<th width="">Bakiye</th>
			<th width="">Risk</th>
			<th width="">Kalan Risk</th>
			<th width="">Puan</th>
			<th width="1" class="center aligned">@lang('admin::admin.theadDate')</th>
			<th class="no-sort" width="1%"></th>
		</tr>
		</thead>
		<tbody id="table-{!! $appRouter['current']['as'] !!}">
		@foreach($rows as $row)
			<tr id="row-{!! $appRouter['current']['as'] !!}-{!! $row['id'] !!}">
				<td>
					<h4 class="ui header font400">
						{!! $row['name'] !!}
						<div class="sub header">
							{{ $row['code'] }}
						</div>
					</h4>
				</td>
				<td>
					<h4 class="ui header font400">
						{!! $row['tax_zone'] !!}
						<div class="sub header">
							{{ $row['tax_no'] }}
						</div>
					</h4>
				</td>
				<td>
					{{ $row['zone'] }}
				</td>
				<td>
					<span class="set currency format" data-price="{{ $row['total_price'] }}"></span>
				</td>
				<td>
					<span class="set currency format" data-price="{{ $row['danger_limit'] }}"></span>
				</td>
				<td>
					<span class="set currency format" data-price="{{ $row['danger_limit'] == 0 ? '-' : $row['danger_limit'] -  $row['total_price'] }}"></span>
				</td>
				<td>
					{{ $row['point'] }}
				</td>
				<td class="center aligned">@include('admin::_parts.table.date')</td>
				<td class="right aligned">
					<div class="ui icon buttons small">
						<a href="" class="ui icon button pink">
							<i class="diamond icon"></i>
						</a>
						<a href="" class="ui icon button blue">
							<i class="users icon"></i>
						</a>
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