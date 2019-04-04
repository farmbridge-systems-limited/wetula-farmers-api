<?php
/**
 * Created by PhpStorm.
 * User: Dan White
 * Date: 4/4/2019
 * Time: 3:03 PM
 */

namespace App\Http\Controllers;


use App\Models\LandDocument;
use App\traits\ApiResponser;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class LandDocumentsController extends Controller
{
    use ApiResponser;

    public function update(Request $request, $land_id, $document_id)
    {
        $rules = [
            'land_id' => 'numeric',
            'document_type' => 'string',
            'document_url' => 'string'
        ];

        $this->validate($request, $rules);

        $document = LandDocument::where('id', $document_id)
            ->where('land_id', $land_id)->first();

        if (empty($document)) {
            return $this->errorResponse('Document not found', Response::HTTP_NOT_FOUND);
        }


        $document->fill($request->all());


        if ($document->isClean()) {
            return $this->errorResponse('At least one value must change.',
                Response::HTTP_UNPROCESSABLE_ENTITY);
        }

        return $this->successResponse($document);
    }
}
