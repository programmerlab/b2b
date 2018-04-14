@extends('admin::layout.box')

@section('boxContent')
	<form id="{!! $appRouter['current']['as'] !!}" data-action="{!! route_action('update') !!}" class="ui form">
		<div class="ui button submit transition hidden"></div>
		<input name="_token" value="{{ csrf_token() }}" type="hidden">
		<input name="id" value="{!! $row['id'] !!}" type="hidden">

		<div class="field">
			<label for="">Benzersiz Kod</label>
			<input name="code" value="{!! $row['code'] !!}" placeholder="Benzersiz Kod" type="text">
		</div>

		<div class="field lang">
			<label for="">Başlık</label>
			@include('admin::_parts.lang.lang', ['id' => 'title', 'layout' => 'text_edit'])
		</div>

		<div class="field lang">
			<label for="">Yönlendirme Linki</label>
			@include('admin::_parts.lang.lang', ['id' => 'redirect', 'layout' => 'text_edit'])
		</div>

		<div class="two fields">
			<div class="field">
				<label for="">Ana Menü</label>
				@include('admin::_parts.dropdown.default', [
					'name' => 'main_menu_id',
					'value' => $row['main_menu_id'],
					'key' => 'text.title',
					'items' => $menus
				])
			</div>
			<div class="field">
				<label for="">Ekle Menü</label>
				@include('admin::_parts.dropdown.default', [
					'name' => 'add_menu_id',
					'value' => $row['add_menu_id'],
					'key' => 'text.title',
					'items' => $menus
				])
			</div>
		</div>
		@include($pathLayout.'_parts.access')
		@include($pathLayout.'_parts.route')
	</form>
@stop

@section('jsCode')
	@parent
	<script>
		$(document).ready(function() {
			App.form.validate('#{!! $appRouter['current']['as'] !!}', {
				/**/
			});

			$('.route.access').on('change', function() {
				var text = '';
				$.each($('.route.access:checked'), function(i, el) {
					text += ','+$(el).val();
				});
				$('#routeAccess').val(text.substring(1));
			});
		});
	</script>
@stop