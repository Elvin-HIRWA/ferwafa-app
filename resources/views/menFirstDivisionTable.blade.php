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
    @include('header')
    <div class="section-title big-title" style="background: url(../static/img/background/footballnew.jpg)">
        <div class="container">
            <div class="row">
                <div class="col-md-8">
                    <h1 class="banner-title-main">First Division</h1>
                </div>
                <div class="col-md-4">
                    <div class="breadcrumbs">
                        <ul>
                            <li><a href="/">Home</a></li>
                            <li>First Division</li>
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
                                    <ul class="menus">
                                        <li><a href="{{ route('fixtures.show', $days[0]->id) }}">Results & Fixtures</a></li> /
                                        <li><a href="{{ route('men.first-division-table') }}">Standing</a></li>
                                    </ul>
                                </div>
                                <div class="row m-0">
                                    <table class="table table-bordered">
                                        <thead>
                                            <tr>
                                                <th style="width: 5%" scope="col">#</th>
                                                <th style="width: 50%" scope="col">Team</th>
                                                <th style="width: 10%" scope="col">P</th>
                                                <th style="width: 10%" scope="col">GW</th>
                                                <th style="width: 10%" scope="col">GL</th>
                                                <th style="width: 10%" scope="col">GD</th>
                                                <th style="width: 10%" scope="col">Pts</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr style="background-color: #90EE90">
                                                <th scope="row">1</th>
                                                <td>AMAGAJU</td>
                                                <td>0</td>
                                                <td>0</td>
                                                <td>0</td>
                                                <td>0</td>
                                                <td>0</td>
                                            </tr>
                                            <tr>
                                                <th scope="row">2</th>
                                                <td>APR FC</td>
                                                <td>0</td>
                                                <td>0</td>
                                                <td>0</td>
                                                <td>0</td>
                                                <td>0</td>
                                            </tr>
                                            <tr>
                                                <th scope="row">3</th>
                                                <td>AS KIGALI</td>
                                                <td>0</td>
                                                <td>0</td>
                                                <td>0</td>
                                            </tr>
                                            <tr>
                                                <th scope="row">4</th>
                                                <td>BUGESERA FC</td>
                                                <td>0</td>
                                                <td>0</td>
                                                <td>0</td>
                                            </tr>
                                            <tr>
                                                <th scope="row">5</th>
                                                <td>ETOILE DE L'EST</td>
                                                <td>0</td>
                                                <td>0</td>
                                                <td>0</td>
                                            </tr>
                                            <tr>
                                                <th scope="row">6</th>
                                                <td>ETINCELLES FC</td>
                                                <td>0</td>
                                                <td>0</td>
                                                <td>0</td>
                                            </tr>
                                            <tr>
                                                <th scope="row">7</th>
                                                <td>GASOGI UNITED</td>
                                                <td>0</td>
                                                <td>0</td>
                                                <td>0</td>
                                            </tr>

                                            <tr>
                                                <th scope="row">8</th>
                                                <td>GORILLA FC</td>
                                                <td>0</td>
                                                <td>0</td>
                                                <td>0</td>
                                            </tr>
                                            <tr>
                                                <th scope="row">9</th>
                                                <td>MARINES FC</td>
                                                <td>0</td>
                                                <td>0</td>
                                                <td>0</td>
                                            </tr>
                                            <tr>
                                                <th scope="row">10</th>
                                                <td>MUHAZI UNITED FC</td>
                                                <td>0</td>
                                                <td>0</td>
                                                <td>0</td>
                                            </tr>
                                            <tr>
                                                <th scope="row">11</th>
                                                <td>MUKURA VS</td>
                                                <td>0</td>
                                                <td>0</td>
                                                <td>0</td>
                                            </tr>
                                            <tr>
                                                <th scope="row">12</th>
                                                <td>MUSANZE FC</td>
                                                <td>0</td>
                                                <td>0</td>
                                                <td>0</td>
                                            </tr>
                                            <tr>
                                                <th scope="row">13</th>
                                                <td>POLICE FC</td>
                                                <td>0</td>
                                                <td>0</td>
                                                <td>0</td>
                                            </tr>
                                            <tr style="background-color: #FF7F7F">
                                                <th scope="row">14</th>
                                                <td>RAYON SPORT</td>
                                                <td>0</td>
                                                <td>0</td>
                                                <td>0</td>
                                            </tr>
                                            <tr style="background-color: #FF7F7F">
                                                <th scope="row">15</th>
                                                <td>SC KIYOVU</td>
                                                <td>0</td>
                                                <td>0</td>
                                                <td>0</td>
                                            </tr>
                                            <tr style="background-color: #FF7F7F">
                                                <th scope="row">16</th>
                                                <td>SUNRISE FC</td>
                                                <td>0</td>
                                                <td>0</td>
                                                <td>0</td>
                                            </tr>
                                        </tbody>
                                    </table>
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