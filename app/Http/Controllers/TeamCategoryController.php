<?php

namespace App\Http\Controllers;

use App\Models\TeamCategory;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Validator;

class TeamCategoryController extends Controller
{
    public function addTeamCategory()
    {
        if (!Gate::allows('is-admin') && !Gate::allows('is-dcm')) {
            Auth::logout();
            return redirect('/');
        }

        return view('admin.create-teamCategory');
    }

    public function createteamCategory(Request $request)
    {
        if (!Gate::allows('is-admin') && !Gate::allows('is-dcm')) {
            Auth::logout();
            return redirect('/');
        }
        $validation = Validator::make($request->all(), [
            "name" => "required|string",
        ]);

        if ($validation->fails()) {
            return response()->json(["errors" => $validation->errors()->all()], Response::HTTP_UNPROCESSABLE_ENTITY);
        }

        TeamCategory::create([
            "name" => $request->name
        ]);

        return redirect('/team-category')
            ->with('message', 'Member is added successfully');
    }

    public function listTeamCategory()
    {
        if (!Gate::allows('is-admin') && !Gate::allows('is-dcm')) {
            Auth::logout();
            return redirect('/');
        }

        $teamCategorys = TeamCategory::all();

        $finalTeamCategorys = [];

        foreach ($teamCategorys as $value) {
            $teamCategory = [
                "id" => $value->id,
                "name" => $value->name
            ];
            array_push($finalTeamCategorys, $teamCategory);
        }

        return view('admin.teamCategory', [
            'teamCategorys' => $finalTeamCategorys
        ]);
    }

    public function editTeamCategory($id)
    {
        if (!Gate::allows('is-admin') && !Gate::allows('is-dcm')) {
            Auth::logout();
            return redirect('/');
        }
        $teamCategory = TeamCategory::find($id);

        if (!$teamCategory) {
            return redirect()->back()->with('failed', 'TeamCategory not found');
        }

        return view('admin.update-TeamCategory', [
            'teamCategory' => $teamCategory
        ]);
    }


    public function updateTeamCategory(Request $request, $id)
    {
        if (!Gate::allows('is-admin') && !Gate::allows('is-dcm')) {
            Auth::logout();
            return redirect('/');
        }

        $request->validate([
            "name" => "required|string"

        ]);

        $teamCategory = TeamCategory::find($id);

        if (!$teamCategory) {
            return redirect()->back()->with('fail', 'TeamCategory not found');
        }

        $teamCategory->name = $request->name;
        $teamCategory->save();

        return redirect('/team-category')
            ->with('message', 'updated successfully');
    }


    public function deleteTeamCategory($id)
    {
        if (!Gate::allows('is-admin') && !Gate::allows('is-dcm')) {
            Auth::logout();
            return redirect('/');
        }

        $teamCategory = TeamCategory::find($id);

        if (!$teamCategory) {
            return response()->json(["errors" => "TeamCategory not found"], Response::HTTP_INTERNAL_SERVER_ERROR);
        }

        $teamCategory->delete();

        return redirect('/team-category')
            ->with('message', 'deleted successfully');
    }
}
