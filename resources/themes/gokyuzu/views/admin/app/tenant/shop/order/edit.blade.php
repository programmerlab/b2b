@extends('admin::layout.box')

@section('boxContent')
	<form id="{!! $appRouter['current']['as'] !!}" data-action="{!! route_action('update') !!}" class="ui form">
		<div class="ui button submit transition hidden"></div>
		<input name="_token" value="{{ csrf_token() }}" type="hidden">
		<input name="id" value="{!! $row['id'] !!}" type="hidden">

		<table class="ui table">
			<tbody>
			<tr>
				<td>Bayi Kodu:</td>
				<td>{!! $row['user']['site']['site']['dealer_code'] !!}</td>
			</tr>
			<tr>
				<td>Bayi:</td>
				<td>{!! $row['user']['site']['site']['name'] !!}</td>
			</tr>
			<tr>
				<td>Ödeme Şekli:</td>
				<td>{!! $row['payment_id'] !!}</td>
			</tr>
			<tr>
				<td>Sipariş Notu:</td>
				<td>{{ $row['note'] }}</td>
			</tr>
			<tr>
				<td>Teslimat Şekli:</td>
				<td>{{ $row['shipping_id'] }}</td>
			</tr>
			<tr>
				<td>Teslimat Adresi:</td>
				<td>{{ $row['user']['address']['address_1'] }}</td>
			</tr>
			<tr>
				<td>Toplam Tutar:</td>
				<td class="set currency format" data-price="{!! $row['total_price'] !!}"></td>
			</tr>
			<tr>
				<td>Sipariş Tarih:</td>
				<td>{!! $row->created_at !!}</td>
			</tr>
			<tr>
				<td>Platform:</td>
				<td><span class="label label-warning">Bayi</span></td>
			</tr>
			<tr>
				<td>Sipariş Durumu:</td>
				<td>
					@include('admin::_parts.dropdown.status', [
						'name' => 'status_id',
						'value' => $row['status_id'],
						'type' => 'order'
					])
				</td>
			</tr>
			</tbody>
		</table>
	</form>
@stop

@section('boxAfter')
	@parent
	<div class="ui fluid steps tabular no margin top bottom">
		<a class="step item active" data-tab="tabProcessInfo">
			<i class="alarm outline icon"></i>
			<div class="content">
				<div class="title">İşlemler</div>
				<div class="description">İşlem kayıtları ve personel notları</div>
			</div>
		</a>
	</div>
	<div style="min-height: 500px; margin-top: 20px">
		<div class="ui tab active" data-tab="tabProcessInfo">
			<section class="ui stackable responsive grid state-overview">
				<div class="column twelve wide">
					<div id="loadNoteGetIndex"></div>
					<div id="buttonNoteGetIndex"></div>
				</div>
				<div class="column four wide">
					<div id="loadLogGetIndex"></div>
					<div id="buttonLogGetIndex"></div>
				</div>
			</section>
		</div>
	</div>
@stop

@section('jsCode')
	@parent
	<script>
		$(document).ready(function () {
			App.form.validate('#{!! $appRouter['current']['as'] !!}', {
				/**/
			});

			$('#buttonNoteGetIndex').on('click', function () {
				App.load('#loadNoteGetIndex', '{!! route_name('noteGetIndex', 'parent='.$row['id'].'&group=order&path='.request()->path()) !!}');
			});

			$('#buttonLogGetIndex').on('click', function () {
				App.load('#loadLogGetIndex', '{!! route_name('logGetIndex', 'layout=route&path='.request()->path()) !!}');
			});

			$('#buttonNoteGetIndex').click();
			$('#buttonLogGetIndex').click();
		});
	</script>
@stop