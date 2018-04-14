@extends('admin::layout.main')

@section('breadcrumbs') @stop

@section('main')
    <div class="content">
        <div class="row">
            <div class="col-sm-12 col-md-8">
                <div class="row">
                    <div class="col-xs-12 col-sm-6 col-md-6">
                        <div class="statistic-box statistic-filled-4">
                            <h2><span class="count-number">{!! $totalDealers !!}</span></h2>
                            <div class="small">Toplam Bayi</div>
                            <i class="fa fa-users statistic_icon"></i>
                        </div>
                    </div>
                    <div class="col-xs-12 col-sm-6 col-md-6">
                        <div class="statistic-box statistic-filled-1">
                            <h2><span class="count-number">0</span></h2>
                            <div class="small">Toplam Sipariş (Günlük)</div>
                            <i class="fa fa-truck statistic_icon"></i>
                        </div>
                    </div>
                    <div class="col-xs-12 col-sm-6 col-md-6">
                        <div class="statistic-box statistic-filled-3">
                            <h2><span class="count-number set currency format" data-price="0"></span></h2>
                            <div class="small">Toplam Ödeme (Günlük)</div>
                            <i class="fa fa-try statistic_icon"></i>
                        </div>
                    </div>
                    <div class="col-xs-12 col-sm-6 col-md-6">
                        <div class="statistic-box statistic-filled-2">
                            <h2><span class="count-number">0</span></h2>
                            <div class="small">İptal Edilen Sipariş (Günlük)</div>
                            <i class="fa fa-thumbs-down statistic_icon"></i>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-sm-12 col-md-4">
                <div class="card">
                    <div class="card-header">
                        <div class="card-header-menu">
                            <i class="fa fa-bars"></i>
                        </div>
                        <div class="card-header-headshot" style="background-image:url('{!! $user['avatar'] ? $user['avatar'] : assets('img/avatar.png') !!}')"></div>
                    </div>
                    <div class="card-content">
                        <div class="card-content-member">
                            <h4 class="m-t-0">{!! $user['name'] !!}</h4>
                            <p class="m-0">{!! $user['email'] !!}</p>
                        </div>
                    </div>
                </div>

                <div class="panel panel-primary">
                    <div class="panel-heading">
                        Lisans ve Versiyon Bilgileri
                    </div>
                    <div class="panel-body">
                        <div class="table-responsive">
                            <table class="table table-striped table-hover fonts12">
                                <tbody>
                                <tr>
                                    <th>Güncel Sürüm</th>
                                    <td class="text-right">v1.0.0</td>
                                </tr>
                                <tr>
                                    <th>Domain</th>
                                    <td class="text-right">{!! tenant('domain.url') !!}</td>
                                </tr>
                                <tr>
                                    <th>Sürüm Tarihi</th>
                                    <td class="text-right">02.03.2018</td>
                                </tr>
                                <tr>
                                    <th>Lisans Kodu</th>
                                    <td class="text-right"></td>
                                </tr>
                                <tr>
                                    <th>Lisans Başlangıç Tarihi</th>
                                    <td class="text-right">08-04-2017</td>
                                </tr>
                                <tr>
                                    <th>Lisans Bitiş Tarihi</th>
                                    <td class="text-right">08-04-2018</td>
                                </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@stop

@section('jsCode')
    @parent
    <script>
        $(document).ready(function() {

        })
    </script>
@stop