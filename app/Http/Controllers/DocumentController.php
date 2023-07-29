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
}
