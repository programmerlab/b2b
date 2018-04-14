@extends('admin::layout.box')

@section('boxContent')
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
					<h3 class="ui header font600">
						<div class="content">
							{!! $row['name'] !!}
							<div class="sub header">{!! $row['storage_path'] !!}</div>
						</div>
					</h3>
				</td>
				<td class="center aligned">@include('admin::_parts.table.date')</td>
				<td class="right aligned">
					<div class="ui icon buttons small">
						@include('admin::_parts.table.status')
						<div class="ui right pointing dropdown icon button black">
							<i class="setting icon"></i>
							<div class="menu">
								<div class="item modalImportButton" data-tenant="{!! $row['id'] !!}">
									<i class="cloud upload icon blue"></i> Yükle
								</div>
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
		{!! $rows->appends(request()->only(['status']))->links() !!}
	</div>
@stop

@section('jsCode')
	@parent
	<div id="modalTenantImport" class="ui modal">
		<i class="close icon"></i>
		<section class="box">
			<header>
				<div class="title">
					<i class="cloud upload icon"></i>
					<span>Entegrasyon</span>
				</div>
			</header>
			<div class="ui content data">
				<form id="formImport" class="ui form" data-action="{!! route_action('import') !!}">
					<div class="ui button submit transition hidden"></div>
					<input name="_token" value="{{ csrf_token() }}" type="hidden">
					<input id="formImportTenantId" name="form_tenant_id" value="" type="hidden">
					<div class="ui button huge blue fluid" onclick="App.form.submit('#formImport')">
						Entegrasyon İşlemine Başla!
					</div>
				</form>
			</div>
		</section>
	</div>
	<script>
        $(document).ready(function () {
            App.form.validate('#formImport', {
                file: ['empty']
            });

            $('.modalImportButton').click(function () {
                $('#formImportTenantId').val($(this).data('tenant'));

                App.modal.open('#modalTenantImport');
            });
        });
	</script>
@stop