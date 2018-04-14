@extends('admin::layout.box')

@section('boxContent')
    <form id="{!! $appRouter['current']['as'] !!}" data-action="{!! route_action('update') !!}" class="ui form">
        <div class="ui button submit transition hidden"></div>
        <input name="_token" value="{{ csrf_token() }}" type="hidden">
        <input name="id" value="{!! $row['id'] !!}" type="hidden">

        <div class="field">
            <label for="">Durum</label>
            @include('admin::_parts.dropdown.status', [
                'name' => 'status_id',
				'value' => $row['status_id'],
				'type' => 'instantPayment'
			])
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