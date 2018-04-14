@extends('admin::layout.load_box')

@section('boxContent')
	<div class="tabs">
		<div class="ui fluid two item menu top attached tabular default">
			<a class="item active" data-tab="tabSite">
				<i class="linkify icon"></i> Genel Ayarlar
			</a>
			<a class="item" data-tab="tabStore">
				<i class="building outline icon"></i> Firma Bilgileri
			</a>
		</div>
	</div>
	<form id="{!! $appRouter['current']['as'] !!}" data-action="{!! route_action('update') !!}" class="ui form">
		<div class="ui button submit transition hidden"></div>
		<input name="_token" value="{{ csrf_token() }}" type="hidden">
		<input name="id" value="{!! $row['id'] !!}" type="hidden">

		<div class="ui bottom attached tab active" data-tab="tabSite">
			@include($pathLayout.'_parts.site')
		</div>
		<div class="ui bottom attached tab " data-tab="tabStore">
			@include($pathLayout.'_parts.store')
		</div>
	</form>
@stop

@section('jsCode')
	@parent
	<script>
		$(document).ready(function () {
			App.form.validate('#{!! $appRouter['current']['as'] !!}', {
				//
			});
		});
	</script>
@stop