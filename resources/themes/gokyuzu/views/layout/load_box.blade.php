@yield('boxBefore')
@section('box')
    <section class="box">
        <header>
            <div class="title">
                <i class="icon route method {!! $appRouter['current']['code'] !!}"></i>
                <span>{!! $meta['title'] !!}</span>
            </div>
            <div class="ui icons buttons">
                <div class="ui right pointing dropdown icon button">
                    <i class="settings icon"></i>
                    <div class="menu">
                        @yield('buttonMisc')
                        @include('admin::layout._parts.box.button_misc')
                    </div>
                </div>
                @yield('buttonBefore')
                @include('admin::layout._parts.box.button_'.$appRouter['current']['code'])
                @yield('buttonsAfter')
            </div>
        </header>
        <div class="ui content data">
            @yield('boxContentBefore')
            @yield('boxContent')
            @yield('boxContentAfter')
        </div>
    </section>
    <div id="data-{!! $appRouter['current']['as'] !!}" class="multiple destroy data">
        <input name="id" value="" type="hidden">
        <input name="row_id" value="#row-{!! $appRouter['current']['as'] !!}-" type="hidden">
    </div>
@show
@yield('boxAfter')
@yield('jsCode')
<script>
    $(document).ready(function () {
        Data.route.current.as = "{!! $appRouter['current']['as'] !!}";
        App.run();
    });
</script>