<?php

namespace App\Http\Controllers;

use App\Models\Game;
use App\Models\Team;
use App\Models\TeamCategory;
use App\Models\TeamStatistic;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Storage;

class TeamController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth', ['except' => ['getTeamImageDoc']]);
    }


    public function addTeam()
    {
        if (!Gate::allows('is-admin') && !Gate::allows('is-competition-manager')) {
            Auth::logout();
            return redirect('/');
        }

        $teamCategory = TeamCategory::all()->toArray();

        if (empty($teamCategory)) {
            return redirect('/team')
                ->with('error', 'Create Team Category first');
        }

        return view('admin.create-team', [
            "categories" => $teamCategory
        ]);
    }

    public function createTeam(Request $request)
    {
        if (!Gate::allows('is-admin') && !Gate::allows('is-competition-manager')) {
            Auth::logout();
            return redirect('/');
        }
        $request->validate([
            "name" => "required|string",
            "logo" => "required|file|max:5000|mimes:png,jpg,jpeg,svg",
            "categoryID" => "required|integer"

        ]);

        $path = $request->logo->store('team');

        Team::create([
            "name" => $request->name,
            "categoryID" => $request->categoryID,
            "logo" => $path
        ]);

        return redirect('/team')
            ->with('message', 'Member is added successfully');
    }

    public function getTeamImageDoc($fileName)
    {
        if (Storage::exists('team/' . $fileName)) { {
                return response()->file(storage_path('/app/team/' . $fileName));
            }
        }
    }

    public function listTeam()
    {
        if (!Gate::allows('is-admin') && !Gate::allows('is-competition-manager')) {
            Auth::logout();
            return redirect('/');
        }

        $teams = DB::table("Team AS a")
            ->join("TeamCategory AS b", "a.categoryID", "=", "b.id")
            ->select(["a.id", "a.name", "a.logo", "b.name AS category"])
            ->orderBy('name', 'asc')
            ->get();

        $finalTeams = [];

        foreach ($teams as $value) {
            $fileUrl = explode('/', $value->logo)[1];
            $team = [
                "id" => $value->id,
                "name" => $value->name,
                "category" => $value->category,
                "url" => $fileUrl
            ];
            array_push($finalTeams, $team);
        }

        return view('admin.teams', [
            'teams' => $finalTeams
        ]);
    }

    public function editTeam($id)
    {
        if (!Gate::allows('is-admin') && !Gate::allows('is-competition-manager')) {
            Auth::logout();
            return redirect('/');
        }
        $team = Team::find($id);
        $teamCategory = TeamCategory::all()->toArray();

        if (!$team) {
            return redirect()->back()->with('errors', 'Team not found');
        }

        return view('admin.update-team', [
            'team' => $team,
            'categories' => $teamCategory
        ]);
    }


    public function updateTeam(Request $request, $id)
    {
        if (!Gate::allows('is-admin') && !Gate::allows('is-competition-manager')) {
            Auth::logout();
            return redirect('/');
        }

        $request->validate([
            "name" => "required|string",
            "logo" => "required|file|max:5000|mimes:png,jpg,jpeg,svg",
            "categoryID" => "required|integer"

        ]);

        $team = Team::find($id);

        if (!$team) {
            return redirect()->back()->with('errors', 'Team not found');
        }

        Storage::delete($team->logo);
        $path = $request->logo->store('team');

        $team->name = $request->name;
        $team->logo = $path;
        $team->categoryID = $request->categoryID;
        $team->save();

        return redirect('/team')
            ->with('message', 'updated successfully');
    }


    public function deleteTeam($id)
    {
        if (!Gate::allows('is-admin') && !Gate::allows('is-competition-manager')) {
            Auth::logout();
            return redirect('/');
        }

        $team = Team::find($id);

        if (!$team) {
            return redirect('/team')->with('error', 'Team not found');
        }

        $teamStatistics = TeamStatistic::where('teamID', $id)->first();

        if (!is_null($teamStatistics)) {
            return redirect('/team')
                ->with('error', 'Team cant be deleted, has used in matches');
        }

        Storage::delete($team->logo);
        $team->delete();

        return redirect('/team')
            ->with('message', 'deleted successfully');
    }
}
