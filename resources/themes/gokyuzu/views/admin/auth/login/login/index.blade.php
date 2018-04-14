@extends('admin::layout.auth')

@section('body')
    <div class="login-wrapper">
        <div class="container-center">
            <div class="panel panel-bd">
                <div class="col-md-6 hidden-sm hidden-xs text center" style="margin-top: 8%;">
                    <img src="{!! theme('login_logo') !!}" alt="{!! theme('logoName') !!}">
                </div>
                <div class="col-md-6">
                    <div class="panel-heading">
                        <div class="view-header">
                            <div class="header-icon">
                                <i class="pe-7s-unlock"></i>
                            </div>
                            <div class="header-title">
                                <h3>{!! theme('logoName') !!}</h3>
                                <small>{!! theme('slogan') !!}</small>
                            </div>
                        </div>
                    </div>
                    <div class="panel-body">
                        <form id="{!! $appRouter['current']['as'] !!}" data-action="{!! route_action('check') !!}"
                              class="ui form">
                            <input name="_token" value="{{ csrf_token() }}" type="hidden">
                            <div class="field">
                                <div class="ui labeled input">
                                    <div class="ui label icon">
                                        <i class="mail outline icon"></i>
                                    </div>
                                    <input name="email" placeholder="@lang($pathLang.'.form.email')" type="email">
                                </div>
                            </div>
                            <div class="field">
                                <div class="ui labeled input">
                                    <div class="ui label icon">
                                        <i class="lock icon"></i>
                                    </div>
                                    <input name="password" placeholder="@lang($pathLang.'.form.password')" type="password">
                                </div>
                            </div>
                            <div class="two fields">
                                <div class="field">
                                    <div class="ui checkbox huge">
                                        <input type="checkbox" tabindex="0" class="hidden">
                                        <label>@lang($pathLang.'.form.rememberMe')</label>
                                    </div>
                                </div>
                                <div class="field text right">
                                    <div class="ui blue submit button">
                                        @lang($pathLang.'.form.submit')
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
                <div class="clearfix"></div>
            </div>
            <div id="bottom_text">
                Copyright © 2018 Demo Firma Ltd. Şti. B2B Platformu<br>
                <a href="#">BeexSoft B2B Yazılımı</a> | Yazılım Sağlayıcı
                <a href="http://www.mikroantalya.com" target="_blank">Antalya Mikro Yazılımevi</a>
            </div>
        </div>
    </div>
@stop

@section('jsCode')
    @parent
    <script>
        $(document).ready(function () {
            App.form.validate('#{!! $appRouter['current']['as'] !!}', {
                email: ['empty', 'email'],
                password: ['empty', 'length[6]', 'maxLength[30]']
            });
        });
    </script>
@stop