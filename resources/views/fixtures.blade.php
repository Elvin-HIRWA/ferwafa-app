@include('mainMenuBar', ['name' => 'News'])

<div
      class="container-fluid eventlist blog blogpost upcoming-event latest-blog no-padding"
    >
      <div class="section-padding"></div>
      <div class="container-fluid eventlist blog blogpost upcoming-event latest-blog no-padding">
        <div class="container">
            <div class="row " style="display: flex; justify-content: center">
                            <div class="row m-0">
                                <div class="col-10 col-md-10 col-lg-10 p-0">
                                    @include('competition-menus')
                                    <div class="row">
                                        @if (!is_null($day))
                                            <table class="table table-bordered" height="40%">
                                                <thead>
                                                    <tr style="background-color: #133E8D;">
                                                        <th colspan="3" style="text-align: center; color: white"
                                                            scope="col">{{ $day->name }}</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @foreach ($games as $game)
                                                        <tr style="height: 10px">
                                                            <td
                                                                style="width: 30%; text-align: center; vertical-align: middle;">
                                                                {{ $game->homeTeam }}
                                                            </td>
                                                            <td
                                                                style="width: 20%; text-align: center; vertical-align: middle;">
                                                                @if ($game->isPlayed)
                                                                    {{ $game->homeTeamGoals }} -
                                                                    {{ $game->awayTeamGoals }}
                                                                @else
                                                                    <small>{{ date('d/m/Y', strtotime($game->date)) }}
                                                                        {{ date('H:i', strtotime($game->date)) }}</small>
                                                                    <br>
                                                                    VS <br>
                                                                    <small>{{ $game->stadium }}</small>
                                                                @endif
                                                            </td>
                                                            <td
                                                                style="width: 30%; text-align: center; vertical-align: middle;">
                                                                {{ $game->awayTeam }}
                                                            </td>
                                                        </tr>
                                                    @endforeach
                                                </tbody>
                                            </table>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
      <div class="section-padding"></div>
    </div>

@include('footer')
