<!doctype html>
<html lang="tr-tr" ng-app>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>{!! $title !!}</title>

    <base href="{!! url('/') !!}">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">
    <link href='http://fonts.googleapis.com/css?family=Montserrat' rel='stylesheet' type='text/css'>
    <link href='https://fonts.googleapis.com/css?family=Open+Sans:400,600&subset=latin,latin-ext' rel='stylesheet' type='text/css'>

    <style>
        body {
            color: #51646b;
            font-family: 'Open Sans', sans-serif;
            font-size: 14px;
            font-weight: 400;
            letter-spacing: .01em;
            -webkit-font-smoothing: antialiased;
            -webkit-text-size-adjust: 100%;
            -ms-text-size-adjust: 100%;
            -webkit-font-feature-settings: "kern" 1;
            -moz-font-feature-settings: "kern" 1;
            height: 100%;
            margin: 0;
            padding: 0;
            background-color: #f1f3f3;
        }
        .container-xs-height {
            display: table;
            padding-left: 0;
            padding-right: 0;
            width: 100%;
            border-collapse: collapse;
            table-layout: fixed;
        }
        .full-height {
            height: 100%!important;
        }

        .row-xs-height {
            display: table-row;
        }

        .col-xs-height {
            display: table-cell;
            float: none;
        }
        .col-middle {
            vertical-align: middle;
        }

        .error-container {
            margin-top: 18%;
            margin-left: auto;
            margin-right: auto;
        }
        .text-center {
            text-align: center!important;
        }

        .windows h1, .windows h2, .windows h3, .windows h4, .windows h5 {
            font-weight: 300;
            letter-spacing: normal;
        }
        .windows h1 {
            font-size: 33px;
            line-height: 49px;
        }

        .error-number {
            font-family: "Montserrat";
            font-size: 90px;
            line-height: 90px;
        }
        h1 {
            font-size: 44px;
            line-height: 55px;
            letter-spacing: -.08px;
        }
        h1, h2, h3, h4, h5, h6 {
            margin: 10px 0;
            font-family: 'Open Sans', sans-serif;
            -webkit-font-smoothing: antialiased;
            -webkit-text-size-adjust: 100%;
            -ms-text-size-adjust: 100%;
            font-weight: 300;
            color: #242d30;
            letter-spacing: -1px;
        }
        p {
            display: block;
            font-size: 14px;
            font-weight: 400;
            letter-spacing: .01em;
            line-height: 22px;
            margin: 0 0 10px;
            font-style: normal;
            white-space: normal;
        }
    </style>
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
</head>
<body>
    <main id="govde" class="container-xs-height full-height">
        <div class="row-xs-height">
            <div class="col-xs-height col-middle">
                <div class="error-container text-center">
                    <h1 class="error-number">{!! $code !!}</h1>
                    <h2>{!! $message !!}</h2>
                </div>
            </div>
        </div>
    </main>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.4/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>
</body>
</html>