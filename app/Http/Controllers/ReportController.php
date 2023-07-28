<?php

namespace App\Http\Controllers;

use App\Models\Document;
use App\Models\DocumentType;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class ReportController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth', ['except' => ['get','getSingle','getReportDoc']]);
    }

    public function addDocument()
    {
        $types = DocumentType::all();
        return view('admin.create-document',[
            "types" => $types
        ]);
    }

    public function create(Request $request)
    {
        $validation = Validator::make($request->all(), [
            "title" => "required|string|max:255",
            "reportFile" =>  'file|max:5000|mimes:pdf',
            "typeID" => 'required|integer'
        ]);

        if ($validation->fails()) {
            return response()->json(["errors" => $validation->errors()->all()], Response::HTTP_UNPROCESSABLE_ENTITY);
        }

        $path = $request->reportFile->store('documents');

        Document::create([
            'title' => $request->title,
            'url' => $path,
            'type_id' => $request->typeID
        ]);

        return redirect('/report-view')
            ->with('message', 'document is added successfully');
    }

    public function getReport()
    {
        $reports = DB::select('SELECT a.id, a.title, a.url,b.name 
                            FROM Document AS a
                                JOIN DocumentType AS b
                                ON b.id = a.type_id
                                ORDER BY a.created_at DESC');


        $final = [];

        foreach($reports as $report){
            $array = preg_split("#/#",$report->url);
            array_push($final, [
                "id" => $report->id,
                "title" => $report->title,
                "type" => $report->name,
                "url" => $array[1]
            ]);
        }

        return view('admin.reportlist',[
            "reports" => $final
        ]);
    }

    public function get()
    {

        $reports = Document::where('type_id', 1);

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
    }

    public function getSingle($id)
    {
        $report = Document::where('type_id', 1)->where('id', $id)->first();

        if (!$report) {
            throw new Exception('report not found');
        }

        return response()->json($report);
    }


    public function getReportDoc($fileName)
    {
        if (Storage::exists('documents/' . $fileName)) { {
                return response()->file(storage_path('/app/documents/' . $fileName));
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

        $report = Document::where('type_id', 1)->where('id', $id)->first();

        if (!$report) {
            return response()->json(['message' => 'report not found']);
        }

        Storage::delete($report->url);

        $path = $request->reportFile->store('documents');

        $report->title = $request->title;
        $report->url = $path;
        $report->save();

        return response()->json(['message' => 'updated successfully']);
    }

    public function deleteReport($id)
    {
        $report = Document::where('id', $id)->where('type_id', 1)->first();

        if (!$report) {
            return response()->json(['message' => 'report not found']);
        }

        Storage::delete($report->url);
        $report->delete();

        return redirect('/report-view')
            ->with('message', 'document deleted successfully');
    }
}
