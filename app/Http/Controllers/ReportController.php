<?php

namespace App\Http\Controllers;

use App\Models\Document;
use App\Models\DocumentType;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Storage;

class ReportController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth', ['except' => ['get', 'getSingle', 'getReportDoc']]);
    }

    public function addDocument()
    {
        if (!Gate::allows('is-admin') && !Gate::allows('is-dcm')) {
            Auth::logout();
            return redirect('/');
        }

        $types = DocumentType::all();
        return view('admin.create-document', [
            "types" => $types
        ]);
    }

    public function create(Request $request)
    {
        if (!Gate::allows('is-admin') && !Gate::allows('is-dcm')) {
            Auth::logout();
            return redirect('/');
        }

        $request->validate([
            "title" => "required|string|max:255",
            "reportFile" =>  'required|file|max:5000|mimes:pdf',
            "typeID" => 'required|integer'
        ]);

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
        if (!Gate::allows('is-admin') && !Gate::allows('is-dcm')) {
            Auth::logout();
            return redirect('/');
        }

        $reports = DB::select('SELECT a.id, a.title, a.url,b.name 
                                FROM Document AS a
                                    JOIN DocumentType AS b
                                    ON b.id = a.type_id
                                    ORDER BY a.created_at DESC');


        $final = [];

        foreach ($reports as $report) {
            $array = preg_split("#/#", $report->url);
            array_push($final, [
                "id" => $report->id,
                "title" => $report->title,
                "type" => $report->name,
                "url" => $array[1]
            ]);
        }

        return view('admin.reportlist', [
            "reports" => $final
        ]);
    }

    public function get()
    {

        $reports = DB::table('Document AS a')
            ->join('DocumentType AS b', 'a.type_id', '=', 'b.id')
            ->select('a.*')
            ->where('b.name', 'report')
            ->paginate(10);

        return view('report', ['reports' => $reports]);
    }

    public function getSingle($id)
    {

        $report = Document::where('id', $id)->first();

        if (!$report) {
            return redirect()->back()->with('errors', 'report not found');
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

    public function editReport($id)
    {
        if (!Gate::allows('is-admin') && !Gate::allows('is-dcm')) {
            Auth::logout();
            return redirect('/');
        }

        $report = Document::where('id', $id)->first();
        $types = DocumentType::all();

        if (!$report) {
            return redirect()->back()->with('errors', 'report not found');
        }

        return view('admin.update-document', [
            'report' => $report,
            'types' => $types
        ]);
    }

    public function updateReport(Request $request, $id)
    {
        if (!Gate::allows('is-admin') && !Gate::allows('is-dcm')) {
            Auth::logout();
            return redirect('/');
        }

        $request->validate([
            "title" => "required|string|max:255",
            "reportFile" =>  'required|file|max:5000|mimes:pdf',
            "typeID" => 'required|integer'
        ]);

        $report = Document::where('id', $id)->first();

        if (!$report) {
            return redirect()->back()->with('errors', 'report not found');
        }

        Storage::delete($report->url);

        $path = $request->reportFile->store('documents');

        $report->title = $request->title;
        $report->url = $path;
        $report->type_id = $request->typeID;
        $report->save();

        return redirect('/report-view')
            ->with('message', 'document is updated successfully');
    }

    public function deleteReport($id)
    {
        if (!Gate::allows('is-admin') && !Gate::allows('is-dcm')) {
            Auth::logout();
            return redirect('/');
        }

        $report = Document::where('id', $id)->first();

        if (!$report) {
            return redirect()->back()->with('errors', 'report not found');
        }

        Storage::delete($report->url);
        $report->delete();

        return redirect('/report-view')
            ->with('message', 'document deleted successfully');
    }
}
