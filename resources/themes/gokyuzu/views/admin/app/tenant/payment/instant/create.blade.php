@extends('admin::layout.box')

@section('boxContent')
	<form id="{!! $appRouter['current']['as'] !!}" data-action="{!! route_action('add') !!}" class="ui form">
		<div class="ui button submit transition hidden"></div>
		<input name="_token" value="{{ csrf_token() }}" type="hidden">

		<div class="field">
			<label for="">Bayi Adı/Kodu</label>
			<input name="dealer" placeholder="Bayi Adı/Kodu" type="text">
		</div>

		<div class="field">
			<label for="">Tahsilat Türü</label>
			@include('admin::_parts.dropdown.default', [
				'name' => 'collecting_definition_id',
				'value' => null,
				'key' => 'text.title',
				'items' => config('tenant_definitions.collection', [])
			])
		</div>

		<div class="field">
			<label for="">Tahsilat Tutarı</label>
			<input name="price" value="" placeholder="Tahsilat Tutarı" type="text">
		</div>

		<div id="excel" class="field">
			<label for="">Tahsilat Belgesi</label>
			<input name="doc" type="file">
		</div>

		<div class="field">
			<label for="">Notunuz</label>
			<textarea name="note" placeholder="Notunuz" rows="4"></textarea>
		</div>
	</form>
@stop

@section('jsCode')
	@parent
	<script>
		$(document).ready(function () {
			App.form.validate('#{!! $appRouter['current']['as'] !!}', {
				/**/
			});
		});
	</script>
@stop