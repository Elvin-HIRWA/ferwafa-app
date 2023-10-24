<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Basic -->
    <meta charset="utf-8" />
    <title>Ferwafa</title>
    <meta content="Ferwafa" name="description" />
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
        <div class="section-title big-title" style="background: url(../static/img/background/footballnew.jpg)">
            <div class="container">
                <div class="row">
                    <div class="col-md-8">
                        <h1 class="banner-title-main">About Us</h1>
                    </div>
                    <div class="col-md-4">
                        <div class="breadcrumbs">
                            <ul>
                                <li><a href="/">Home</a></li>
                                <li>About</li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <section class="content-info">
            <!-- White Section -->
            <div class="white-section paddings main-about-sec">
                <div class="container">
                    <div class="row about-container">
                        <div class="col-lg-5">
                            <img alt="" src="/static/img/federation/ferwafa.png" />
                        </div>
                        <div class="col-lg-7">
                            <h4 class="subtitle title-text">Who we Are</h4>
                            <p>
                                The Federation Rwandaise of Football Association (Ferwafa) is
                                a non-governmental and non-profit organization that operates
                                as the sole institution governing football in Rwanda. Our
                                organization has been recognized by both FIFA and CAF as a
                                member since 1978, and we strive to operate within their
                                regulations and uphold our own statutes. Ferwafa is committed
                                to developing and promoting football in Rwanda, organizing
                                competitions, training courses, and seminars aimed at
                                improving various aspects of Rwandan football. We take pride
                                in our national team, nicknamed The Wasps, who are currently
                                ranked 68th (World) and 19th (Africa) in FIFA World
                                statistics.
                            </p>
                            <div class="row">
                                <div class="col-lg-6">
                                    <h5 class="title-text">Our Mission</h5>
                                    <p>
                                        As the national governing body for football in Rwanda, our
                                        mission at Ferwafa is to develop and organize football
                                        competitions throughout the country in accordance with
                                        FIFA/CAF regulations. We strive to promote unity,
                                        discipline, and victory, while upholding the principles of
                                        fair play and integrity. We aim to improve the country's
                                        FIFA/CAF ranking and contribute to the physical and moral
                                        self-fulfillment of the population through football.
                                    </p>
                                </div>
                                <div class="col-lg-6">
                                    <h5 class="title-text">Our Vision</h5>
                                    <p>
                                        Our vision is to make Rwanda a competitive football nation
                                        that participates in international tournaments regularly,
                                        including the World Cup and Africa Cup of Nations. We
                                        aspire to develop football infrastructure and promote the
                                        sport's popularity throughout the country, while creating
                                        opportunities for players, coaches, referees, and
                                        officials to reach their full potential.
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row committee-container">
                        <div class="col-lg-12 col-md-12 col-sm-12 text-center">
                            <h3 class="committee-title">Our Executive Committee</h3>
                        </div>
                        @foreach ($committe as $value)
                            <div class="col-lg-3 col-md-6 col-sm-12">
                                <div class="staff-card">
                                    <div class="staff-image">
                                        <img class="people" src="{{ route('comitte.doc', $value['url']) }}" /><img
                                            class="pattern" src="/static/img/background/pattern.png" />
                                    </div>
                                    <div class="staff-desc">
                                        <h6 class="staff-name">{{ $value['name'] }}</h6>
                                        <p class="staff-position">{{ $value['position'] }}</p>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </section>
        @include('footer')
    </div>
</body>
