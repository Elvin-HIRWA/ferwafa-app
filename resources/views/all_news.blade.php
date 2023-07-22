<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <title>Ferwafa</title>
    <meta content="Ferwafa" name="description" />
    <meta content="koracode" name="author" />
    <meta content="width=device-width, initial-scale=1, shrink-to-fit=no" name="viewport" />
    <link href="/static/CACHE/css/output.718a7af03b3d.css" media="screen" rel="stylesheet" type="text/css" />
    <link href="/static/img/federation/ferwafa.png" rel="shortcut icon" />
    <script src="http://127.0.0.1:35729/livereload.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css" />
</head>

<body>
    <div id="layout">
        @include('header')
        <div class="section-title big-title" style="background: url(../static/img/background/footballnew.jpg)">
            <div class="container">
                <div class="row">
                    <div class="col-md-8">
                        <h1 class="banner-title-main">All News</h1>
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
        <section class="content-info">
            <!-- Content Central -->
            <div class="container padding-top recent-news">
                <div class="row container-news">
                    <div class="col-lg-12 col-lg12">
                        <div class="panel-box">
                            <div class="titles">
                                <h4>All News</h4>
                            </div>
                        </div>
                    </div>
                    <!-- content Column Left -->
                    @foreach ($result as $news)
                    <div class="col-lg-6 col-xl-6">
                        <div class="single-home-news">
                            <div class="news-img">
                                <img src="{{ route('news.images.show', $news['image_url'])}}">
                            </div>
                            <div class="news-information">
                                <h5>
                                    <a href="{{ route('single.news',$news['id'])}}">{{ $news['title']}}</a>
                                </h5>
                                <span class="data-info">{{ $news['created_at']}}</span>
                                <p>
                                    {{$news['caption']}}
                                </p>
                                <a href="{{ route('single.news',$news['id'])}}">Read More [+]</a>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
        </section>
        <script>
            document.getElementById("currentYear").textContent =
                new Date().getFullYear();
        </script>
    </div>
    <script src="/static/CACHE/js/output.037fb98d23ee.js"></script>
</body>

</html>