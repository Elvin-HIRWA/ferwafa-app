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

    <style>
        .menus {
            list-style: none;
        }

        .menus li {
            display: inline-block;
            margin-right: 10px;
            /* add spacing between items */
        }
    </style>
</head>

<body>

    <section class="section">
        <div class="container mt-5">
            <div class="row">
                <div class="col-12 col-md-10 offset-md-1 col-lg-10 offset-lg-1">
                    <div class="card card-primary">
                        <div class="row m-0">
                            <div class="col-12 col-md-12 col-lg-12 p-0">
                                <div class="col-12 col-md-12 card-header text-center">
                                    <ul class="menus">
                                        @if($day)
                                        <li><a href="{{ route('fixtures.show',$day->id) }}">Results & Fixtures</a></li> /
                                        <li><a href="{{ route('men.first-division-table') }}">Standing</a></li>
                                        @else
                                        <h1>No Available Fixtures</h1>
                                        @endif
                                    </ul>
                                    <ul class="menus">
                                        @foreach($days as $day)
                                        <li><a href="{{ route('fixtures.show',$day->id) }}">{{ $day->abbreviation }}</a></li>/
                                        @endforeach
                                    </ul>
                                </div>
                                <div class="row m-0">

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</body>