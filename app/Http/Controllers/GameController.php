<?php

namespace App\Http\Controllers;

use App\Models\Day;
use App\Models\Game;
use App\Models\Season;
use App\Models\Team;
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
            'days' => $days
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
            "homeTeamGoals" => "required|integer",
            "awayTeamGoals" => "required|integer"
        ]);

        Game::create([
            "homeTeamID" => $request->homeTeamID,
            "awayTeamID" => $request->awayTeamID,
            "stade" => $request->stade,
            "date" => $request->date,
            "homeTeamGoals" => $request->homeTeamGoals,
            "awayTeamGoals" => $request->awayTeamGoals,
        ]);
    }
}
