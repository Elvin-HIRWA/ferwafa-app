<?php

namespace App\Http\Controllers;

use App\Models\Season;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Validator;

class SeasonController extends Controller
{
    public function __construct()
    {
        // $this->middleware('auth', ['except' => ['']]);
    }


    public function addSeason()
    {
        if (!Gate::allows('is-admin') && !Gate::allows('is-dcm')) {
            Auth::logout();
            return redirect('/');
        }

        return view('admin.create-season');
    }

    public function createSeason(Request $request)
    {
        if (!Gate::allows('is-admin') && !Gate::allows('is-dcm')) {
            Auth::logout();
            return redirect('/');
        }
        $validation = Validator::make($request->all(), [
            "from" => "required|date",
            "to" => "required|date"

        ]);

        if ($validation->fails()) {
            return response()->json(["errors" => $validation->errors()->all()], Response::HTTP_UNPROCESSABLE_ENTITY);
        }

        Season::create([
            "from" => strtotime($request->from),
            "to" => strtotime($request->to)
        ]);

        return redirect('/parteners')
            ->with('message', 'Member is added successfully');
    }

    public function listSeason()
    {
        if (!Gate::allows('is-admin') && !Gate::allows('is-dcm')) {
            Auth::logout();
            return redirect('/');
        }

        $seasons = Season::all();

        $finalSeasons = [];

        foreach ($seasons as $value) {

            $season = [
                "id" => $value->id,
                "name" => $value->from. ' - '.$value->to
            ];
            array_push($finalSeasons, $season);
        }

        return view('admin.seasons', [
            'seasons' => $finalSeasons
        ]);
    }

    public function editSeason($id)
    {
        if (!Gate::allows('is-admin') && !Gate::allows('is-dcm')) {
            Auth::logout();
            return redirect('/');
        }
        $season = Season::find($id);

        if (!$season) {
            return redirect()->back()->with('failed', 'Season not found');
        }

        return view('admin.update-season', [
            'season' => $season
        ]);
    }


    public function updateSeason(Request $request, $id)
    {
        if (!Gate::allows('is-admin') && !Gate::allows('is-dcm')) {
            Auth::logout();
            return redirect('/');
        }

        $request->validate([
            "from" => "required|date",
            "to" => "required|date"

        ]);

        $season = Season::find($id);

        if (!$season) {
            return redirect()->back()->with('fail', 'Season not found');
        }

        $season->from = $request->from;
        $season->to = $request->to;
        $season->save();

        return redirect('/seasons')
            ->with('message', 'updated successfully');
    }


    public function deleteSeason($id)
    {
        if (!Gate::allows('is-admin') && !Gate::allows('is-dcm')) {
            Auth::logout();
            return redirect('/');
        }

        $season = Season::find($id);

        if (!$season) {
            return response()->json(["errors" => "Season not found"], Response::HTTP_INTERNAL_SERVER_ERROR);
        }

        $season->delete();

        return redirect('/seasons')
            ->with('message', 'deleted successfully');
    }
}
