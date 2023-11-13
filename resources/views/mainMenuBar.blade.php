<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Basic -->
    <meta charset="utf-8" />
    <title>Ferwafa</title>
    <meta content="Ferwafa" name="description" />
    <!-- Mobile Metas -->
    <meta content="width=device-width, initial-scale=1, shrink-to-fit=no"
        name="viewport />
    <!-- Standard Favicon -->
    <link rel="icon" type="image/x-icon"
        href="{{ asset('images/favicon.ico') }}" />

    <!-- For iPhone 4 Retina display: -->
    <link rel="apple-touch-icon-precomposed" sizes="114x114" href="{{ asset('images/apple-icon-114x114.png') }}" />

    <!-- For iPad: -->
    <link rel="apple-touch-icon-precomposed" sizes="72x72" href="{{ asset('images/apple-icon-72x72.png') }}" />

    <!-- For iPhone: -->
    <link rel="apple-touch-icon-precomposed" href="{{ asset('images/apple-icon-57x57.png') }}" />

    <!-- Library - Bootstrap v3.3.5 -->
    <link rel="stylesheet" type="text/css" href="{{ asset('libraries/lib.css') }}" />
    <link rel="stylesheet" type="text/css" href="{{ asset('libraries/Stroke-Gap-Icon/stroke-gap-icon.css') }}" />

    <!-- Custom - Common CSS -->
    <link rel="stylesheet" type="text/css" href="{{ asset('css/plugins.css') }}" />
    <link rel="stylesheet" type="text/css" href="{{ asset('css/navigation-menu.css') }}" />
    <link rel="stylesheet" type="text/css" href="{{ asset('libraries/lightslider-master/lightslider.css') }}" />

    <!-- Custom - Theme CSS -->
    <link rel="stylesheet" type="text/css" href="{{ asset('style.css') }}" />
    <link rel="stylesheet" type="text/css" href="{{ asset('css/shortcode.css') }}" />

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

    <style>
        .report {
            height: 170px;
            width: 10%;
            border: 1px solid #133E8D;
            border-radius: 8px;
            cursor: pointer;
            transition: 0.4s;
        }

        .report:hover {
            box-shadow: -5px 8px 30px 0px #133E8D, 0px 10px 15px -3px rgba(0, 0, 0, 0.1)
        }

        .report-image {
            width: 100%;
            height: 60%;
            display: flex;
            align-items: center;
            justify-content: center;
            position: relative
        }

        .click-report {
            position: absolute;
            top: 50%;
            right: 50%;
            transform: translate(50%, -50%);
            animation: bounce-infinite 2s linear infinite;
            display: none
        }

        .report:hover .click-report {
            display: block
        }

        .report-title {
            text-align: center;
            height: 40%;
            padding: 0 6px
        }

        .report-title p {
            font-weight: 500;
            color: black;
            font-size: 13px;
            transition: 0.4s
        }

        .report-title p:hover {
            color: #133E8D
        }

        @media all and (max-width:768px) {
            .report {
                width: 100%;
            }

            .report-container {
                padding-left: 130px;
                padding-right: 130px
            }
        }

        @media all and (max-width:475px) {
            .report {
                width: 100%;
            }

            .report-container {
                padding-left: 130px;
                padding-right: 130px
            }
        }
    </style>
</head>

<body>
    @include('menuBar')
    <!-- PageBanner -->
    <div class="container-fluid page-banner blogpost no-padding">
        <div class="section-padding"></div>
        <div class="container">
            <div class="banner-content-block">
                <div class="banner-content">
                    <h3>Keep in Touch</h3>
                    <ol class="breadcrumb">
                        <li><a href="/">Home</a></li>
                        <li class="active" style="color: yellow"> {{ $name }}</li>
                    </ol>
                </div>
            </div>
        </div>
        <div class="section-padding"></div>
    </div>
    <!-- PageBanner /- -->
</body>
