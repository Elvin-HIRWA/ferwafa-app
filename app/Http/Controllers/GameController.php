<?php

namespace App\Http\Controllers;

use App\Models\Day;
use App\Models\Game;
use App\Models\Season;
use App\Models\Team;
use App\Models\TeamStatistic;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Validator;

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
                'Game.isPlayed',
            )
            ->join('Team as homeTeam', 'Game.homeTeamID', '=', 'homeTeam.id')
            ->join('Team as awayTeam', 'Game.awayTeamID', '=', 'awayTeam.id')
            ->join('Day', 'Game.dayID', '=', 'Day.id')
            ->orderBy('Day.id', 'DESC')
            ->orderBy('Game.id', 'DESC')
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

        $seasonID = Season::orderBy('created_at', 'DESC')->first();
        
        if(is_null($seasonID)){
            return redirect('/games')->with('error', 'create season first');
        }
        $teams = Team::all()->toArray();

        if(empty($teams)){
            return redirect('/games')->with('error', 'create teams first');
        }

        $days = Day::where('seasonID', $seasonID->id)->get();

        if(is_null($days)){
            return redirect('/games')->with('error', 'create day first');
        }

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
            "dayID" => "required|integer",
        ]);

        if ($request->homeTeamID == $request->awayTeamID) {
            return redirect()->back()->with('choose different Teams');
        }

        if (now() > $request->date) {
            return redirect()->back()->with('date is invalid you need to select future dates');
        }
        
        try {
            DB::transaction(function () use ($request) {
                $game = Game::create([
                    "homeTeamID" => $request->homeTeamID,
                    "awayTeamID" => $request->awayTeamID,
                    "stadeName" => $request->stade,
                    "homeTeamGoals" => 0,
                    "awayTeamGoals" => 0,
                    "date" => $request->date,
                    "dayID" => $request->dayID
                ]);

                TeamStatistic::create([
                    'gameID' => $game->id,
                    'teamID' => $request->homeTeamID,
                    'goalWin' => 0,
                    'goalLoss' => 0,
                    'score' => 0
                ]);
                
                TeamStatistic::create([
                    'gameID' => $game->id,
                    'teamID' => $request->awayTeamID,
                    'goalWin' => 0,
                    'goalLoss' => 0,
                    'score' => 0
                ]);
                
            });

            return redirect('/games')
            ->with('message', 'Game added successfully');
        } catch (\Throwable $th) {
            return redirect()->back()->with('something wrong');
        }

        
    }

    public function addMatchResult($id)
    {
        if (!Gate::allows('is-admin') && !Gate::allows('is-competition-manager')) {
            Auth::logout();
            return redirect('/');
        }

        $game = Game::find($id);

        if (!$game) {
            return redirect()->back()->with('error', 'Game not found');
        }

        if ( now() <  $game->date) {
            return redirect()->back()->with('error', 'not allowed to add result before match day');
        }

        $team = DB::table('Game as a')
            ->select('b.id as homeTeamID', 'b.name as homeTeam', 'c.id as awayTeamID', 'c.name as awayTeam')
            ->join('Team as b', 'a.homeTeamID', '=', 'b.id')
            ->join('Team as c', 'a.awayTeamID', '=', 'c.id')
            ->where('a.id', $id)
            ->first();

        return view('admin.add-result', [
            'team' => $team,
            'gameID' => $id,
        ]);
    }

    public function createMatchResult(Request $request, $gameID)
    {
        $validation = Validator::make($request->all(), [
            "homeTeamID" => "required|integer",
            "homeTeamGoals" => "required|integer",
            "awayTeamID" => "required|integer",
            "awayTeamGoals" => "required|integer"
        ]);

        if ($validation->fails()) {
            return response()->json(['errors' => $validation->errors()->all(), "timestamp" => now()->format("Y-m-d, H:i:s")], Response::HTTP_UNPROCESSABLE_ENTITY);
        }

        $game = Game::find($gameID);

        if (!$game) {
            return redirect()->back()->with('error', 'Game not found');
        }

        $homeTeam = TeamStatistic::where([['gameID', $game->id], ['teamID', $request->homeTeamID]])->first();

        if(is_null($homeTeam)){
            return redirect()->back()->with('error', 'Home Team not found');
        }
        $awayTeam = TeamStatistic::where([['gameID', $game->id], ['teamID', $request->awayTeamID]])->first();

        if(is_null($awayTeam)){
            return redirect()->back()->with('error', 'Away Team not found');
        }

        try {
            DB::transaction(function () use ($request,$game, &$homeTeam, &$awayTeam) {
                $game->homeTeamGoals = $request->homeTeamGoals;
                $game->awayTeamGoals = $request->awayTeamGoals;
                $game->isPlayed = true;

                $homeTeam->goalWin = $request->homeTeamGoals;
                $homeTeam->goalLoss = $request->awayTeamGoals;

                $awayTeam->goalWin = $request->awayTeamGoals;
                $awayTeam->goalLoss = $request->homeTeamGoals;

                if($request->homeTeamGoals > $request->awayTeamGoals){
                    $homeTeam->score = 3;
                    $awayTeam->score = 0;
                }

                if($request->homeTeamGoals < $request->awayTeamGoals){
                    $homeTeam->score = 0;
                    $awayTeam->score = 3;
                }

                if($request->homeTeamGoals === $request->awayTeamGoals){
                    $homeTeam->score = 0;
                    $awayTeam->score = 0;
                }

                $homeTeam->save();
                $awayTeam->save();
                $game->save();
            });
            return redirect('/games')->with('message', 'Result Added successfully');
        } catch (\Exception $exception) {
            dd($exception);
            return \response()->json(
                ['message' => 'System error, contact support', 'errors' => $exception->getMessage()],
                Response::HTTP_INTERNAL_SERVER_ERROR
            );
        }
    }

    public function updateFixture($id)
    {
        if (!Gate::allows('is-admin') && !Gate::allows('is-competition-manager')) {
            Auth::logout();
            return redirect('/');
        }

        $game = Game::find($id);

        if (!$game) {
            return redirect()->back()->with('fail', 'Game not found');
        }

        if ( now() >  $game->date) {
            return redirect()->back()->with('fail', 'not allowed to changed finiched games');
        }

        $team = DB::table('Game as a')
            ->select('b.id as homeTeamID', 'b.name as homeTeam', 'c.id as awayTeamID', 'c.name as awayTeam')
            ->join('Team as b', 'a.homeTeamID', '=', 'b.id')
            ->join('Team as c', 'a.awayTeamID', '=', 'c.id')
            ->where('a.id', $id)
            ->first();

        $seasonID = Season::orderBy('created_at', 'DESC')->first()->id;

        $teams = Team::all();

        $days = Day::where('seasonID', $seasonID)->get();

        return view('admin.update-fixture', [
            'team' => $team,
            'game' => $game,
            'teams' => $teams,
            'days' => $days,
        ]);
    }

    public function updateGame(Request $request, $id)
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
            "dayID" => "required|integer",

        ]);

        $game = Game::find($id);

        if (!$game) {
            return redirect()->back()->with('fail', 'Game not found');
        }

        $game->homeTeamID = $request->homeTeamID;
        $game->awayTeamID = $request->awayTeamID;
        $game->stade = $request->stade;
        $game->date = $request->date;
        $game->dayID = $request->dayID;
        $game->save();

        return redirect('/games')
            ->with('message', 'updated successfully');
    }

    public function deleteGame($id)
    {
        if (!Gate::allows('is-admin') && !Gate::allows('is-competition-manager')) {
            Auth::logout();
            return redirect('/');
        }

        $game = Game::find($id);

        if (!$game) {
            return redirect()->back()->with('failed', 'Game not found');
        }

        try {
            DB::transaction(function () use ($game) {
                TeamStatistic::where('gameID', $game->id)->delete();
                Game::where('id', $game->id)->delete();
            });
            return redirect('/games')
            ->with('message', 'deleted successfully');
        } catch (\Exception $exception) {
                return \response()->json(
                    ['message' => 'System error, contact support', 'errors' => $exception->getMessage()],
                    Response::HTTP_INTERNAL_SERVER_ERROR
                );
        }
    }
}
