@if ($row['products'])
	@foreach ($row['products'] as $product)
		<div id="row-{!! $appRouter['current']['as'] !!}-{!! $product['id'] !!}" class="item">
			<div class="ui grid">
				<div class="four wide column">
					<img class="ui image fluid" src="{{ $product['image'] }}">
				</div>
				<div class="ten wide column">
					<h3 class="title nomargin">{{ $product['title'] }}</h3>
					<div class="properties marginbottom1">{{ $product['child_title'] }}</div>
					<div class="info">
						<div class="unit marginbottom1">Adet : {!! $product['quantity'] !!}</div>
						<div class="ui grid two column">
							<div class="column">
								Fiyat:
								<span class="price set currency format" data-price="{!! $product['price'] !!}"></span>
							</div>
							<div class="column">
								Toplam :<span class="price set currency format" data-price="{!! $product['total_price'] !!}"></span>
							</div>
						</div>
					</div>
				</div>
				<div class="two wide column right aligned">
					<div class="">
						<div class="">
							<div class="">
								@if (check_route_access('destroy'))
									<a data-action="{!! route_action('destroy', $product['id']).'?user=true' !!}" class="modal delete remove {!! $appRouter['methods']['destroy']['method'] !!}">
										<i class="icon route method red {!! $appRouter['methods']['destroy']['code'] !!}"></i>
									</a>
								@endif
							</div>
						</div>
					</div>
					<div class="destroy data">
						<input name="basket_id" value="{!! $row['id'] !!}" type="hidden">
						<input name="id" value="{!! $product['id'] !!}" type="hidden">
						<input name="row_id" value="#row-{!! $appRouter['current']['as'] !!}-" type="hidden">
					</div>
				</div>
			</div>
		</div>
	@endforeach
	<a href="{!! route_name('b2bTenantShopOrderGetCreate') !!}" class="item text center action">
		Alışverişi Tamamla
	</a>
@else
	<div class="item">
		<div class="ui message warning">
			Sepetinizde hiç ürün bulunmuyor!
		</div>
	</div>
@endif

<script>
	App.tool.currency.run();
	$('#totalBasketUserGetIndex').html('{!! count($row['products']) !!}');
</script>