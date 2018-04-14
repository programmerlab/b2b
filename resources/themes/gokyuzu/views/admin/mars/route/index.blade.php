@extends('admin::layout.box')

@section('style')
    @parent
    <link href="{!! assets('css/plugin.min.css') !!}" rel="stylesheet">
@stop

@section('script')
    @parent
    <script src="{!! assets('js/plugin.min.js') !!}"></script>
@stop

@section('boxContent')
    <div id="nestableIndex"></div>
    <div id="buttonNestableIndex"></div>
    <div class="clearfix"></div>
@stop

@section('jsCode')
    @parent
    <script>
        $(document).ready(function() {
            $('#buttonNestableIndex').on('click', function() {
                App.load('#nestableIndex', '{!! route_name($appRouter['name'].'GetNestable') !!}');
            });

            $('#buttonNestableIndex').click();
        });
    </script>
@stop