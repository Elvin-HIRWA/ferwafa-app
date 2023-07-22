<?php

namespace App\Http\Controllers;

use App\Models\Report;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class ReportController extends Controller
{
    public function create(Request $request)
    {
        $validation = Validator::make($request->all(), [
            "title" => "required|string|max:255",
            "reportFile" =>  'file|max:5000|mimes:pdf',
        ]);

        if ($validation->fails()) {
            return response()->json(["errors" => $validation->errors()->all()], Response::HTTP_UNPROCESSABLE_ENTITY);
        }

        $path = $request->reportFile->store('report');

        Report::create([
            'title' => $request->title,
            'url' => $path
        ]);

        return response()->json(['message' => 'success']);
    }


    public function get()
    {

        $reports = Report::all();

        $finalReport = [];

        foreach ($reports as $value) {
            $fileUrl = explode('/', $value->url)[1];
            $report = [
                "id" => $value->id,
                "title" => $value->title,
                "created_at" => $value->created_at,
                "updataed_at" => $value->updated_at,
                "url" => $fileUrl
            ];
            array_push($finalReport, $report);
        }
        return view('report', ['reports' => $finalReport]);
        // response()->json($finalReport);
    }

    public function getSingle($id)
    {
        $report = Report::where('id', $id)->first();

        if (!$report) {
            throw new Exception('report not found');
        }

        return response()->json($report);
    }


    public function getReportDoc($fileName)
    {
        if (Storage::exists('report/' . $fileName)) { {
                return response()->file(storage_path('/app/report/' . $fileName));
            }
        }
    }

    public function updateReport(Request $request, $id)
    {
        $validation = Validator::make($request->all(), [
            "title" => "required|string|max:255",
            "reportFile" =>  'file|max:5000|mimes:pdf',
        ]);

        if ($validation->fails()) {
            return response()->json(["errors" => $validation->errors()->all()], Response::HTTP_UNPROCESSABLE_ENTITY);
        }

        $report = Report::find($id);

        if (!$report) {
            return response()->json(['message' => 'report not found']);
        }

        Storage::delete($report->url);

        $path = $request->reportFile->store('report');

        $report->title = $request->title;
        $report->url = $path;
        $report->save();

        return response()->json(['message' => 'updated successfully']);
    }

    public function deleteReport($id)
    {
        $report = Report::find($id);

        if (!$report) {
            return response()->json(['message' => 'report not found']);
        }

        Storage::delete($report->url);
        $report->delete();

        return response()->json(['message' => 'deleted successfully']);
    }
}
