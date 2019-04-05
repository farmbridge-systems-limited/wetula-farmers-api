<?php
/**
 * Created by PhpStorm.
 * User: Dan White
 * Date: 4/4/2019
 * Time: 3:03 PM
 */

namespace App\Http\Controllers;


use App\Models\Land;
use App\traits\ApiResponser;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class LandController extends Controller
{
    use ApiResponser;

    public function show($farmer_info_id, $land_id): JsonResponse
    {
        $land = Land::findOrFail($land_id);
        return $this->successResponse($land, Response::HTTP_OK);
    }

    public function update(Request $request, $farmer_info_id, $land_id)
    {
        $rules = [
            'verification_officer_id' => '',
            'address' => 'string',
            'size_area' => 'string',
            'gps_address' => '',
            'region' => 'string',
            'district' => 'string',
            'locality' => 'string',
            'remarks' => '',
            'is_tenureship_verified' => 'boolean',
            'are_documents_verified' => 'boolean'
        ];

        $this->validate($request, $rules);

        if ($request->has('verification_office_id')) {
            $this->validate($request, [
                'verification_officer_id' => 'numeric'
            ]);

        }

        $land = Land::where('id', $land_id)
            ->where('farmer_info_id', $farmer_info_id)->first();

        if (empty($land)) {
            return $this->errorResponse('Land Parcel not found', Response::HTTP_NOT_FOUND);
        }

        $land->fill($request->all());


        $land->farmer_info_id = $farmer_info_id;
        $land->is_tenureship_verified = $request->get('is_tenureship_verified');
        $land->are_documents_verified = $request->get('are_documents_verified');
        if ($request->has('verification_officer_id')) {
            $land->verification_officer_id = $request->get('verification_officer_id');
        }

        $land->save();

        return $this->successResponse($land);
    }

    public function destroy($land_id)
    {
        $land = Land::findOrFail($land_id);
        $land->delete();
        return $this->successResponse($land);
    }
}
