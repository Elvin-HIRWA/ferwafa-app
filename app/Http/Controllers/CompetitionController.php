<?php

namespace App\Http\Controllers;

use App\Models\Day;
use Illuminate\Support\Facades\DB;

class CompetitionController extends Controller
{
    public function listDays()
    {
        $days = Day::all();

        return view('competition-menus', [
            'days' => $days
        ]);
    }

    public function show($id)
    {
        $days = Day::all();
        $day = Day::find($id);

        $games = DB::table('Game')
            ->select(
                'homeTeam.name AS homeTeam',
                'awayTeam.name AS awayTeam',
                'Stadium.name AS stadium',
                'Game.date',
                'Game.homeTeamGoals',
                'Game.awayTeamGoals',
            )
            ->join('Team as homeTeam', 'Game.homeTeamID', '=', 'homeTeam.id')
            ->join('Team as awayTeam', 'Game.awayTeamID', '=', 'awayTeam.id')
            ->join('Season', 'Game.seasonID', '=', 'Season.id')
            ->join('Day', 'Game.dayID', '=', 'Day.id')
            ->join('Stadium', 'Game.stadeID', '=', 'Stadium.id')
            ->where('dayID', $id)
            ->get();

        return view('days.fixtures', [
            'day' => $day,
            'days' => $days,
            'games' => $games
        ]);
    }
    public function menFirstDivisionTable()
    {
        $days = Day::all();

        return view('menFirstDivisionTable', [
            'days' => $days
        ]);
    }

    public function calculateTeamScores()
    {
    }
}
