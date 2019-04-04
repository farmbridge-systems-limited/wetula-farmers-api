<?php

namespace App\Http\Controllers;

use App\Models\FarmerInfo;
use App\traits\ApiResponser;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class FarmerInfoController extends Controller
{
    use ApiResponser;

    public function __construct()
    {

    }

    /**
     * Return the full list of farmers both verified and unverified
     * @author Danquah Bernard White
     * @api /farmers
     */
    public function index()
    {
        //TODO: chunk records for faster loads
        $farmers = FarmerInfo::with('enterprises', 'lands.documents', 'bankInfo')->get();
        return $this->successResponse($farmers);
    }

    /**
     * Creates an instance of @see FarmerInfo
     * @param Request $request
     * @return JsonResponse
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request)
    {
        $rules = [
            'user_id' => 'required|numeric',
            'surname' => 'required|max:250',
            'first_name' => 'required|max:250',
            'middle_name' => 'required|max:250',
            'nickname' => 'required|max:250',
            'sex' => 'required|in:male,female',
            'date_of_birth' => 'required',
            'id_type' => 'required',
            'id_number' => 'required',
            'town_village_settlement' => 'required',
            'road_street_trace_address' => 'required',
            'house_number' => 'required',
            'email' => 'required',
            'postal_office_box' => 'required',
            'postal_town_village_settlement' => 'required',
            'postal_street_road_trace_sentence' => 'required',
            'district_province' => 'required',
            'region' => 'required',
            'country' => 'required',
            'is_absentee_farmer' => 'required',
            'is_verified' => 'required',
            'date_verified' => 'required',
            'photograph_url' => '',
            'applicant_signage_url' => '',
        ];

        $this->validate($request, $rules);

        $farmerInfo = FarmerInfo::create($request->all());

        return $this->successResponse($farmerInfo, Response::HTTP_CREATED);

    }

    /**
     * Obtain and show the details of one author
     * @param $farmer_info
     * @return \Illuminate\Http\JsonResponse
     */
    public function show($farmer_info): JsonResponse
    {
        return response()->json([]);
    }

    /**
     * Updates an existing @see FarmerInfo
     * @param Request $request
     * @param $farmer_info
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(Request $request, $farmer_info): JsonResponse
    {
        return response()->json([]);
    }

    /**
     * Remove an existing @see FarmerInfo
     * @param $farmer_info
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy($farmer_info): JsonResponse
    {
        return response()->json([]);
    }

}
