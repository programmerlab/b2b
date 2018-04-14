@extends('admin::layout.main')

@section('main')
    @parent
    @yield('boxBefore')
    <div class="panel panel-gray panel-crud">
        <div class="panel-heading">
            <div class="row">
                <div class="col-md-4">
                    <div class="panel-title">
                        <h4>{!! $meta['title'] !!}</h4>
                    </div>
                </div>
                <div class="col-md-8 text right">
                    <div class="ui icons buttons">
                        @yield('buttonBefore')
                        @include('admin::layout._parts.box.button_'.$appRouter['current']['code'])
                        @yield('buttonsAfter')
                    </div>
                </div>
            </div>
        </div>
        <div class="panel-body">
            @yield('boxContentBefore')
            @yield('boxContent')
            @yield('boxContentAfter')
        </div>
    </div>
    @yield('boxAfter')
    <div id="data-{!! $appRouter['current']['as'] !!}" class="multiple destroy data">
        <input name="id" value="" type="hidden">
        <input name="row_id" value="#row-{!! $appRouter['current']['as'] !!}-" type="hidden">
    </div>
@stop

