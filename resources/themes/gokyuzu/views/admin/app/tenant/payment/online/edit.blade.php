@extends('admin::layout.box')

@section('boxContent')
	<form id="{!! $appRouter['current']['as'] !!}" data-action="{!! route_action('update') !!}" class="ui form">
		<div class="ui button submit transition hidden"></div>
		<input name="_token" value="{{ csrf_token() }}" type="hidden">
		<input name="id" value="{!! $row['id'] !!}" type="hidden">

		<table class="ui table">
			<tbody>
			<tr>
				<td>İşlem Durumu:</td>
				<td>
					@include('admin::_parts.dropdown.status', [
						'name' => 'status_id',
						'value' => $row['status_id'],
						'type' => 'onlinePayment'
					])
				</td>
			</tr>
			<tr>
				<td>İşlem Tarihi</td>
				<td>{!! $row->created_at !!}</td>
			</tr>
			<tr>
				<td>İşlem Yapan:</td>
				<td>{!! $row['user']['name'] !!}</td>
			</tr>
			<tr>
				<td>E-Posta Adresi</td>
				<td>{!! $row['user']['email'] !!}</td>
			</tr>
			<tr>
				<td>İşlem Açıklaması:</td>
				<td>{!! $row['note'] !!}</td>
			</tr>
			<tr style="background: #eee">
				<td></td>
				<td></td>
			</tr>
			<tr>
				<td>Banka</td>
				<td>-</td>
			</tr>
			<tr>
				<td>Kart Sahibi</td>
				<td>{!! $row['card_name'] !!}</td>
			</tr>
			<tr>
				<td>Kart Numarası - Tipi</td>
				<td>{!! $row['card_no'] !!}</td>
			</tr>
			<tr>
				<td>Ödeme Türü</td>
				<td>5 Taksit</td>
			</tr>
			<tr>
				<td>Toplam Tutar</td>
				<td class="set currency format" data-price="{!! $row['total_price'] !!}"></td>
			</tr>
			<tr style="background: #eee">
				<td></td>
				<td></td>
			</tr>
			<tr>
				<td>İşlem Yapan IP</td>
				<td>88.100.168.65</td>
			</tr>
			<tr>
				<td>İşlem Yapan Sistem</td>
				<td>Chrome 38/Mozilla Windows 7 Ultimate</td>
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
				App.load('#loadNoteGetIndex', '{!! route_name('noteGetIndex', 'parent='.$row['id'].'&group=onlinePayment&path='.request()->path()) !!}');
			});

			$('#buttonLogGetIndex').on('click', function () {
				App.load('#loadLogGetIndex', '{!! route_name('logGetIndex', 'layout=route&path='.request()->path()) !!}');
			});

			$('#buttonNoteGetIndex').click();
			$('#buttonLogGetIndex').click();
		});
	</script>
@stop