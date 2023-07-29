<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DocumentController extends Controller
{
    public function showDocumentPage()
    {
        $documents = DB::select(
            'SELECT a.* FROM
                    Document AS a 
                    JOIN DocumentType AS b
                    ON a.type_id = b.id
                    WHERE b.name = ?',
            ['document']
        );

        $finalDocument = [];

        foreach ($documents as $value) {
            $fileUrl = explode('/', $value->url)[1];
            $document = [
                "id" => $value->id,
                "title" => $value->title,
                "created_at" => $value->created_at,
                "updataed_at" => $value->updated_at,
                "url" => $fileUrl
            ];
            array_push($finalDocument, $document);
        }

        return view('document', ['documents' => $finalDocument]);
    }


    public function showGameRules()
    {
        $gameRules = DB::select(
            'SELECT a.* FROM
                    Document AS a 
                    JOIN DocumentType AS b
                    ON a.type_id = b.id
                    WHERE b.name = ?',
            ['game-rules']
        );

        $finalGameRules = [];

        foreach ($gameRules as $value) {
            $fileUrl = explode('/', $value->url)[1];
            $gameRule = [
                "id" => $value->id,
                "title" => $value->title,
                "created_at" => $value->created_at,
                "updataed_at" => $value->updated_at,
                "url" => $fileUrl
            ];
            array_push($finalGameRules, $gameRule);
        }

        return view('gameRules', ['gameRules' => $finalGameRules]);
    }


    public function showAdditionalGameRules()
    {
        $additionalGameRules = DB::select(
            'SELECT a.* FROM
                    Document AS a 
                    JOIN DocumentType AS b
                    ON a.type_id = b.id
                    WHERE b.name = ?',
            ['additional-rules']
        );

        $finalAdditionalGameRules = [];

        foreach ($additionalGameRules as $value) {
            $fileUrl = explode('/', $value->url)[1];
            $additionalGameRule = [
                "id" => $value->id,
                "title" => $value->title,
                "created_at" => $value->created_at,
                "updataed_at" => $value->updated_at,
                "url" => $fileUrl
            ];
            array_push($finalAdditionalGameRules, $additionalGameRule);
        }

        return view('additionalGameRule', ['additionalGameRules' => $finalAdditionalGameRules]);
    }


    public function showCircularPage()
    {
        $circularDocuments = DB::select(
            'SELECT a.* FROM
                    Document AS a 
                    JOIN DocumentType AS b
                    ON a.type_id = b.id
                    WHERE b.name = ?',
            ['circular']
        );

        $finalCircularDocuments = [];

        foreach ($circularDocuments as $value) {
            $fileUrl = explode('/', $value->url)[1];
            $circularDocument = [
                "id" => $value->id,
                "title" => $value->title,
                "created_at" => $value->created_at,
                "updataed_at" => $value->updated_at,
                "url" => $fileUrl
            ];
            array_push($finalCircularDocuments, $circularDocument);
        }

        return view('circularDocument', ['circularDocuments' => $finalCircularDocuments]);
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
