@extends('admin::layout.load_box')

@section('boxContent')
	@if ($row['unit'] <= 0)
		<div class="ui message warning">
			Üzgünüm bu üründen stoklarda kalmadı!
		</div>
	@else
		<form id="{!! $appRouter['current']['as'] !!}" data-action="{!! route_name('b2bTenantShopBasketUserPostAdd') !!}" class="ui form">
			<div class="ui button submit transition hidden"></div>
			<input name="_token" value="{{ csrf_token() }}" type="hidden">
			<input name="id" value="{!! $row['id'] !!}" type="hidden">
			<table class="ui compact padded striped table">
				<thead>
				<tr>
					<th width="100">Görsel</th>
					<th>Seçenek</th>
					<th width="75" class="right aligned">Stok</th>
					<th width="125" class="right aligned">Fiyat</th>
					<th width="150" class="right aligned">Adet</th>
				</tr>
				</thead>
				<tbody>
				@foreach ($row['options'] as $option)
					<tr>
						<td>
							<i class="fa fa-camera"></i>
						</td>
						<td>{{ $option['title'] }} [{!! $option['no'] !!}]</td>
						<td class="right aligned">{{ $option['quantity'] }}</td>
						<td class="right aligned">
							<div class="set currency format" data-price="{!! $row['amount'] !!}"></div>
						</td>
						<td class="right aligned">
							<div class="ui input">
								<input name="quantity[{!! $option->id !!}]" type="number" placeholder="Adet" maxlength="{{ $option['quantity'] }}">
							</div>
						</td>
					</tr>
				@endforeach
				</tbody>
			</table>
			<div class="actions text right">
				<a onclick="App.form.submit('#{!! $appRouter['current']['as'] !!}')" class="ui teal labeled icon large button">
					<i class="cart icon"></i>
					Sepete Ekle
				</a>
			</div>
		</form>
	@endif
@stop

@section('jsCode')
	@parent
	<script>
        $(document).ready(function () {
            App.form.validate('#{!! $appRouter['current']['as'] !!}', {
                //
            });

            App.modal.open('#modalUrl', {closable: false});
            App.tool.currency.run();
        });
	</script>
@stop