<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;

class DocumentController extends Controller
{
    public function showDocumentPage()
    {
        $documents = DB::table('Document AS a')
            ->join('DocumentType AS b', 'a.type_id', '=', 'b.id')
            ->select('a.*')
            ->where('b.name', 'document')
            ->paginate(10);

        return view('document', ['documents' => $documents]);
    }


    public function showGameRules()
    {

        $gameRules = DB::table('Document AS a')
            ->join('DocumentType AS b', 'a.type_id', '=', 'b.id')
            ->select('a.*')
            ->where('b.name', 'game-rules')
            ->paginate(10);

        return view('gameRules', ['gameRules' => $gameRules]);
    }


    public function showAdditionalGameRules()
    {
        $additionalGameRules = DB::table('Document AS a')
            ->join('DocumentType AS b', 'a.type_id', '=', 'b.id')
            ->select('a.*')
            ->where('b.name', 'additional-rules')
            ->paginate(10);

        return view('additionalGameRule', ['additionalGameRules' => $additionalGameRules]);
    }


    public function showCircularPage()
    {
        $circularDocuments = DB::table('Document AS a')
            ->join('DocumentType AS b', 'a.type_id', '=', 'b.id')
            ->select('a.*')
            ->where('b.name', 'circular')
            ->paginate(10);

        return view('circularDocument', ['circularDocuments' => $circularDocuments]);
    }


    public function showTendersPage()
    {
        $tenders = DB::select(
            'SELECT a.* FROM
                    Document AS a 
                    JOIN DocumentType AS b
                    ON a.type_id = b.id
                    WHERE b.name = ?',
            ['tender']
        );

        $finalTender = [];

        foreach ($tenders as $value) {
            $fileUrl = explode('/', $value->url)[1];
            $tender = [
                "id" => $value->id,
                "title" => $value->title,
                "created_at" => $value->created_at,
                "updataed_at" => $value->updated_at,
                "url" => $fileUrl
            ];
            array_push($finalTender, $tender);
        }

        return view('tender', ['tenders' => $finalTender]);
    }


    public function showJobsPage()
    {
        $jobs = DB::select(
            'SELECT a.* FROM
                    Document AS a 
                    JOIN DocumentType AS b
                    ON a.type_id = b.id
                    WHERE b.name = ?',
            ['jobs']
        );

        $finalJob = [];

        foreach ($jobs as $value) {
            $fileUrl = explode('/', $value->url)[1];
            $job = [
                "id" => $value->id,
                "title" => $value->title,
                "created_at" => $value->created_at,
                "updataed_at" => $value->updated_at,
                "url" => $fileUrl
            ];
            array_push($finalJob, $job);
        }

        return view('job', ['jobs' => $finalJob]);
    }

    public function showOtherCareerPage()
    {
        $otherCareers = DB::select(
            'SELECT a.* FROM
                    Document AS a 
                    JOIN DocumentType AS b
                    ON a.type_id = b.id
                    WHERE b.name = ?',
            ['other-career']
        );

        $finalotherCareers = [];

        foreach ($otherCareers as $value) {
            $fileUrl = explode('/', $value->url)[1];
            $otherCareer = [
                "id" => $value->id,
                "title" => $value->title,
                "created_at" => $value->created_at,
                "updataed_at" => $value->updated_at,
                "url" => $fileUrl
            ];
            array_push($finalotherCareers, $otherCareer);
        }

        return view('otherCareer', ['otherCareers' => $finalotherCareers]);
    }
}
