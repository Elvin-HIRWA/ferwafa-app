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

        .main {
            background: rgb(127, 206, 127);
        }

        .main-table {
            background: rgb(234, 158, 158);
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
    {{-- @php
                    $changeColor = true;
                @endphp --}}

    <section class="section">
        <div class="container mt-5">
            <div class="row">
                <div class="col-6 col-md-6 offset-md-1 col-lg-6 offset-lg-1">
                    <div class="card card-primary">
                        <div class="row m-0">
                            <div class="col-12 col-md-12 col-lg-12 p-0">
                                <div class="col-12 col-md-12 card-header text-center">
                                    <ul class="menus">
                                        <li><a href="{{ route('fixtures.show', $days[0]->id) }}">Results & Fixtures</a>
                                        </li> /
                                        <li><a href="{{ route('men.first-division-table') }}">Standing</a></li>
                                    </ul>
                                </div>
                                <div class="row m-0">
                                    <table class="table table-bordered main-table">
                                        <thead>
                                            <tr>
                                                <th style="width: 5%" scope="col">#</th>
                                                <th style="width: 50%" scope="col">Team</th>
                                                <th style="width: 10%" scope="col">P</th>
                                                <th style="width: 10%" scope="col">GF</th>
                                                <th style="width: 10%" scope="col">GL</th>
                                                <th style="width: 10%" scope="col">GD</th>
                                                <th style="width: 10%" scope="col">Pts</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($teamStatistics as $key => $teamStatistic)
                                                @if ($key + 1 === count($teamStatistics) || $key + 1 === count($teamStatistics) - 1)
                                                    <tr class="main-table main">
                                                    @else
                                                    <tr>
                                                @endif

                                                @if ($key + 1 == 1)
                                                    <tr class="main">
                                                @endif
                                                <th scope="row">{{ $key + 1 }} </th>
                                                <td>{{ $teamStatistic->name }}</td>
                                                <td>{{ $teamStatistic->matchPlayed }}</td>
                                                <td>{{ $teamStatistic->goalWin }}</td>
                                                <td>{{ $teamStatistic->goalLoss }}</td>
                                                <td>{{ $teamStatistic->goalDifference }}</td>
                                                <td>{{ $teamStatistic->score }}</td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-3 col-md-3 offset-md-1 col-lg-3 offset-lg-1 ml-5">
                    <div class="card card-primary">
                        <div class="row m-0">
                            <div class="col-12 col-md-12 col-lg-12 p-0">
                                <div class="col-12 col-md-12 card-header text-center">
                                    <ul class="menus">
                                        <li><a href="{{ route('fixtures.show', $days[0]->id) }}">Top Scores</a></li>
                                    </ul>
                                </div>
                                <div class="row m-0">
                                    <table class="table table-bordered">
                                        <thead>
                                            <tr>
                                                <th style="width: 5%" scope="col">#</th>
                                                <th style="width: 50%" scope="col">Name</th>
                                                <th style="width: 10%" scope="col">Team</th>
                                                <th style="width: 10%; background-color: #133E8D; color: white" scope="col">Goals</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($topScores as $key => $topScore)
                                                <tr>
                                                    <th scope="row">{{ $key + 1 }}</th>
                                                    <td>{{ $topScore['name'] }}</td>
                                                    <td>{{ $topScore['teamName'] }}</td>
                                                    <td style="background-color: #133E8D; color: white">{{ $topScore['goals'] }}</td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    @include('footer')
</body>
