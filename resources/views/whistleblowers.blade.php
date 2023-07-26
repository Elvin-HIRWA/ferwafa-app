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
    @include('header')
    <div class="section-title big-title" style="background: url(../static/img/background/footballnew.jpg)">
        <div class="container">
            <div class="row">
                <div class="col-md-8">
                    <h1 class="banner-title-main">Contact Us</h1>
                </div>
                <div class="col-md-4">
                    <div class="breadcrumbs">
                        <ul>
                            <li><a href="/">Home</a></li>
                            <li>Contact</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <section class="section">
      <div class="container mt-5">
        <div class="row">
          <div class="col-12 col-md-10 offset-md-1 col-lg-10 offset-lg-1">
            <div class="card card-primary">
              <div class="row m-0">
                <div class="col-12 col-md-12 col-lg-12 p-0">
                  <div class="col-12 col-md-12 card-header text-center">
                    <h4>Whistle Blowers</h4>
                  </div>
                  <div class="row m-0">
                    <div class="card-body">
                      <form method="POST">
                        <div class="form-group floating-addon">
                          <textarea class="form-control" placeholder="Type your message" rows="20" cols="50"></textarea>
                        </div>
                        <div class="form-group text-center">
                          <button type="submit" class="btn btn-round btn-lg btn-primary">
                            Send Message
                          </button>
                        </div>
                      </form>
                    </div>
                    <div class="col-12 col-md-12 col-lg-7 p-0">
                      <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3987.5040318930764!2d30.114316874739334!3d-1.951599998030699!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x19dca703a72ebd1f%3A0xe2a239a98d1f7d83!2sRwanda%20Football%20Federation!5e0!3m2!1sen!2srw!4v1690366633904!5m2!1sen!2srw" width="800" height="500" style="border:0; height: 400px" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>                      {{-- <iframe src="[your unique google URL] " width="600" height="450" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe> --}}
                      {{-- <div id="map" class="contact-map"></div> --}}
                    </div>
                  </div>
                </div>
                {{-- <div class="col-12 col-md-12 col-lg-7 p-0">
                  <div id="map" class="contact-map"></div>
                </div> --}}
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>
    @include('footer')
</body>