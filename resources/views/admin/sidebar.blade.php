<!DOCTYPE html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=Nunito" rel="stylesheet">

    <!-- Scripts -->
    @vite(['resources/sass/app.scss', 'resources/js/app.js'])


    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="./assets/css/app.min.css">
    <!-- Template CSS -->
    <link rel="stylesheet" href="./assets/css/style.css">
    <link rel="stylesheet" href="./assets/css/components.css">
    <!-- Custom style CSS -->
    <link rel="stylesheet" href="./assets/css/custom.css">
    <link href="./static/img/federation/ferwafa.png" rel="shortcut icon" />
    <title>Ferwafa</title>
</head>

<body>
    <div class="navbar-bg"></div>
    <nav class="navbar navbar-expand-lg main-navbar sticky">
        <div class="form-inline mr-auto">
            <ul class="navbar-nav mr-3">
                <li>
                    <a href="#" data-toggle="sidebar" class="nav-link nav-link-lg collapse-btn">
                        <i data-feather="align-justify"></i></a>
                </li>
                <li>
                    <a href="#" class="nav-link nav-link-lg fullscreen-btn">
                        <i data-feather="maximize"></i>
                    </a>
                </li>
                <li>
                    <form class="form-inline mr-auto">
                        <div class="search-element">
                            <input class="form-control" type="search" placeholder="Search" aria-label="Search" data-width="200" />
                            <button class="btn" type="submit">
                                <i class="fas fa-search"></i>
                            </button>
                        </div>
                    </form>
                </li>
            </ul>
        </div>
        <ul class="navbar-nav navbar-right">
            <li class="nav-item dropdown">
                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                    {{ Auth::user()->name }}
                </a>

                <div class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                    <a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                        {{ __('Logout') }}
                    </a>

                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                        @csrf
                    </form>
                </div>
            </li>

        </ul>
    </nav>
    <div class="main-sidebar sidebar-style-2">
        <aside id="sidebar-wrapper">
            <div class="sidebar-brand">
                <a href="{{ url('/') }}">
                    <img alt="image" src="{{asset('static/img/federation/ferwafa.png')}}" class="header-logo" />
                    <span class="logo-name">Ferwafa</span>
                </a>
            </div>
            <ul class="sidebar-menu">
                @can('is-admin')
                <li class="dropdown">
                    <a href="{{ route('dashboard.view')}}" class="nav-link">
                        <i class="far fa-envelope"></i><span>Dashboard</span>
                    </a>
                </li>

                {{-- <li class="dropdown">
                    <a href="{{ route('events.view')}}" class="nav-link">
                <i class="fas fa-envelope"></i><span>Events</span>
                </a>
                </li> --}}
                <li class="dropdown">
                    <a href="{{ route('news.view')}}" class="nav-link">
                        <i class="fas fa-envelope"></i><span>News</span>
                    </a>
                </li>
                <li class="dropdown">
                    <a href="{{ route('reports.view') }}" class="nav-link">
                        <i class="fas fa-envelope"></i><span>Documents</span>
                    </a>
                </li>

                {{-- <li class="dropdown">
                    <a href="#" class="nav-link">
                        <i class="fas fa-envelope"></i><span>Permissions</span>
                    </a>
                </li> --}}
                <li class="dropdown">
                    <a href="{{ route('users.view')}}" class="nav-link">
                        <i class="fas fa-envelope"></i><span>Users</span>
                    </a>
                </li>
                <li class="dropdown">
                    <a href="{{ route('committe')}}" class="nav-link">
                        <i class="fas fa-envelope"></i><span>Executive Committee</span>
                    </a>
                </li>
                <li class="dropdown">
                    <a href="{{ route('partner')}}" class="nav-link">
                        <i class="fas fa-envelope"></i><span>Partners</span>
                    </a>
                </li>
                <li class="dropdown">
                    <a href="{{ route('admin.gallery.list')}}" class="nav-link">
                        <i class="fas fa-envelope"></i><span>Gallery</span>
                    </a>
                </li>
                <li class="dropdown">
                    <a href="#" class="menu-toggle nav-link has-dropdown"><i data-feather="briefcase"></i><span>Competitions</span></a>
                    <ul class="dropdown-menu">
                        <li class="dropdown"><a class="menu-toggle nav-link has-dropdown" href="#">Men</a>
                            <ul class="dropdown-menu">
                                <li><a class="nav-link" href="widget-chart.html">First Division</a></li>
                                <li><a class="nav-link" href="widget-data.html">Second Division</a></li>
                                <li><a class="nav-link" href="widget-data.html">Third Division</a></li>
                            </ul>
                        </li>

                        <li class="dropdown"><a class="menu-toggle nav-link has-dropdown" href="#">Women</a>
                            <ul class="dropdown-menu">

                            </ul>
                        </li>

                        <li class="dropdown"><a class="menu-toggle nav-link has-dropdown" href="#">Peace cup</a>
                            <ul class="dropdown-menu">

                            </ul>
                        </li>
                    </ul>
                    <a href="{{ route('season')}}" class="nav-link">
                        <i class="fas fa-envelope"></i><span>Seasons</span>
                    </a>
                </li>
                <li class="dropdown">
                    <a href="{{ route('day.season')}}" class="nav-link">
                        <i class="fas fa-envelope"></i><span>Days</span>
                    </a>
                </li>
                <li class="dropdown">
                    <a href="{{ route('fixtures')}}" class="nav-link">
                        <i class="fas fa-envelope"></i><span>Fixtures</span>
                    </a>
                </li>
                <li class="dropdown">
                    <a href="{{ route('top-score')}}" class="nav-link">
                        <i class="fas fa-envelope"></i><span>top Scores</span>
                    </a>
                </li>
                @else
                @can('is-dcm')
                {{-- <li class="dropdown">
                    <a href="{{ route('events.view')}}" class="nav-link">
                <i class="fas fa-envelope"></i><span>Events</span>
                </a>
                </li> --}}
                <li class="dropdown">
                    <a href="{{ route('news.view')}}" class="nav-link">
                        <i class="fas fa-envelope"></i><span>News</span>
                    </a>
                </li>
                <li class="dropdown">
                    <a href="{{ route('reports.view') }}" class="nav-link">
                        <i class="fas fa-envelope"></i><span>Documents</span>
                    </a>
                </li>
                <li class="dropdown">
                    <a href="{{ route('committe')}}" class="nav-link">
                        <i class="fas fa-envelope"></i><span>Executive Committee</span>
                    </a>
                </li>
                <li class="dropdown">
                    <a href="{{ route('admin.gallery.list')}}" class="nav-link">
                        <i class="fas fa-envelope"></i><span>Gallery</span>
                    </a>
                </li>
                @endcan
                @can('is-competition-manager')
                <li class="dropdown">
                    <a href="#" class="menu-toggle nav-link has-dropdown"><i data-feather="briefcase"></i><span>Competitions</span></a>
                    <ul class="dropdown-menu">
                        <li class="dropdown"><a class="menu-toggle nav-link has-dropdown" href="#">Men</a>
                            <ul class="dropdown-menu">
                                <li><a class="nav-link" href="widget-chart.html">First Division</a></li>
                                <li><a class="nav-link" href="widget-data.html">Second Division</a></li>
                                <li><a class="nav-link" href="widget-data.html">Third Division</a></li>
                            </ul>
                        </li>

                        <li class="dropdown"><a class="menu-toggle nav-link has-dropdown" href="#">Women</a>
                            <ul class="dropdown-menu">

                            </ul>
                        </li>

                        <li class="dropdown"><a class="menu-toggle nav-link has-dropdown" href="#">Peace cup</a>
                            <ul class="dropdown-menu">

                            </ul>
                        </li>
                    </ul>
                    <a href="{{ route('season')}}" class="nav-link">
                        <i class="fas fa-envelope"></i><span>Seasons</span>
                    </a>
                </li>
                <li class="dropdown">
                    <a href="{{ route('day.season')}}" class="nav-link">
                        <i class="fas fa-envelope"></i><span>Days</span>
                    </a>
                </li>
                <li class="dropdown">
                    <a href="{{ route('fixtures')}}" class="nav-link">
                        <i class="fas fa-envelope"></i><span>Fixtures</span>
                    </a>
                </li>
                @endcan
                @endcan
            </ul>
        </aside>
    </div>
    <script type="module" src="/src/main.js"></script>
    <script src="./assets/js/app.min.js"></script>
    <script src="./assets/js/custom.js"></script>
    <script src="./assets/js/scripts.js"></script>
    <script src="./assets/js/scripts.js"></script>
    <script src="./assets/js/custom.js"></script>
</body>