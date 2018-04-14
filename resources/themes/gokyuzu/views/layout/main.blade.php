@extends('admin::layout.master')

@section('body')
    @parent
    <header id="header">
        <nav class="navbar top-nav">
            <div class="container">
                <div class="row">
                    <div class="col-md-4">
                        <div class="navbar-header hidden-xs">
                            <a href="{!! $user['role_redirect'] or '' !!}" class="navbar-brand" title="{!! theme('logoName') !!}">
                                <img src="{!! theme('logo') !!}" class="ui image" alt="{!! theme('logoName') !!}">
                            </a>
                        </div>
                    </div>
                    <div class="col-md-8 text right">
                        <div id="topRightMenu" class="ui icon text compact menu">
                            <div class="ui dropdown pointing item top right icon basic basket">
                                <i class=" shop icon"></i>
                                <div class=" floating ui red mini label" id="totalBasketUserGetIndex">0</div>
                                <div id="loadBasketUserGetIndex" class="menu vertical basket"></div>
                            </div>
                            <div class="ui dropdown pointing item top right icon currencies" tabindex="0">
                                <i class="{!! currency('small_iso_code') !!} icon"></i>
                                <div class="menu transition hidden notifications" tabindex="-1" style="min-width: 300px">
                                    @foreach (config('currencies') as $currency)
                                        <a
                                                href="{!! request()->path() !!}?currency.change={!! $currency['id'] !!}"
                                                class="item {!! $currency['id'] == currency('id') ? 'active' : '' !!}">
                                            <span class="description">{{ $currency['conversion_rate'] }}</span>
                                            <span class="text"><i class="{{ $currency['small_iso_code'] }} icon"></i> {{ $currency['name'] }}</span>
                                        </a>
                                    @endforeach
                                </div>
                            </div>
                            <a href="{!! route_name('adminAccountLogoutGetIndex') !!}" class="item">
                                <i class="sign out icon"></i>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </nav>
        <nav id="menu" class="ui menu ">
            <div class="ui container">
                <div class="left menu desktop only">
                    {!! $menu['main']['horizontal'] or '' !!}
                </div>
            </div>
        </nav>
    </header>
    <section class="content pusher">
        <main id="mainBlock" class="ui main {!! empty($menu['main']['vertical']) ? 'fluid' : '' !!}">
            <div class="ui container">

                @section('breadcrumbs')
                    <section id="page-header">
                        @include('admin::layout._parts.main.breadcrumb')
                    </section>
                @show

                @if ($errors->all())
                    <div class="ui icon error message">
                        <i class="warning sign icon"></i>
                        <div class="content">
                            <div class="header">
                                @lang('admin::admin.error.title')
                            </div>
                            @foreach ($errors->all('<p>:message</p>') as $message)
                                {!! $message !!}
                            @endforeach
                        </div>
                    </div>
                @endif
                @yield('main')
            </div>
        </main>
    </section>
    @include('admin::_parts.modal.approve')
    @include('admin::_parts.modal.on_approve')
    @include('admin::_parts.modal.url')
    @include('admin::_parts.modal.filemanager')

    <div id="buttonBasketUserGetIndex"></div>

    <footer class="main-footer hidden">
        <div class="container">
            <div class="pull-right hidden-xs"> <b>Version</b> 1.0</div>
            <strong>Copyright &copy; 2016-2017 <a href="#">Thememinister</a>.</strong> All rights reserved. <i class="fa fa-heart color-green"></i>
        </div>
    </footer>
@stop

@section('jsCode')
    @parent
    <script>
        $('#buttonBasketUserGetIndex').click(function () {
            App.load('#loadBasketUserGetIndex', '{!! route_name('b2bTenantShopBasketUserGetIndex').'?user=true' !!}');
        });

        $('#buttonBasketUserGetIndex').click();
    </script>
@stop