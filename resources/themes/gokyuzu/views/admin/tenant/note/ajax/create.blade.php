@extends('admin::layout.load_box')

@section('boxContent')
    <form id="{!! $appRouter['current']['as'] !!}" data-action="{!! route_action('add') !!}" class="ui form">
        <div class="ui button submit transition hidden"></div>
        <input name="_token" value="{{ csrf_token() }}" type="hidden">
        <input name="group_id" value="{!! config('groups.note.'.request('group').'.id') !!}" type="hidden">
        <input name="process_id" value="{!! request('parent') !!}" type="hidden">
        <input name="path" value="{!! request('path') !!}" type="hidden">
        <div class="field">
            <textarea name="content" placeholder="Notunuz"></textarea>
        </div>
    </form>
@stop

@section('jsCode')
    @parent
    <script>
        $(document).ready(function() {
            App.form.validate('#{!! $appRouter['current']['as'] !!}', {
                //
            });
            App.modal.open('#modalUrl', {closable: false});
        });
    </script>
@stop