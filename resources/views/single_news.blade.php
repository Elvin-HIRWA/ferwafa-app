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
    <link href="/static/img/federation/ferwafa.png" rel="shortcut icon" />
    <script src="http://127.0.0.1:35729/livereload.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css" />
</head>

<body>

    @include('header')
    <div id="layout">
        <div class="section-title big-title" style="background: url(../static/img/background/footballnew.jpg)">
            <div class="container">
                <div class="row">
                    <div class="col-md-8">
                        <h1 class="banner-title-main">News</h1>
                    </div>
                    <div class="col-md-4">
                        <div class="breadcrumbs">
                            <ul>
                                <li><a href="/">Home</a></li>
                                <li>News</li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- End Section Title -->
        <!-- Section Area - Content Central -->
        <section class="content-info">
            <!-- White Section -->
            <div class="white-section paddings main-about-sec">
                <center>
                    <h1 class="title-text">{{$result['title']}}</h1>
                </center>
                <div class="container">
                    <div class="row about-container">
                        <div class="col-lg-5">
                            <img alt="" src="{{ route('news.images.show', $url[0]['url'])}}" style="width: 100%; height: 100%" />
                        </div>
                        <div class="col-lg-7">
                            {!! $result['description']!!}
                        </div>
                    </div>
                </div>
            </div>
            <!-- End White Section -->
            <!-- Newsletter -->
            <!-- End Newsletter -->
        </section>
        <!-- End Section Area -  Content Central -->
        <!-- footer-->
        @include('footer')
        <script>
            document.getElementById("currentYear").textContent =
                new Date().getFullYear();
        </script>
        <!-- footer Down-->
    </div>
    <!-- End layout-->
    <script src="/static/CACHE/js/output.037fb98d23ee.js"></script>
</body>

</html>