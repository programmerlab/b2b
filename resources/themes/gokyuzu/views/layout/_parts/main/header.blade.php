<nav id="menu" class="ui top fixed menu">
	<a href="{!! $user['role_redirect'] or '' !!}" class="item logo" title="{!! theme('logoName') !!}">
		<img src="{!! theme('logo') !!}" class="ui image" alt="{!! theme('logoName') !!}">
	</a>
	<div class="left menu desktop only">
		{!! $menu['main']['horizontal'] or '' !!}
	</div>
	<div class="right menu">
		<div class="ui dropdown pointing item top right icon basic basket">
			<i class=" shop icon"></i>
			<div class=" floating ui red mini label" id="totalBasketUserGetIndex">0</div>
			<div id="loadBasketUserGetIndex" class="menu vertical basket"></div>
		</div>
		<div class="ui dropdown pointing item top right icon currencies" tabindex="0">
			<i class="{!! currency('small_iso_code') !!} icon"></i>
			<div class="menu transition hidden notifications" tabindex="-1" style="min-width: 300px">
				@foreach (config('currencies') as $currency)
					<a
							href="{!! request()->path() !!}?currency.change={!! $currency['id'] !!}"
							class="item {!! $currency['id'] == currency('id') ? 'active' : '' !!}">
						<span class="description">{{ $currency['conversion_rate'] }}</span>
						<span class="text"><i class="{{ $currency['small_iso_code'] }} icon"></i> {{ $currency['name'] }}</span>
					</a>
				@endforeach
			</div>
		</div>
		<div class="ui dropdown pointing item top right icon account" tabindex="0">
			<img class="ui mini avatar image" src="{!! $user['avatar'] or assets('image/avatar.png') !!}">
			<span style="margin-left: 5px;">{!! tenant('name') !!}</span>
			<div class="menu transition hidden" tabindex="-1">
				<a href="" class="item">
					<i class="user icon"></i> {!! $user['name'] !!}
				</a>
				<a href="{!! route_name('adminAccountLogoutGetIndex') !!}" class="ui bottom attached button labeled icon small red">
					<i class="power icon"></i>
					@lang('admin::admin.logout')
				</a>
			</div>
		</div>
	</div>
</nav>