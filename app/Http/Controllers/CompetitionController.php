<?php

namespace App\Http\Controllers;

use App\Models\Day;
use App\Models\Team;
use App\Models\TeamCategory;
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

    public function show($categoryID, $id)
    {
        $teamCategory = TeamCategory::where('id', $categoryID)->first();
        
        if (is_null($teamCategory)) {
            return redirect('/')
                ->with('error', 'Team category not found');
        }

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
                'Game.isPlayed',
            )
            ->join('Team as homeTeam', 'Game.homeTeamID', '=', 'homeTeam.id')
            ->join('Team as awayTeam', 'Game.awayTeamID', '=', 'awayTeam.id')
            ->join('Day', 'Game.dayID', '=', 'Day.id')
            ->where('dayID', $id)
            ->where('homeTeam.categoryID', $categoryID)
            ->where('awayTeam.categoryID', $categoryID)
            ->get();

        return view('fixtures', [
            'day' => $day,
            'days' => $days,
            'games' => $games,
            "categoryID" => (int)$categoryID
        ]);
    }
    public function menFirstDivisionTable($categoryID)
    {
        $teamCategory = TeamCategory::where('id', $categoryID)->first();
        
        if (is_null($teamCategory)) {
            return redirect('/')
                ->with('error', 'Team category not found');
        }

        $teams = Team::where('categoryID', $categoryID)->get()->toArray();

        $days = DB::table('Game')
                ->join('Day', 'Day.id','=','Game.dayID')
                ->where('Game.isPlayed', 1)->orderBy('Day.id', 'DESC')->first(['Game.dayID']);        

        $teamStatistics = DB::select("SELECT a.name AS name, 
                                            SUM(b.goalWin) AS goalWin, 
                                            SUM(b.goalLoss) AS goalLoss, 
                                            SUM(b.goalWin) - SUM(b.goalLoss) AS goalDifference, 
                                            SUM(b.score) AS score,
                                            SUM(
                                                    CASE 
                                                        WHEN c.isPlayed = true 
                                                    THEN 1 
                                                        ELSE 0 
                                                    END
                                            ) AS matchPlayed
                                        FROM Team AS a
                                        INNER JOIN TeamStatistic AS b
                                        ON b.teamID = a.id
                                        INNER JOIN Game AS c
                                        ON c.id = b. gameID
                                        WHERE a.categoryID = ?
                                        GROUP BY a.id
                                        ORDER BY SUM(b.score) DESC, (SUM(b.goalWin) - SUM(b.goalLoss)) DESC, SUM(b.goalWin) DESC, a.name ASC
                                        ",[$categoryID]);
        

        $topScores = TopScore::orderBy('goals', 'DESC')->orderBy('name', 'ASC')->take(10)->get();

        $finalTopScores = [];

        foreach ($topScores as $value) {
            foreach($teams as $team){
                if($team["name"] === $value->teamName){
                    $topScore = [
                        "id" => $value->id,
                        "name" => $value->name,
                        "goals" => $value->goals,
                        "teamName" => $value->teamName
                    ];
                    array_push($finalTopScores, $topScore);
                }
            }
        }

        return view('menFirstDivisionTable', [
            'days' => $days,
            'teamStatistics' => $teamStatistics,
            "topScores" => $finalTopScores,
            "categoryID" => (int)$categoryID,
            "categoryName" => $teamCategory->name
        ]);
    }

    public function standing()
    {
        $teams = TeamStatistic::all();

        return view('', [
            'teams' => $teams
        ]);
    }
}
