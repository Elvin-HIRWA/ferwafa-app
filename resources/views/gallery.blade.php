<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Basic -->
    <meta charset="utf-8" />
    <title>gallery</title>
    <meta content="Ferwafa" name="description" />
    <meta content="koracode" name="author" />
    <!-- Mobile Metas -->
    <meta content="width=device-width, initial-scale=1, shrink-to-fit=no" name="viewport" />
    <link href="/static/CACHE/css/output.718a7af03b3d.css" media="screen" rel="stylesheet" type="text/css" />
    <link href="/static/img/federation/ferwafa.png" rel="shortcut icon" />
    <script src="http://127.0.0.1:35729/livereload.js"></script>
</head>

<body>
    @include('header')
    <div class="section-title" style="background: url(../static/img/background/footballnew.jpg)">
        <div class="container">
            <div class="row">
                <div class="col-md-8">
                    <h1 class="banner-title-main">Gallery</h1>
                </div>
                <div class="col-md-4">
                    <div class="breadcrumbs">
                        <ul>
                            <li><a href="/">Home</a></li>
                            <li>Gallery</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <section class="gallery-section">
        <h3 class="main-report-title">Gallery</h3>
        <div class="gallery-container">
            @foreach($galleries as $gallery)
            <div class="gallery">
                <img alt="gallery" class="single-image-gallery" src="{{ route('gallery.doc', $gallery['url']) }}" /><i aria-hidden="true" class="view-image-gallery"></i>
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
</body>

</html>