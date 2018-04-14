@extends('admin::layout.master')

@section('body')
    @parent
    <header class="ui top fixed menu inverted">
        <div class="item">
            <img src="{!! assets('image/logo-white.png') !!}" alt="" class="ui image">
        </div>
    </header>
    <main class="ui middle aligned" style="padding-top: 15%; padding-bottom: 15%;">
        <div class="ui two column centered grid">
            <div class="column text left">
                @yield('main')
            </div>
        </div>
    </main>
@stop