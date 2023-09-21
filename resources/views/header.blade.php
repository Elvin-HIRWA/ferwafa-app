<!DOCTYPE html>

<head>
    <!-- Basic -->
    <meta charset="utf-8" />
    <title>Ferwafa</title>
    <meta content="Ferwafa" name="description" />
    <meta content="koracode" name="author" />
    <!-- Mobile Metas -->
    <meta content="width=device-width, initial-scale=1, shrink-to-fit=no" name="viewport" />
    <link href="{{ asset('static/CACHE/css/output.718a7af03b3d.css') }}" media="screen" rel="stylesheet" type="text/css" />
    <link href="{{ asset('static/img/federation/ferwafa.png') }}" rel="shortcut icon" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css" />

    <script src="http://127.0.0.1:35729/livereload.js"></script>
</head>

<body>
    @php
        $day = DB::table('Game')
            ->join('Day', 'Day.id', '=', 'Game.dayID')
            ->where('Game.isPlayed', 1)
            ->orderBy('Day.id', 'DESC')
            ->first(['Game.dayID']);
    @endphp
    <header>
        <div class="headerbox">
            <div style=" height: 90px" class="container">
                <div class="row justify-content-between align-items-center;">
                    <div class="col">
                        <div style="" class="logo">
                            <a href="/" title="Return Home"><img
                                    style="height: 90px; margin-bottom: 100px; margin-left: 20px" alt="Logo"
                                    class="logo_img" src="{{ asset('static/img/federation/ferwafa.png') }}" /></a>
                        </div>
                    </div>
                    <div class="col" style="display: flex;">
                        <div style="margin-top: 20px;">
                            <marquee behavior="" direction="left">

                                <h2 style="color:  #133E8D"> <a href="{{ route('fixtures.show', $day->dayID) }}"
                                        style="color:  #133E8D">About Primus National League Click here</a></h2>
                            </marquee>
                        </div>
                    </div>
                    <div class="col">
                        <img alt="" height="100px" width="" class="img-responsive banner-image"
                            src="{{ asset('static/img/federation/primus.png') }}" /><a class="mobile-nav"
                            href="#mobile-nav"><i class="fa fa-bars"></i></a>
                    </div>
                </div>
            </div>
        </div>
    </header>
    <nav class="mainmenu">
        <div class="container">
            <!-- Menu-->
            <ul class="sf-menu" id="menu">
                <li class="current"><a href="/">Home</a></li>
                <li class="current"><a href="{{ route('about') }}">About</a></li>
                <li class="current">
                    <a href="">Competitions</a>
                    <ul class="sub-current">
                        <li>
                            <a href="#">Men</a>
                            <ul class="sub-current">
                                <li><a href="{{ route('fixtures.show', $day->dayID) }}">Primus National</a></li>
                                <li><a href="#">Second Division</a></li>
                                <li><a href="#">Third Division</a></li>
                            </ul>
                        </li>
                        <li>
                            <a href="#">Women</a>
                            <ul class="sub-current">
                                <li><a href="#">First Division</a></li>
                                <li><a href="#">Second Division</a></li>
                            </ul>
                        </li>

                        <li><a href="#">Peace Cup</a></li>
                        <li><a href="#">Other</a></li>
                    </ul>
                </li>
                <li class="current">
                    <a href="#">National Team</a>
                    <ul class="sub-current">
                        <li>
                            <a href="#">Men</a>
                            <ul class="sub-current">
                                <li><a href="#">Senior</a></li>
                                <li><a href="#">U-23 Olympic</a></li>
                                <li><a href="#">U-17</a></li>
                                <li><a href="#">Other</a></li>
                                <li><a href="#">History</a></li>
                            </ul>
                        </li>
                        <li>
                            <a href="#">Women</a>
                            <ul class="sub-current">
                                <li><a href="#">Senior</a></li>
                                <li><a href="#">U-20</a></li>
                                <li><a href="#">Other</a></li>
                                <li><a href="#">History</a></li>
                            </ul>
                        </li>
                        <li>
                            <a href="#">Other</a>
                            <ul class="sub-current">
                                <li><a href="#">Results</a></li>
                                <li><a href="#">Fixtures</a></li>
                                <li><a href="#">Statistics</a></li>
                            </ul>
                        </li>
                    </ul>
                </li>
                <li class="current">
                    <a href="#">Resources</a>
                    <ul class="sub-current">
                        <li><a href="{{ route('report') }}">Report</a></li>
                        <li><a href="{{ route('document.page.show') }}">Documents</a></li>
                        <li>
                            <a href="javascript:void(0);">Rules &amp; Regulations</a>
                            <ul class="sub-current">
                                <li><a href="{{ route('laws.page.show') }}">Laws of The Games</a></li>
                                <li><a href="{{ route('rules.page.show') }}">Others</a></li>
                            </ul>
                        </li>
                        <li><a href="{{ route('circular.page.show') }}">Circular</a></li>
                        <li><a href="{{ route('gallery.images') }}">Gallery</a></li>
                    </ul>
                </li>
                <li class="current">
                    <a href="">Development</a>
                    <ul class="sub-current">
                        <li><a href="#">Grassroots Football</a></li>
                        <li><a href="#">Football for schools</a></li>
                        <li><a href="#">Youth Development</a></li>
                    </ul>
                </li>
                <li class="current">
                    <a href="#">Career</a>
                    <ul class="sub-current">
                        <li><a href="{{ route('jobs.page.show') }}">Jobs</a></li>
                        <li><a href="{{ route('tender.page.show') }}">Tenders</a></li>
                        <li><a href="{{ route('career.page.show') }}">Others</a></li>
                    </ul>
                </li>
                <li class="current">
                    <a href="#">Contact</a>
                    <ul class="sub-current">
                        <li><a href="{{ route('information') }}">Information</a></li>
                        <li><a href="{{ route('whistleblowers') }}">Whistleblowers</a></li>
                    </ul>
                </li>
                @if (!Auth::check())
                    <li class="">
                        <a href="{{ route('login') }}">Login</a>
                    </li>
                @endif
            </ul>
            <!-- End Menu-->
        </div>
    </nav>
    <div id="mobile-nav">
        <!-- Menu-->
        <ul class="" id="">
            <li class=""><a href="/">Home</a></li>
            <li class=""><a href="{{ route('about') }}">About</a></li>
            <li class="">
                <a href="javascript:void(0);">Competitions</a>
                <ul class="#">
                    <li>
                        <a href="#">Men</a>
                        <ul class="#">
                            <li><a href="{{ route('fixtures.show', $day->dayID) }}">Primus National</a></li>
                            <li><a href="#">Second Division</a></li>
                            <li><a href="#">Third Division</a></li>
                        </ul>
                    </li>
                    <li>
                        <a href="#">Women</a>
                        <ul class="#">
                            <li><a href="#">First Division</a></li>
                            <li><a href="#">Second Division</a></li>
                        </ul>
                    </li>

                    <li><a href="#">Peace Cup</a></li>
                    <li><a href="#">Other</a></li>
                </ul>
            </li>
            <li class="">
                <a href="javascript:void(0);">National Team</a>
                <ul class="#">
                    <li>
                        <a href="#">Men</a>
                        <ul class="#">
                            <li><a href="#">Senior</a></li>
                            <li><a href="#">U-23 Olympic</a></li>
                            <li><a href="#">U-17</a></li>
                            <li><a href="#">Other</a></li>
                            <li><a href="#">History</a></li>
                        </ul>
                    </li>
                    <li>
                        <a href="#">Women</a>
                        <ul class="#">
                            <li><a href="#">Senior</a></li>
                            <li><a href="#">U-20</a></li>
                            <li><a href="#">Other</a></li>
                            <li><a href="#">History</a></li>
                        </ul>
                    </li>
                    <li>
                        <a href="#">Other</a>
                        <ul class="#">
                            <li><a href="#">Results</a></li>
                            <li><a href="#">Fixtures</a></li>
                            <li><a href="#">Statistics</a></li>
                        </ul>
                    </li>
                </ul>
            </li>
            <li class="javascript:void(0);">
                <a href="#">Resources</a>
                <ul class="#">
                    <li><a href="{{ route('report') }}">Report</a></li>
                    <li><a href="{{ route('document.page.show') }}">Documents</a></li>
                    <li>
                        <a href="">Rules &amp; Regulations</a>
                        <ul class="#">
                            <li><a href="{{ route('laws.page.show') }}">Laws of The Game</a></li>
                            <li><a href="{{ route('rules.page.show') }}">Others</a></li>
                        </ul>
                    </li>
                    <li><a href="{{ route('circular.page.show') }}">Circular</a></li>
                    <li><a href="{{ route('gallery.images') }}">Gallery</a></li>
                </ul>
            </li>
            <li class="">
                <a href="">Development</a>
                <ul class="#">
                    <li>`<a href="#">Grassroots Football</a></li>
                    <li><a href="#">Football for schools</a></li>
                    <li><a href="#">Youth Development</a></li>
                </ul>
            </li>
            <li class="">
                <a href="#">Career</a>
                <ul class="#">
                    <li><a href="{{ route('jobs.page.show') }}">Jobs</a></li>
                    <li><a href="{{ route('tender.page.show') }}">Tenders</a></li>
                    <li><a href="{{ route('career.page.show') }}">Others</a></li>
                </ul>
            </li>
            <li class="">
                <a href="#">Contact</a>
                <ul class="#">
                    <li><a href="{{ route('information') }}">Information</a></li>
                    <li><a href="#">Whistleblowers</a></li>
                </ul>
            </li>
            <li class="">
                <a href="{{ route('login') }}">Login</a>
            </li>
        </ul>
        <!-- End Menu-->
    </div>
    <script src="./static/CACHE/js/output.037fb98d23ee.js"></script>
</body>

</html>
