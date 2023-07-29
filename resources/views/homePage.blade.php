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
    <link href="./static/CACHE/css/output.718a7af03b3d.css" media="screen" rel="stylesheet" type="text/css" />
    <link href="./static/img/federation/ferwafa.png" rel="shortcut icon" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css" />

    <script src="http://127.0.0.1:35729/livereload.js"></script>
</head>

<body>
    <div id="layout">
        @include('header')
        <div class="hero-header">
            <div class="hero-slider" id="hero-slider">
                @foreach($result as $news)
                @if($news['is_top'] == 1)
                <!-- Item Slide-->
                <div class="item-slider" style="background:url({{ route('news.images.show', $news['image_url'])}})">
                    <div class="container">
                        <div class="row align-items-center">
                            <div class="col-lg-7 single-slider">
                                <div class="info-slider">
                                    <h1>{{ $news['title']}}</h1>
                                    <p>
                                        {{ $news['caption']}}
                                    </p>
                                    <a class="btn-iw outline" href="{{ route('single.news',$news['id'])}}">Read More <i class="fa fa-long-arrow-right"></i></a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                @endif
                @endforeach
            </div>

        </div>
        <section class="content-info">
            <div class="container padding-top recent-news">
                <div class="row container-news">
                    <div class="col-lg-12 col-lg12">
                        <div class="panel-box">
                            <div class="titles">
                                <h4>Recent News</h4>
                            </div>
                        </div>
                    </div>
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
                                <span class="data-info">{{ date('jS M Y', strtotime($news['created_at'])) }}</span>
                                <p>
                                    {{$news['caption']}}
                                </p>
                                <a href="{{ route('single.news',$news['id'])}}">Read More [+]</a>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
                <a href={{ route('all.news')}} class="load-more">Load More</a>
            </div>
            <section class="content-info">
                <div class="single-team-tabs">
                    <div class="container">
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="tab-content">
                                    <div class="tab-pane active" id="summary">
                                        <div class="row">
                                            <div class="col-md-12 partner-main-header">
                                                <div class="col-md-4"></div>

                                                <div style="background-color: #133e8d" class="col-md-2">
                                                    <h3 style="color: white" class="title-partner">
                                                        Our Partners
                                                    </h3>
                                                </div>
                                                <div class="col-md-4"></div>
                                            </div>
                                        </div>
                                        <ul class="sponsors-carousel" style="margin-bottom:100px; margin-top: 150px;">
                                            @foreach($partners as $partner)
                                            <li>
                                                <a target="_blank" href="{{$partner['link']}}"><img alt="" class="commercial-partner" src="{{ route('partner.doc', $partner['url']) }}" /></a>
                                            </li>
                                            @endforeach
                                        </ul>
                                    </div>
                                    <!-- Tab One - Sumary -->
                                </div>
                                <!-- Content Tabs -->
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Single Team Tabs -->
            </section>
        </section>
        @include('footer')
        <script>
            document.getElementById("currentYear").textContent =
                new Date().getFullYear();
        </script>
        <!-- footer Down-->
    </div>
    <!-- End layout-->
    <script src="./static/CACHE/js/output.037fb98d23ee.js"></script>
</body>

</html>