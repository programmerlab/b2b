@extends('admin::layout.box')

@section('buttonBefore')
	@parent
	<div onclick="App.click('#formFilter .submit')" class="ui orange button icon">
		<i class="search icon"></i>
	</div>
@stop

@section('boxContent')
	<div class="ui segment">
		<form id="formFilter" class="ui form" action="" method="get">
			<div class="ui button submit transition hidden"></div>
			<input name="_token" value="{{ csrf_token() }}" type="hidden">
			<div class="field">
				<input name="title" value="{{ request('title') }}" type="text" placeholder="Başlık">
			</div>
		</form>
	</div>
	<table class="ui compact celled padded striped table checkboxs sortable">
		<thead>
			<tr>
				<th class="no-sort" width="1">
					<div class="ui fitted toggle checkbox tableToggleSelect">
						<input type="checkbox">
					</div>
				</th>
				<th>Başlık</th>
				<th width="155" class="center aligned">@lang('admin::admin.theadDate')</th>
				<th class="no-sort" width="1"></th>
			</tr>
		</thead>
		<tbody id="table-{!! $appRouter['current']['as'] !!}">
			@foreach($rows as $row)
				<tr id="row-{!! $appRouter['current']['as'] !!}-{!! $row['id'] !!}">
					<td>@include('admin::_parts.table.toggle')</td>
					<td>
						<h4 class="ui header font400">
							<div class="content">
								{!! $row['text']['title'] !!}
							</div>
						</h4>
					</td>
					<td class="center aligned">@include('admin::_parts.table.date')</td>
					<td class="right aligned">
						<div class="ui icon buttons small">
							@include('admin::_parts.table.status')
							<div class="ui right pointing dropdown icon button black">
								<i class="setting icon"></i>
								<div class="menu">
									@include('admin::layout._parts.box.button_list')
								</div>
							</div>
						</div>
						<div class="destroy data">
							<input name="id" value="{!! $row['id'] !!}" type="hidden">
							<input name="row_id" value="#row-{!! $appRouter['current']['as'] !!}-" type="hidden">
						</div>
					</td>
				</tr>
			@endforeach
		</tbody>
	</table>
	<div class="ui right floated">
		{!! $rows->appends(request()->only(['title', 'parent']))->links() !!}
	</div>
@stop

@section('jsCode')
	@parent
	<script>
		$(document).ready(function () {
			App.component.semanticui.form('#formFilter', {});
		});
	</script>
@stop