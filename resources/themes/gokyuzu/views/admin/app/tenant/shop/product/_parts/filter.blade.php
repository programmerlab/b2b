@section('buttonBefore')
	@parent
	<div onclick="App.click('#formFilter .submit')" class="ui orange button icon">
		<i class="search icon"></i>
	</div>
@stop

<div class="ui segment">
	<form id="formFilter" class="ui form" action="" method="get">
		<div class="ui button submit transition hidden"></div>
		<input name="_token" value="{{ csrf_token() }}" type="hidden">
		<div class="two fields">
			<div class="field">
				<label for="">Başlık</label>
				<input name="title" value="{{ request('title') }}" type="text" placeholder="Başlık">
			</div>
			<div class="field">
				<label for="">Stok Kodu</label>
				<input name="code" value="{{ request('code') }}" type="text" placeholder="Stok Kodu">
			</div>
		</div>
		<div class="two fields">
			<div class="field">
				<label for="">Kategoriler</label>
				<div class="ui fluid multiple normal selection dropdown big">
					<input name="categories" value="{{ request('categories') }}" type="hidden">
					<i class="dropdown icon"></i>
					<div class="default text">Kategoriler</div>
					<div class="menu">{!! $categoryDropdowns !!}</div>
				</div>
			</div>
			<div class="field">
				<label for="">Markalar</label>
				@include('admin::_parts.dropdown.default', [
					'name' => 'brands',
					'value' => request('brands'),
					'items' => $brands,
					'key' => 'title',
					'multiple' => true
				])
			</div>
		</div>
		<div class="two fields">
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
	</form>
</div>

@section('jsCode')
	@parent
	<script>
		$(document).ready(function () {
			App.component.semanticui.form('#formFilter', {});
		});
	</script>
@stop