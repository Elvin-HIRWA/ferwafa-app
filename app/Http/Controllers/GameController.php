<?php

namespace App\Http\Controllers;

use App\Models\Day;
use App\Models\Game;
use App\Models\Season;
use App\Models\Team;
use App\Models\TeamStatistic;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Gate;

class GameController extends Controller
{
    public function listGames()
    {
        if (!Gate::allows('is-admin') && !Gate::allows('is-competition-manager')) {
            Auth::logout();
            return redirect('/');
        }

        $games = DB::table('Game')
            ->select(
                'Game.id',
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
            // ->where('dayID', $id)
            ->get();

        return view('admin.games', [
            'games' => $games
        ]);
    }

    public function addGame()
    {
        if (!Gate::allows('is-admin') && !Gate::allows('is-competition-manager')) {
            Auth::logout();
            return redirect('/');
        }

        $seasonID = Season::orderBy('created_at', 'DESC')->first()->id;

        $teams = Team::all();

        $days = Day::where('seasonID', $seasonID)->get();

        return view('admin.create-game', [
            'teams' => $teams,
            'days' => $days,
            'seasonID' => $seasonID
        ]);
    }

    public function createGame(Request $request)
    {
        if (!Gate::allows('is-admin') && !Gate::allows('is-competition-manager')) {
            Auth::logout();
            return redirect('/');
        }

        $request->validate([
            "homeTeamID" => "required|integer",
            "awayTeamID" => "required|integer",
            "stade" => "required|string",
            "date" => "required|date",
            // "homeTeamGoals" => "nullable|integer",
            // "awayTeamGoals" => "nullable|integer",
            "dayID" => "required|integer",
        ]);

        if ($request->homeTeamID == $request->awayTeamID) {
            return redirect()->back()->with('choose different Teams');
        }

        Game::create([
            "homeTeamID" => $request->homeTeamID,
            "awayTeamID" => $request->awayTeamID,
            "stadeName" => $request->stade,
            "date" => $request->date,
            // "homeTeamGoals" => $request->homeTeamGoals,
            // "awayTeamGoals" => $request->awayTeamGoals,
            "startTime" => '2023-08-22 08:56:19',
            "dayID" => $request->dayID
        ]);

        return redirect('/games')
            ->with('message', 'Game added successfully');
    }

    public function addMatchResult($id)
    {
        if (!Gate::allows('is-admin') && !Gate::allows('is-competition-manager')) {
            Auth::logout();
            return redirect('/');
        }

        $game = Game::find($id);

        if (!$game) {
            return redirect()->back()->with('fail', 'Game not found');
        }

        $team = DB::table('Game as a')
            ->select('b.name as homeTeam', 'c.name as awayTeam')
            ->join('Team as b', 'a.homeTeamID', '=', 'b.id')
            ->join('Team as c', 'a.awayTeamID', '=', 'c.id')
            ->where('a.id', $id)
            ->first();

        return view('admin.add-result', [
            'team' => $team,
            'gameID' => $id
        ]);
    }

    public function calculateTeamScores($team1ID, $team2ID, $team1Goal, $team2Goal)
    {
        $team1Statistics = TeamStatistic::where('teamID', $team1ID)->first();
        $team2Statistics = TeamStatistic::where('teamID', $team2ID)->first();

        if ($team1Goal == $team2Goal) {
            $team1Statistics->score = $team1Statistics->score + 1;
            $team2Statistics->score = $team2Statistics->score + 1;
            $team1Statistics->matchPlayed = $team1Statistics->matchPlayed + 1;
            $team2Statistics->matchPlayed = $team2Statistics->matchPlayed + 1;

            $team1Statistics->save();
            $team2Statistics->save();
            $team1Statistics->goalDifference = $team1Statistics->gaolWin - $team1Statistics->gaolLoss;
            $team2Statistics->goalDifference = $team2Statistics->gaolWin - $team2Statistics->gaolLoss;

            $team1Statistics->save();
            $team2Statistics->save();
        }
        if ($team1Goal > $team2Goal) {
            $team1Statistics->score = $team1Statistics->score + 3;
            $team1Statistics->goalWin = $team1Statistics->goalWin + $team1Goal;
            $team1Statistics->goalLoss = $team1Statistics->goalLoss + $team2Goal;
            $team1Statistics->matchPlayed = $team1Statistics->matchPlayed + 1;


            $team2Statistics->score = $team2Statistics->score + 0;
            $team2Statistics->goalWin = $team2Statistics->goalWin + $team2Goal;
            $team2Statistics->goalLoss = $team2Statistics->goalLoss + $team1Goal;
            $team2Statistics->matchPlayed = $team2Statistics->matchPlayed + 1;

            $team1Statistics->save();
            $team2Statistics->save();

            $team1Statistics->goalDifference = $team1Statistics->gaolWin - $team1Statistics->gaolLoss;
            $team2Statistics->goalDifference = $team2Statistics->gaolWin - $team2Statistics->gaolLoss;
            $team1Statistics->save();
            $team2Statistics->save();
        }

        if ($team1Goal < $team2Goal) {
            $team1Statistics->score = $team1Statistics->score + 0;
            $team1Statistics->goalWin = $team1Statistics->goalWin + $team1Goal;
            $team1Statistics->goalLoss = $team1Statistics->goalLoss + $team2Goal;
            $team1Statistics->matchPlayed = $team1Statistics->matchPlayed + 1;

            $team2Statistics->score = $team2Statistics->score + 3;
            $team2Statistics->goalWin = $team2Statistics->goalWin + $team2Goal;
            $team2Statistics->goalLoss = $team2Statistics->goalLoss + $team1Goal;
            $team2Statistics->matchPlayed = $team2Statistics->matchPlayed + 1;

            $team1Statistics->save();
            $team2Statistics->save();

            $team1Statistics->goalDifference = $team1Statistics->gaolWin - $team1Statistics->gaolLoss;
            $team2Statistics->goalDifference = $team2Statistics->gaolWin - $team2Statistics->gaolLoss;
            $team1Statistics->save();
            $team2Statistics->save();
        }
    }

    public function createMatchResult(Request $request, $gameID)
    {
        $request->validate([
            "homeTeamGoals" => "required|integer",
            "awayTeamGoals" => "required|integer"
        ]);

        $game = Game::find($gameID);

        if (!$game) {
            return redirect()->back()->with('fail', 'Game not found');
        }

        $game->homeTeamGoals = $request->homeTeamGoals;
        $game->awayTeamGoals = $request->awayTeamGoals;
        $game->save();
        $this->calculateTeamScores($game->homeTeamID, $game->awayTeamID, $request->homeTeamGoals, $request->awayTeamGoals);

        return redirect('/games')->with('message', 'Result Added successfully');
    }
}
