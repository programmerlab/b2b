@extends('admin::layout.box')

@section('boxContent')
	@if (!$basket)
		<div class="ui message warning huge">
			Sipariş verebilmek için lütfen sepetinize ürün ekleyin
		</div>
	@else
		<form id="{!! $appRouter['current']['as'] !!}" data-action="{!! route_action('add') !!}" class="ui form">
			<div class="ui button submit transition hidden"></div>
			<input name="_token" value="{{ csrf_token() }}" type="hidden">
			<div class="ui grid">
				<div class="ten wide column">
					<div class="ui raised segment">
						<div class="field">
							<label for="">Sipariş Notunuz</label>
							<textarea name="note" placeholder="Sipariş notunuz" rows="4"></textarea>
						</div>
						<div class="field">
							<label for="">Teslimat Tarihi</label>
							<div class="ui input left icon calendar datetime">
								<i class="calendar icon"></i>
								<input name="delivery_date" value="" placeholder="Teslimat Tarihi" type="text" class="datetime">
							</div>
						</div>
						<div class="field">
							<label for="">Teslimat Töntemi</label>
							<div class="ui selection dropdown">
								<input type="hidden" name="shipping_id">
								<i class="dropdown icon"></i>
								<div class="default text">Teslimat Töntemi</div>
								<div class="menu">
									<div class="item" data-value="1" data-text="Yöntem 1">
										<span class="description">Ücretsiz</span>
										<span class="text">Yöntem 1</span>
									</div>
									<div class="item" data-value="2" data-text="Yöntem 2">
										<span class="description set currency format" data-price="2500"></span>
										<span class="text">Yöntem 2</span>
									</div>
									<div class="item" data-value="3" data-text="Yöntem 3">
										<span class="description set currency format" data-price="3000"></span>
										<span class="text">Yöntem 3</span>
									</div>
								</div>
							</div>
						</div>
						<div class="field">
							<label for="">Ödeme Yöntemi</label>
							<div class="ui selection dropdown">
								<input type="hidden" name="payment_id">
								<i class="dropdown icon"></i>
								<div class="default text">Ödeme Yöntemi</div>
								<div class="menu tabular">
									<div class="item" data-tab="first" data-value="1">Banka Havalesi</div>
									<div class="item" data-tab="second" data-value="2">Kredi Kartı</div>
								</div>
							</div>
						</div>
						<div class="field">
							<div class="ui tab" data-tab="first">
								<div class="ui segment raised">
									<div class="field">
										<label for="">Banka Seçiniz</label>
										<div class="ui selection dropdown">
											<input type="hidden" name="payment_way">
											<i class="dropdown icon"></i>
											<div class="default text">Bankalar</div>
											<div class="menu">
												<div class="item" data-value="1">
													<span class="description">TR33 0006 1005 1978 6457 8413 26</span>
													<span class="text">Garanti Bankası</span>
												</div>
												<div class="item" data-value="2">
													<span class="description">TR33 0006 1005 1978 6457 8413 26</span>
													<span class="text">Yapı Kredi Bankası</span>
												</div>
												<div class="item" data-value="3">
													<span class="description">TR33 0006 1005 1978 6457 8413 26</span>
													<span class="text">Ziraat Bankası</span>
												</div>
											</div>
										</div>
									</div>
								</div>
							</div>
							<div class="ui tab" data-tab="second">
								<div class="ui segment raised">
									<div class="ui grid">
										<div class="ten wide column">
											<div class="card-area">
												<div class="field">
													<input placeholder="Kart Numaranız" type="tel" name="number"
															class="a1" required>
												</div>
												<div class="field">
													<input placeholder="Adınız Soyadınız" type="text" name="name"
															class="a2" required>
												</div>
												<div class="field">
													<input placeholder="Ay/Yıl" type="tel" name="expiry"
															class="a3" required>
												</div>
												<div class="field">
													<input placeholder="CVC" type="number" name="cvc"
															class="a4" required>
												</div>
											</div>
										</div>
										<div class="six wide column">
											<div class="card-wrapper"></div>
										</div>
									</div>

									<div id="CardOptions" style="display: none">
										<div class="ui fw-400 small header">
											Taksit Seçenekleri
										</div>
										<table class="ui table">
											<thead>
											<tr>
												<th>#</th>
												<th class="center aligned">Garanti Pay</th>
												<th class="center aligned">İş Bankası</th>
												<th class="center aligned">Yapı Kredi</th>
												<th class="center aligned">Akbank</th>
												<th class="center aligned">Finansbank</th>
											</tr>
											</thead>
											<tbody>
											<tr>
												<td>TEK ÇEKİM</td>
												<td class="center aligned">
													<div class="ui radio checkbox">
														<input type="radio" name="frequency">
													</div>
												</td>
												<td class="center aligned">
													<div class="ui radio checkbox">
														<input type="radio" name="frequency">
													</div>
												</td>
												<td class="center aligned">
													<div class="ui radio checkbox">
														<input type="radio" name="frequency">
													</div>
												</td>
												<td class="center aligned">
													<div class="ui radio checkbox">
														<input type="radio" name="frequency">
													</div>
												</td>
												<td class="center aligned">
													<div class="ui radio checkbox">
														<input type="radio" name="frequency">
													</div>
												</td>
											</tr>
											<tr>
												<td>2 TAKSİT</td>
												<td class="center aligned">
													<div class="ui radio checkbox">
														<input type="radio" name="frequency">
													</div>
												</td>
												<td class="center aligned">
													<div class="ui radio checkbox">
														<input type="radio" name="frequency">
													</div>
												</td>
												<td class="center aligned">
													<div class="ui radio checkbox">
														<input type="radio" name="frequency">
													</div>
												</td>
												<td class="center aligned">
													<div class="ui radio checkbox">
														<input type="radio" name="frequency">
													</div>
												</td>
												<td class="center aligned">
													<div class="ui radio checkbox">
														<input type="radio" name="frequency">
													</div>
												</td>
											</tr>
											<tr>
												<td>4 TAKSİT</td>
												<td class="center aligned">
													<div class="ui radio checkbox">
														<input type="radio" name="frequency">
													</div>
												</td>
												<td class="center aligned">
													<div class="ui radio checkbox">
														<input type="radio" name="frequency">
													</div>
												</td>
												<td class="center aligned">
													<div class="ui radio checkbox">
														<input type="radio" name="frequency">
													</div>
												</td>
												<td class="center aligned">
													<div class="ui radio checkbox">
														<input type="radio" name="frequency">
													</div>
												</td>
												<td class="center aligned">
													<div class="ui radio checkbox">
														<input type="radio" name="frequency">
													</div>
												</td>
											</tr>
											<tr>
												<td>6 TAKSİT</td>
												<td class="center aligned">
													<div class="ui radio checkbox">
														<input type="radio" name="frequency">
													</div>
												</td>
												<td class="center aligned">
													<div class="ui radio checkbox">
														<input type="radio" name="frequency">
													</div>
												</td>
												<td class="center aligned">
													<div class="ui radio checkbox">
														<input type="radio" name="frequency">
													</div>
												</td>
												<td class="center aligned">
													<div class="ui radio checkbox">
														<input type="radio" name="frequency">
													</div>
												</td>
												<td class="center aligned">
													<div class="ui radio checkbox">
														<input type="radio" name="frequency">
													</div>
												</td>
											</tr>
											</tbody>
										</table>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
				<div class="six wide column">
					<div class="ui raised segments">
						<div class="ui segment">
							<div class="ui small fw-400 header">
								<span style="float: right" class="set currency format" data-price="{!! $basket['total_price'] !!}"></span>
								Ara Toplam:
							</div>
						</div>
						<div class="ui segment">
							<div class="ui small fw-400 header">
								<span style="float: right" class="set currency format" data-price="0"></span>
								K.D.V.:
							</div>
						</div>
						<div class="ui segment">
							<div class="ui small green fw-400 header">
								<span style="float: right" class="set currency format" data-price="{!! $basket['total_price'] + 0 !!}"></span>
								Genel Toplam:
							</div>
						</div>
						<div class="ui segment">
							<table class="ui compact celled padded striped table">
								<thead>
								<tr>
									<th>Başlık</th>
									<th width="1" class="center aligned">Adet</th>
									<th width="140" class="right aligned">Toplam Fiyatı</th>
								</tr>
								</thead>
								<tbody id="">
								@foreach ($basket['products'] as $item)
									<tr id="">
										<td>
											<div class="ui small header fw-400">
												{!! $item['title'] !!}
												<div class="sub header">
													{!! $item['child_title'] !!}
												</div>
											</div>
										</td>
										<td class="center aligned">
											<span class="ui label">
												{{ $item['quantity'] }}
											</span>
										</td>
										<td class="right aligned">
											<div class="ui label green set currency format" data-price="{!! $item['total_price'] !!}"></div>
										</td>
									</tr>
								@endforeach
								</tbody>
							</table>
						</div>
					</div>
				</div>
			</div>
		</form>
	@endif
@stop

@section('jsCode')
	@parent
	<script src="https://cdnjs.cloudflare.com/ajax/libs/card/2.4.0/jquery.card.min.js"></script>
	<script>
		$(document).ready(function () {
			App.form.validate('#{!! $appRouter['current']['as'] !!}', {
				/**/
			});

			App.tool.date.datepicker('.datetime');

			new Card({
				form: document.querySelector('.card-area'),
				container: '.card-wrapper'
			});

			$('.card-area .a1').on('change', function () {
				var value = $(this).val();
				if (value.length == 19) {
					$('#CardOptions').show();
				} else {
					$('#CardOptions').hide();
				}
			});
		});
	</script>
@stop

@section('cssCode')
	@parent
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/card/2.4.0/card.css">
	<style>
		.jp-card-container {
			float : right !important;
		}
	</style>
@stop