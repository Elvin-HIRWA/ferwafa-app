<!DOCTYPE html>

<head>
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
    @include('admin.sidebar')
    <div class="main-content">
        <section class="section">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h4>Available Fixtures</h4>
                            <div class="card-header-form">
                                <form>
                                    <div class="input-group">
                                        <a href="{{ route('add.game') }}" class="btn btn-primary">
                                            <i class="far fa-user"> &nbsp;</i>Add Match
                                        </a>
                                        &nbsp;&nbsp;&nbsp;&nbsp;
                                        <input type="text" class="form-control" placeholder="Search" />
                                        <div class="input-group-btn">
                                            <button class="btn btn-primary"><i class="fas fa-search"></i></button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                        @if (session()->has('error'))
                        <div class="badge badge-danger">
                            {{ session()->get('error') }}
                        </div>
                        @endif
                        <div class="card-body p-0">
                            <div class="table-responsive">
                                <table class="table table-striped">
                                    <tr>
                                        <th>#</th>
                                        <th>Home Team</th>
                                        <th>Away Team</th>
                                        <th>Stade</th>
                                        <th>Date</th>
                                        <th>Home Team Goals</th>
                                        <th>Away Team Goals</th>
                                        <th colspan="2">Action</th>
                                    </tr>
                                    @foreach($games as $key => $game)
                                    <tr>
                                        <td class="text-truncate">{{$key + 1}}</td>
                                        <td> {{$game->homeTeam }}</td>
                                        <td>{{$game->awayTeam }} </td>
                                        <td> {{$game->stadium }}</td>
                                        <td> {{$game->date }}</td>
                                        <td> {{$game->homeTeamGoals }}</td>
                                        <td> {{$game->awayTeamGoals }}</td>
                                        <td>
                                            <a href="{{ route('game.page.edit', $game->id) }}" class="btn btn-outline-primary">Add Scores</a>

                                        </td>
                                        <td>
                                            <button type="button" class="btn btn-outline-danger delete-game" data-toggle="modal" data-target="#confirmDeleteModal" data-game-id="{{ $game->id }}">Delete</button>
                                        </td>
                                    </tr>

                                    @endforeach
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>

    <div class="modal fade" id="confirmDeleteModal" tabindex="-1" role="dialog" aria-labelledby="confirmDeleteModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="confirmDeleteModalLabel">Confirm Delete</h5>
                </div>
                <div class="modal-body">
                    Are you sure you want to delete this Game?
                </div>
                <div class="modal-footer">
                    <form id="deleteGameForm" method="POST" action="{{ route('delete.game', 0) }}">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger">Delete</button>
                    </form>
                </div>
            </div>
        </div>
    </div>



    <script type="module" src="/src/main.js"></script>
    <script src="./assets/js/app.min.js"></script>
    <script src="./assets/js/custom.js"></script>
    <script src="./assets/js/scripts.js"></script>
    <script src="./assets/js/scripts.js"></script>
    <script src="./assets/js/custom.js"></script>
    <script>
        $(document).ready(function() {
            $('.delete-game').click(function() {
                var gameId = $(this).data('game-id');
                var form = $('#deleteGameForm');
                var action = form.attr('action');
                // Update the form action with the correct game ID
                form.attr('action', action.replace('0', gameId));
            });
        });
    </script>


</body>