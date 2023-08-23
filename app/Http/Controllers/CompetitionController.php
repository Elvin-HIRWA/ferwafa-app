<?php

namespace App\Http\Controllers;

use App\Models\Day;
use App\Models\Game;
use App\Models\Team;
use App\Models\TeamStatistic;
use App\Models\TopScore;
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
                'Game.stadeName AS stadium',
                'Game.date',
                'Game.homeTeamGoals',
                'Game.awayTeamGoals',
            )
            ->join('Team as homeTeam', 'Game.homeTeamID', '=', 'homeTeam.id')
            ->join('Team as awayTeam', 'Game.awayTeamID', '=', 'awayTeam.id')
            ->join('Day', 'Game.dayID', '=', 'Day.id')
            ->where('dayID', $id)
            ->get();

        return view('fixtures', [
            'day' => $day,
            'days' => $days,
            'games' => $games
        ]);
    }
    public function menFirstDivisionTable()
    {
        $days = Day::all();
        $teamStatistics = DB::table('TeamStatistic as a')
            ->select('b.name', 'a.goalWin', 'a.goalLoss', 'a.score', 'a.matchPlayed', 'a.goalDifference')
            ->join('Team as b', 'a.teamID', '=', 'b.id')
            ->orderBy('a.score', 'DESC')
            ->orderBy('a.goalDifference', 'DESC')
            ->get();

        $topScores = TopScore::orderBy('goals', 'DESC')->get();

        $finalTopScores = [];

        foreach ($topScores as $value) {
            $topScore = [
                "id" => $value->id,
                "name" => $value->name,
                "goals" => $value->goals,
                "teamName" => $value->teamName
            ];
            array_push($finalTopScores, $topScore);
        }


        return view('menFirstDivisionTable', [
            'days' => $days,
            'teamStatistics' => $teamStatistics,
            "topScores" => $finalTopScores
        ]);
    }

    // public function calculateTeamScores($team1ID, $team2ID, $team1Goal, $team2Goal)
    // {

    //     $team1Statistics = TeamStatistic::where('teamID', $team1ID)->first();
    //     $team2Statistics = TeamStatistic::where('teamID', $team2ID)->first();
    //     if ($team1Goal == $team2Goal) {
    //         $team1Statistics->score = $team1Statistics->score + 1;
    //         $team2Statistics->score = $team2Statistics->score + 1;
    //         $team1Statistics->save();
    //     }
    //     if ($team1Goal > $team2Goal) {
    //         $team1Statistics->score = $team1Statistics->score + 3;
    //         $team1Statistics->goalWin = $team1Statistics->goalWin + $team1Goal;
    //         $team1Statistics->goalLoss = $team1Statistics->goalLoss + $team2Goal;

    //         $team2Statistics->score = $team2Statistics->score + 0;
    //         $team2Statistics->goalWin = $team2Statistics->goalWin + $team2Goal;
    //         $team2Statistics->goalLoss = $team2Statistics->goalLoss + $team1Goal;

    //         $team1Statistics->save();
    //     }

    //     if ($team1Goal < $team2Goal) {
    //         $team1Statistics->score = $team1Statistics->score + 0;
    //         $team1Statistics->goalWin = $team1Statistics->goalWin + $team1Goal;
    //         $team1Statistics->goalLoss = $team1Statistics->goalLoss + $team2Goal;

    //         $team2Statistics->score = $team2Statistics->score + 3;
    //         $team2Statistics->goalWin = $team2Statistics->goalWin + $team2Goal;
    //         $team2Statistics->goalLoss = $team2Statistics->goalLoss + $team1Goal;

    //         $team1Statistics->save();
    //     }
    // }

    public function standing()
    {
        $teams = TeamStatistic::all();

        return view('', [
            'teams' => $teams
        ]);
    }
}
