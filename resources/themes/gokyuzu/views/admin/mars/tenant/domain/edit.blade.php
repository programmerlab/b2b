@extends('admin::layout.load_box')

@section('boxContent')
    <form id="{!! $appRouter['current']['as'] !!}" data-action="{!! route_action('update') !!}" class="ui form">
        <div class="ui button submit transition hidden"></div>
        <input name="_token" value="{{ csrf_token() }}" type="hidden">
        <input name="id" value="{!! $row['id'] !!}" type="hidden">
        <input name="fake_tenant_id" value="{!! $row['tenant_id'] !!}" type="hidden">

        <div class="field">
            <label for="">Domain Adresiniz</label>
            <input name="url" value="{!! $row['url'] !!}" placeholder="Domain Adresiniz" type="url">
        </div>
    </form>
@stop

@section('jsCode')
    @parent
    <script>
        $(document).ready(function() {
            App.form.validate('#{!! $appRouter['current']['as'] !!}', {
                url : ['empty', 'url']
            });

            App.modal.open('#modalUrl', {closable: false});
        });
    </script>
@stop