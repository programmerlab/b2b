@extends('admin::layout.load_box')

@section('boxContent')
	<div class="dd" id="nestable">
		<ol class="dd-list">
			{!! $nestMenu !!}
		</ol>
	</div>
	<div class="clearfix"></div>
@stop

@section('jsCode')
    @parent
    <script>
		$(document).ready(function () {
			$('#nestable')
				.nestable({
					group   : 1,
					maxDepth: 10
				})
				.on('change', function (item) {

					var list   = item.length ? item : $(item.target);
					var output = list.data('output');

					if (!window.JSON) {
						App.message('error', 'mesaj');
						return false;
					}

					var json = window.JSON.stringify(list.nestable('serialize'));

					$.post('{!! route_action('row') !!}', {
						json   : json,
						_token : Data._token,
						menu_id: {!! request('menu') !!}
					}, function (response) {
						if (response.success) {
							return App.message('success', response.success);
						} else {
							return App.message('error', response.error);
						}
					});
				});

			App.run();
		});
    </script>
@stop