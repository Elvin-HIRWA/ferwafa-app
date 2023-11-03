<div>
    @php
        $competions = DB::table('TeamCategory')
            ->select('id', 'name')
            ->get();

        $menDay = DB::table('Game')
            ->join('Day', 'Day.id', '=', 'Game.dayID')
            ->join('Team', 'Team.id', '=', 'homeTeamID')
            ->join('TeamCategory', 'Team.categoryID', '=', 'TeamCategory.id')
            ->where('Game.isPlayed', 1)
            ->where('TeamCategory.id', $competions[0]->id)
            ->orderBy('Day.id', 'DESC')
            ->first(['Game.dayID']);
        $womenDay = DB::table('Game')
            ->join('Day', 'Day.id', '=', 'Game.dayID')
            ->join('Team', 'Team.id', '=', 'homeTeamID')
            ->join('TeamCategory', 'Team.categoryID', '=', 'TeamCategory.id')
            ->where('Game.isPlayed', 1)
            ->where('TeamCategory.id', $competions[1]->id)
            ->orderBy('Day.id', 'DESC')
            ->first(['Game.dayID']);
    @endphp
    <!-- Header -->
    <header class="header-main container-fluid no-padding">
        <!-- Top Header -->
        <div class="top-header container-fluid no-padding headerBackground" style="margin-bottom: 24px">
            <!-- Container -->
            <div class="container-fluid">
                <div class="row">
                    <!-- Social -->
                    <div class="col-md-2 col-sm-2 col-xs-2 logo-block">
                        <a href="/" title="Logo">
                          <img src="images/logo.png" alt="logo" width="66" height="61" />
                        </a>
                      </div>
                    <!-- Social /- -->
                    <!-- Logo Block -->
                    <div class="col-md-8 col-sm-8 col-xs-8 logo-block">
                        <marquee behavior="" direction="left">
                            @if ($menDay)
                                <h2 style="color:  #133E8D"> <a
                                        href="{{ route('fixtures.show', [$competions[0]->id, $menDay->dayID]) }}"
                                        style="color:  #133E8D">About Primus National League Click here</a></h2>
                            @else
                                <h2 style="color:  #133E8D"> <a
                                        href="{{ route('fixtures.show', [$competions[0]->id, 1]) }}"
                                        style="color:  #133E8D">About Primus National League Click here</a></h2>
                            @endif
                        </marquee>
                        </a>
                    </div>
                    <!-- Logo Block /- -->
                    <!-- Register -->
                    <div class="col-md-2 col-sm-2 col-xs-2 logo-block">
                        <a href="/" title="Logo">
                          <img src="images/primus.png" alt="logo" width="66" height="61" />
                        </a>
                      </div>
                </div>
            </div>
            <!-- Container /- -->
        </div>
        <!-- Top Header /- -->

        <!-- Menu Block -->
        <div class="menu-block container-fluid no-padding">
            <!-- Container -->
            <div style="background-color: #133E8D;" class="container-fluid no-padding">
                <!-- User /- -->
                <div class="col-md-12 col-sm-12">
                    <!-- Navigation -->
                    <nav class="navbar ow-navigation">
                        <div class="navbar-header">
                            <button aria-controls="navbar" aria-expanded="false" data-target="#navbar"
                                data-toggle="collapse" class="navbar-toggle collapsed" type="button">
                                <span class="sr-only">Toggle navigation</span>
                                <span class="icon-bar"></span>
                                <span class="icon-bar"></span>
                                <span class="icon-bar"></span>
                            </button>
                            <a title="Logo" href="#" class="navbar-brand"><img src="../asset/images/logo.png"
                                    alt="logo" /><span>Ferwafa</span></a>
                        </div>
                        <div class="navbar-collapse collapse" id="navbar">
                            <ul class="nav navbar-nav">
                                <li>
                                    <a title="Event List" href="/">Home</a>
                                </li>
                                <li>
                                    <a title="Event List" href="{{ route('about') }}">About Us</a>
                                </li>
                                <li class="dropdown">
                                    <a aria-expanded="false" aria-haspopup="true" role="button" class="dropdown-toggle"
                                        title="Pages" href="#">Competitions <i class="fa fa-angle-down"></i></a>
                                    <i class="ddl-switch fa fa-angle-down"></i>
                                    <ul class="dropdown-menu">
                                        <li class="dropdown">
                                            <a title="Event Grid" href="#"
                                                style="display: flex; justify-content:space-between"><span>{{ $competions[0]->name }}</span>
                                                <i class="fa fa-angle-right"></i></a>
                                            <i class="ddl-switch fa fa-angle-down"></i>
                                            <ul class="dropdown-menu">
                                                <li>
                                                    @if ($menDay)
                                                        <a title="Event List"
                                                            href="{{ route('fixtures.show', [$competions[0]->id, $menDay->dayID]) }}">Primus
                                                            National</a>
                                                    @else
                                                        <a title="Event List"
                                                            href="{{ route('fixtures.show', [$competions[0]->id, 1]) }}">Primus
                                                            National</a>
                                                    @endif
                                                </li>
                                                <li>
                                                    <a title="Event List" href="#">Second Division</a>
                                                </li>
                                            </ul>
                                        </li>
                                        <li class="dropdown">
                                            <a title="Event List" href="#"
                                                style="display: flex; justify-content:space-between"><span>{{ $competions[1]->name }}</span>
                                                <i class="fa fa-angle-right"></i></a>
                                            <i class="ddl-switch fa fa-angle-down"></i>
                                            <ul class="dropdown-menu">
                                                <li>
                                                    @if ($womenDay)
                                                        <a title="Event List"
                                                            href="{{ route('fixtures.show', [$competions[1]->id, $womenDay->dayID]) }}">First
                                                            Division</a>
                                                    @else
                                                        <a title="Event List"
                                                            href="{{ route('fixtures.show', [$competions[1]->id, 1]) }}">First
                                                            Division</a>
                                                    @endif
                                                </li>
                                                <li>
                                                    <a title="Event List" href="#">Second Division</a>
                                                </li>
                                            </ul>
                                        </li>
                                        <li><a title="404" href="#">Peace cup</a></li>

                                        <li><a title="404" href="#">Other</a></li>
                                    </ul>
                                </li>
                                <li class="dropdown">
                                    <a aria-expanded="false" aria-haspopup="true" role="button" class="dropdown-toggle"
                                        title="Pages" href="#">National Team <i
                                            class="fa fa-angle-down"></i></a>
                                    <i class="ddl-switch fa fa-angle-down"></i>
                                    <ul class="dropdown-menu">
                                        <li class="dropdown">
                                            <a title="Event Grid" href="#"
                                                style="display: flex; justify-content:space-between"><span>{{ $competions[0]->name }}</span>
                                                <i class="fa fa-angle-right"></i></a>
                                            <i class="ddl-switch fa fa-angle-down"></i>
                                            <ul class="dropdown-menu">
                                                <li>
                                                    <a title="Event List"
                                                        href="{{ route('seniorMen.news') }}">Senior</a>
                                                </li>
                                                <li>
                                                    <a title="Event List" href="{{ route('u23.news') }}">U-23
                                                        Olympic</a>
                                                </li>
                                                <li>
                                                    <a title="Event List" href="{{ route('u17.news') }}">U-17</a>
                                                </li>
                                                <li>
                                                    <a title="Event List"
                                                        href="{{ route('otherMen.news') }}">Other</a>
                                                </li>
                                            </ul>
                                        </li>
                                        <li class="dropdown">
                                            <a title="Event List" href="#"
                                                style="display: flex; justify-content:space-between"><span>{{ $competions[1]->name }}</span>
                                                <i class="fa fa-angle-right"></i></a>
                                            <i class="ddl-switch fa fa-angle-down"></i>
                                            <ul class="dropdown-menu">
                                                <li>
                                                    <a title="Event List"
                                                        href="{{ route('seniorWomen.news') }}">Senior</a>
                                                </li>
                                                <li>
                                                    <a title="Event List"
                                                        href="{{ route('u20Women.news') }}">U-20</a>
                                                </li>
                                                <li>
                                                    <a title="Event List"
                                                        href="{{ route('otherWomen.news') }}">Other</a>
                                                </li>
                                            </ul>
                                        </li>
                                    </ul>
                                </li>
                                <li class="dropdown">
                                    <a aria-expanded="false" aria-haspopup="true" role="button"
                                        class="dropdown-toggle" title="Pages" href="#">Resources <i
                                            class="fa fa-angle-down"></i></a>
                                    <i class="ddl-switch fa fa-angle-down"></i>
                                    <ul class="dropdown-menu">
                                        <li>
                                            <a title="Event List" href="#">Report</a>
                                        </li>
                                        <li>
                                            <a title="Event List" href="#">Documents</a>
                                        </li>
                                        <li class="dropdown">
                                            <a title="Event Grid" href="#"
                                                style="display: flex; justify-content:space-between"><span>Rules &amp;
                                                    Regulations</span> <i class="fa fa-angle-right"></i></a>
                                            <i class="ddl-switch fa fa-angle-down"></i>
                                            <ul class="dropdown-menu">
                                                <li>
                                                    <a title="Event List" href="#">Laws
                                                        of The Games</a>
                                                </li>
                                                <li>
                                                    <a title="Event List" href="#">Others</a>
                                                </li>
                                            </ul>
                                        </li>
                                        <li>
                                            <a title="Event List" href="#">Circular</a>
                                        </li>
                                        <li>
                                            <a title="Event List" href="#">Gallery</a>
                                        </li>
                                    </ul>
                                </li>
                                <li class="dropdown">
                                    <a aria-expanded="false" aria-haspopup="true" role="button"
                                        class="dropdown-toggle" title="Pages" href="#">Development <i
                                            class="fa fa-angle-down"></i></a>
                                    <i class="ddl-switch fa fa-angle-down"></i>
                                    <ul class="dropdown-menu">
                                        <li>
                                            <a title="Event List" href="{{ route('grassroots.news') }}">Grassroots
                                                Football</a>
                                        </li>
                                        <li>
                                            <a title="Event List" href="{{ route('schools.news') }}">Football for
                                                schools</a>
                                        </li>
                                        <li>
                                            <a title="Event List" href="{{ route('youth.news') }}">Youth
                                                Development</a>
                                        </li>
                                    </ul>
                                </li>
                                <li class="dropdown">
                                    <a aria-expanded="false" aria-haspopup="true" role="button"
                                        class="dropdown-toggle" title="Pages" href="#">Career <i
                                            class="fa fa-angle-down"></i></a>
                                    <i class="ddl-switch fa fa-angle-down"></i>
                                    <ul class="dropdown-menu">
                                        <li>
                                            <a title="Event List" href="{{ route('jobs.page.show') }}">Jobs</a>
                                        </li>
                                        <li>
                                            <a title="Event List" href="{{ route('tender.page.show') }}">Tenders</a>
                                        </li>
                                        <li>
                                            <a title="Event List" href="{{ route('career.page.show') }}">Others</a>
                                        </li>
                                    </ul>
                                </li>
                                <li class="dropdown">
                                    <a aria-expanded="false" aria-haspopup="true" role="button"
                                        class="dropdown-toggle" title="Pages" href="#">Contact Us <i
                                            class="fa fa-angle-down"></i></a>
                                    <i class="ddl-switch fa fa-angle-down"></i>
                                    <ul class="dropdown-menu">
                                        <li>
                                            <a title="Event List" href="{{ route('information') }}">Information</a>
                                        </li>
                                        <li>
                                            <a title="Event List"
                                                href="{{ route('whistleblowers') }}">Whistleblowers</a>
                                        </li>
                                    </ul>
                                </li>
                                @if (!Auth::check())
                                    <li>
                                        <a title="Event List" href="{{ route('login') }}">Login</a>
                                    </li>
                                @endif
                            </ul>
                        </div>
                    </nav>
                    <!-- Navigation /- -->
                </div>
            </div>
            <!-- Container /- -->
        </div>
        <!-- Menu Block /- -->
    </header>
    <!-- Header /- -->
</div>
