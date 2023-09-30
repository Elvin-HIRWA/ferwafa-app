<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Basic -->
    <meta charset="utf-8" />
    <title>report</title>
    <meta content="Ferwafa" name="description" />
    <meta content="koracode" name="author" />
    <!-- Mobile Metas -->
    <meta content="width=device-width, initial-scale=1, shrink-to-fit=no" name="viewport" />
    <link href="/static/CACHE/css/output.718a7af03b3d.css" media="screen" rel="stylesheet" type="text/css" />
    <link href="/static/img/federation/ferwafa.png" rel="shortcut icon" />
    <script src="http://127.0.0.1:35729/livereload.js"></script>
</head>

<body>
    <div id="layout">
        @include('header')
        <div class="section-title" style="background: url(../static/img/background/footballnew.jpg)">
            <div class="container">
                <div class="row">
                    <div class="col-md-8">
                        <h1 class="banner-title-main">Report</h1>
                    </div>
                    <div class="col-md-4">
                        <div class="breadcrumbs">
                            <ul>
                                <li><a href="/">Home</a></li>
                                <li>Report</li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <section class="section-report">
            <h3 class="main-report-title">Report</h3>
            <div class="report-container">
                @foreach ($reports as $report)
                <div class="report">
                    <div class="report-image">
                        <a><img alt="" src="/static/img/icons/document.png" /></a>
                        <a><img alt="" class="click-report" src="/static/img/icons/click.png" /></a>
                    </div>
                    <div class="report-title">
                        @php
                        $fileUrl = explode('/', $report->url)[1];
                        @endphp
                        <a href="{{ route('report.doc', $fileUrl) }}" target="_blank">
                            <p>{{ $report->title }}</p>
                        </a>
                    </div>
                </div>
                @endforeach

            </div>
            <div class="pagination">
                {{ $reports->links('pagination::bootstrap-4') }}
            </div>
        </section>
        @include('footer')
    </div>
</body>