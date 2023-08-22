<?php

namespace App\Http\Controllers;

use App\Models\TopScore;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class TopScoreController extends Controller
{
    public function addTopScore()
    {
        if (!Gate::allows('is-admin') && !Gate::allows('is-dcm')) {
            Auth::logout();
            return redirect('/');
        }

        return view('admin.create-topScore');
    }

    public function createTopScore(Request $request)
    {
        if (!Gate::allows('is-admin') && !Gate::allows('is-dcm')) {
            Auth::logout();
            return redirect('/');
        }
        $validation = Validator::make($request->all(), [
            "name" => "required|string",
            "goals" => "required|integer",
            "teamName" => "required|string"

        ]);

        if ($validation->fails()) {
            return response()->json(["errors" => $validation->errors()->all()], Response::HTTP_UNPROCESSABLE_ENTITY);
        }

        TopScore::create([
            "name" => $request->name,
            "goals" => $request->goals,
            "teamName" => $request->teamName
        ]);

        return redirect('/top-score')
            ->with('message', 'Member is added successfully');
    }

    public function getTopScoreImageDoc($fileName)
    {
        if (Storage::exists('topScore/' . $fileName)) { {
                return response()->file(storage_path('/app/topScore/' . $fileName));
            }
        }
    }

    public function listTopScore()
    {
        if (!Gate::allows('is-admin') && !Gate::allows('is-dcm')) {
            Auth::logout();
            return redirect('/');
        }

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

        return view('admin.topScore', [
            'topScores' => $finalTopScores
        ]);
    }

    public function editTopScore($id)
    {
        if (!Gate::allows('is-admin') && !Gate::allows('is-dcm')) {
            Auth::logout();
            return redirect('/');
        }
        $topScore = TopScore::find($id);

        if (!$topScore) {
            return redirect()->back()->with('failed', 'TopScore not found');
        }

        return view('admin.update-topScore', [
            'topScore' => $topScore
        ]);
    }


    public function updateTopScore(Request $request, $id)
    {
        if (!Gate::allows('is-admin') && !Gate::allows('is-dcm')) {
            Auth::logout();
            return redirect('/');
        }

        $request->validate([
            "name" => "required|string",
            "goals" => "required|integer",
            "teamName" => "required|string"

        ]);

        $topScore = TopScore::find($id);

        if (!$topScore) {
            return redirect()->back()->with('fail', 'TopScore not found');
        }

        $topScore->name = $request->name;
        $topScore->goals = $request->goals;
        $topScore->teamName = $request->teamName;
        $topScore->save();

        return redirect('/top-score')
            ->with('message', 'updated successfully');
    }


    public function deleteTopScore($id)
    {
        if (!Gate::allows('is-admin') && !Gate::allows('is-dcm')) {
            Auth::logout();
            return redirect('/');
        }

        $topScore = TopScore::find($id);

        if (!$topScore) {
            return response()->json(["errors" => "TopScore not found"], Response::HTTP_INTERNAL_SERVER_ERROR);
        }

        $topScore->delete();

        return redirect('/top-score')
            ->with('message', 'deleted successfully');
    }
}