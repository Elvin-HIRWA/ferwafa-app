<?php

namespace App\Http\Controllers;

use App\Models\Day;
use App\Models\Season;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;

class DayController extends Controller
{
    public function addDay()
    {
        if (!Gate::allows('is-admin') && !Gate::allows('is-competition-manager')) {
            Auth::logout();
            return redirect('/');
        }

        $seasons = Season::all()->toArray();

        if(empty($seasons)){
        return redirect('/days')
            ->with('error', 'Create Season first');
        }
        $finalSeasons = [];

        foreach ($seasons as $value) {

            $season = [
                "id" => $value['id'],
                "from" => Carbon::parse($value['from'])->format('d-m-Y'),
                "to" => Carbon::parse($value['to'])->format('d-m-Y')
            ];
            array_push($finalSeasons, $season);
        }

        return view('admin.create-day', [
            'seasons' => $finalSeasons
        ]);
    }


    public function createDay(Request $request)
    {
        if (!Gate::allows('is-admin') && !Gate::allows('is-competition-manager')) {
            Auth::logout();
            return redirect('/');
        }

        $request->validate([
            "name" => "required|string",
            "abbreviation" => "required|string",
            "seasonID" => "required|integer"

        ]);

        Day::create([
            "name" => $request->name,
            "abbreviation" => $request->abbreviation,
            "seasonID" => $request->seasonID
        ]);

        return redirect('/days')
            ->with('message', 'Day is added successfully');
    }

    public function listDays()
    {
        if (!Gate::allows('is-admin') && !Gate::allows('is-competition-manager')) {
            Auth::logout();
            return redirect('/');
        }

        $days = Day::all();

        return view('admin.days', [
            'days' => $days
        ]);
    }

    public function deleteDay($id)
    {
        if (!Gate::allows('is-admin') && !Gate::allows('is-competition-manager')) {
            Auth::logout();
            return redirect('/');
        }

        $day = Day::find($id);

        if (!$day) {
            return redirect()->back()->with('failed', 'day not found');
        }

        $day->delete();

        return redirect('/days')
            ->with('message', 'deleted successfully');
    }
}
