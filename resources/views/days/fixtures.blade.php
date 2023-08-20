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
                                @include('competition-menus')
                                <div class="row m-0">
                                    <table class="table table-bordered" height="40%">
                                        <thead>
                                            <tr style="background-color: #133E8D;">
                                                <th colspan="3" style="text-align: center; color: white" scope="col">{{ $day->name }}</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach($games as $game)
                                            <tr style="height: 10px">
                                                <td style="width: 30%; text-align: center; vertical-align: middle;">
                                                    {{ $game->homeTeam}}
                                                </td>
                                                <td style="width: 20%; text-align: center; vertical-align: middle;">
                                                    @if($game->homeTeamGoals && $game->awayTeamGoals)
                                                    {{$game->homeTeamGoals}} - {{$game->awayTeamGoals}}
                                                    @else
                                                    <small>{{date('d/m/Y',strtotime($game->date)) }}</small> <br>
                                                    VS <br>
                                                    <small>{{ $game->stadium }}</small>
                                                    @endif
                                                </td>
                                                <td style="width: 30%; text-align: center; vertical-align: middle;">
                                                    {{ $game->awayTeam }}
                                                </td>
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