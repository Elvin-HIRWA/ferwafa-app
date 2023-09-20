<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Basic -->
    <meta charset="utf-8" />
    <title>Ferwafa</title>
    <meta content="Ferwafa" name="description" />
    <meta content="koracode" name="author" />
    <!-- Mobile Metas -->
    <meta content="width=device-width, initial-scale=1, shrink-to-fit=no" name="viewport" />
    <link href="/static/CACHE/css/output.718a7af03b3d.css" media="screen" rel="stylesheet" type="text/css" />
    <script src="http://127.0.0.1:35729/livereload.js"></script>
</head>

<body>
    <div id="layout">
        @include('header')
        <div class="section-title" style="background: url(../static/img/background/footballnew.jpg)">
            <div class="container">
                <div class="row">
                    <div class="col-md-8">
                        <h1 class="banner-title-main">Circular</h1>
                    </div>
                    <div class="col-md-4">
                        <div class="breadcrumbs">
                            <ul>
                                <li><a href="/">Home</a></li>
                                <li>Circular</li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <section class="section-report">
            <h3 class="main-report-title">Circular</h3>
            <div class="report-container">
                @foreach ($circularDocuments as $circularDocument)
                    <div class="report">
                        <div class="report-image">
                            <a><img alt="" src="/static/img/icons/document.png" /></a>
                            <a><img alt="" class="click-report" src="/static/img/icons/click.png" /></a>
                        </div>
                        <div class="report-title">
                            <a href="{{ route('report.doc', $circularDocument['url']) }}" target="_blank">
                                <p>{{ $circularDocument['title'] }}</p>
                            </a>
                        </div>
                    </div>
                @endforeach
            </div>
            <div class="pagination">
                <ul>
                    <li class="arrow-pagination">
                        <a href="#!"><img alt="" src="/static/img/icons/arrow-left.png" /></a>
                    </li>
                    <li><a href="#!">1</a></li>
                    <li><a href="#!">2</a></li>
                    <li><a href="#!">3</a></li>
                    <li><a href="#!">4</a></li>
                    <li><a href="#!">5</a></li>
                    <li class="arrow-pagination">
                        <a href="#!"><img alt="" src="/static/img/icons/arrow-right.png" /></a>
                    </li>
                </ul>
            </div>
        </section>
        @include('footer')
    </div>
</body>
