<!doctype html>
<html lang="{!! lang('iso_code') !!}" ng-app="Earth">
<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0">
    <meta name="description" content="{!! $meta['description'] !!}">
    <meta name="keywords" content="{!! $meta['keywords'] !!}">
    <meta name="author" content="{!! $meta['author'] !!}">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{!! $meta['title'] !!}</title>

    <base href="{!! $meta['base'] !!}">
    <link href="{!! $meta['favicon'] !!}" rel="shortcut icon">
    <link rel="canonical" href="{!! $meta['canonical'] !!}" />
    <link href="//cdn.jsdelivr.net/npm/pixeden-stroke-7-icon@1.2.3/pe-icon-7-stroke/dist/pe-icon-7-stroke.min.css" rel="stylesheet">
    <link href="{!! assets('css/bootstrap.min.css') !!}" rel="stylesheet">
    <link href="{!! assets('css/admin.min.css') !!}" rel="stylesheet">
    @yield('style')
    @foreach (explode(',', theme('cssImport')) as $style)
        <link href="{!! $style !!}" rel="stylesheet">
    @endforeach
    <link href="{!! assets('css/app.min.css') !!}" rel="stylesheet">
    <link href="{!! assets('css/component_ui.min.css') !!}" rel="stylesheet">
    <link href="{!! assets('css/custom.css') !!}" rel="stylesheet">
    @yield('cssCode')
    <style>{!! theme('cssCode') !!}</style>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/modernizr/2.8.3/modernizr.min.js"></script>
    <script src="{!! assets('js/admin.min.js') !!}"></script>
    @yield('script')
    @foreach (explode(',', theme('jsImport')) as $style)
        <link href="{!! $style !!}" rel="stylesheet">
    @endforeach
    <script>
        var Data = {
            _token : '{!! csrf_token() !!}',
            product: 5,
            customer: '{{ tenant('name') }}',
            route : {
                current : {
                    as : '{!! $appRouter['current']['as'] !!}'
                }
            },
            link   : {
                license    : 'http://vmajans.com/license?jsoncallback=?',
                filemanager: '{!! route_name('filemanagerGetLayout') !!}',
            },
            local  : {
                lang      : {!! lang() !!},
                currency  : {!! currency() !!},
                langs     : {!! json_encode(config('langs')) !!},
                currencies: {!! json_encode(config('currencies')) !!},
            },
            lang   : {
                error : {
                    default : '500 Hatası!',
                    license : 'Lisans bilgilerinize erişim sağlanamdı!',
                    reload  : 'Sayfa yüklenirken hata ile karşılaşıldı',
                    notFound: 'Sayfa Bulunamadı!'
                },
                info  : {
                    license: 'Lisans bilgileriniz kontrol ediliyor...',
                },
                reload: 'Yükleniyor...',
                wait  : 'İşleminiz gerçekleştiriliyor...',
                dimmer: '',
                prompt: {!! json_encode(trans('prompt'), true) !!}
            },
            theme  : {
                noimage: '{!! assets('image/no-image.png') !!}'
            }
        }
    </script>
    <script src="{!! assets('js/app.min.js') !!}"></script>

    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
</head>
<body ng-controller="{!! $appRouter['controller'] !!}Controller">
    <div id="pageDimmer"></div>
    @yield('body')
    <form id="fakeForm" data-action="" class="ui transition hidden">
        <input name="_token" value="{{ csrf_token() }}" type="hidden">
        <div class="data"></div>
    </form>
    <script>
        earth.controller("{!! $appRouter['controller'] !!}Controller", function($scope) {});
    </script>
    @yield('jsCode')
    <script>{!! theme('jsCode') !!}</script>
</body>
</html>