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
							<label for="">Ana Kategori</label>
							<div class="ui selection dropdown search multiple">
								<input type="hidden" name="main_categories" value="{{ request('main_categories') }}">
								<i class="dropdown icon"></i>
								<div class="default text">@lang('admin::public.selection')</div>
								<div class="menu">
									@foreach ($mainCategories as $item)
										<div class="item" data-value="{!! $item['code'] !!}">
											{!! $item['title'] !!}
										</div>
									@endforeach
								</div>
							</div>
						</div>
						<div class="field">
							<label for="">Alt Kategori</label>
							<div class="ui selection dropdown search multiple">
								<input type="hidden" name="child_categories" value="{{ request('child_categories') }}">
								<i class="dropdown icon"></i>
								<div class="default text">@lang('admin::public.selection')</div>
								<div class="menu">
									@foreach ($childCategories as $item)
										<div class="item" data-value="{!! $item['code'] !!}">
											{!! $item['title'] !!}
										</div>
									@endforeach
								</div>
							</div>
						</div>
						<div class="field">
							<label for="">Markalar</label>
							<div class="ui selection dropdown search multiple">
								<input type="hidden" name="brands" value="{{ request('brands') }}">
								<i class="dropdown icon"></i>
								<div class="default text">@lang('admin::public.selection')</div>
								<div class="menu">
									@foreach ($brands as $item)
										<div class="item" data-value="{!! $item['code'] !!}">
											{!! $item['title'] !!}
										</div>
									@endforeach
								</div>
							</div>
						</div>
						<div class="field">
							<label for="">Fiyat Aralığı</label>
							<div class="ui action input multiple labeled">
								<input name="min_price" value="{{ request('min_price') }}" type="text" placeholder="Başlangıç Fiyatı">
								<div class="ui label icon">
									<i class="exchange icon mr-0"></i>
								</div>
								<input name="max_price" value="{{ request('max_price') }}" type="text" placeholder="Bitiş Fiyatı">
							</div>
						</div>
					</div>
					<div class="column">
						<div class="field">
							<label for="">Ürün Adı</label>
							<input name="title" value="{{ request('title') }}" type="text" placeholder="Başlık">
						</div>
						<div class="field">
							<label for="">Stok Kodu</label>
							<input name="code" value="{{ request('code') }}" type="text" placeholder="Stok Kodu">
						</div>
						<div class="field">
							<label for="">Stok Adeti</label>
							<div class="ui right action left icon input">
								<i class="hourglass half icon"></i>
								<input name="unit" type="text" value="{{ request('unit') }}" placeholder="Adet">
								<div class="ui basic floating dropdown button">
									<input name="unit_format" value="{{ request('unit_format') }}" type="hidden">
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
			<th width="1">ID</th>
			<th width="1"><i class="fa fa-camera"></i></th>
			<th>Ürün Adı</th>
			<th>Ana Kategori</th>
			<th>Marka</th>
			<th>Stok Kodu</th>
			<th>Stok</th>
			<th>Fiyat</th>
			<th class="no-sort" width="1"></th>
		</tr>
		</thead>
		<tbody id="table-{!! $appRouter['current']['as'] !!}">
		@foreach($rows as $row)
			<tr id="row-{!! $appRouter['current']['as'] !!}-{!! $row['id'] !!}">
				<td>
					{!! $row['id'] !!}
				</td>
				<td>
					<i class="fa fa-camera"></i>
				</td>
				<td>
					{!! $row['sto_isim'] !!}
				</td>
				<td>
					{!! $row['sto_anagrup_kod'] !!}
				</td>
				<td>
					{!! $row['sto_marka_kodu'] !!}
				</td>
				<td>
					{!! $row['sto_kod'] !!}
				</td>
				<td>
					{!! (int)$row['unit'] !!}
				</td>
				<td class="right aligned">
					<div class="set currency format" data-price="{!! $row['amount'] !!}"></div>
				</td>
				<td class="right aligned">
					<div class="ui icon buttons small">
						@include('admin::_parts.table.status')
						@if (check_route_access('show'))
							<a
									href="{!! isset($appRouter['methods']['show']['modal']) ? str_replace('{id}', $row['id'], $appRouter['methods']['show']['modal']) : $appRouter['methods']['show']['url'].'/'.$row['id'] !!}"
									title="Sepete Ekle"
									class="ui button green icon {!! $appRouter['methods']['show']['method'] !!}">
								<i class="shop icon"></i>
							</a>
						@endif
					</div>
				</td>
			</tr>
		@endforeach
		</tbody>
	</table>
	<div class="ui right floated">
		{!! $rows->appends(request()->only(['status', 'title', 'code', 'categories', 'sites']))->links() !!}
	</div>
@stop