<?php

namespace App\Http\Controllers;

use App\Models\FarmerInfo;
use App\traits\ApiResponser;
use Carbon\Carbon;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\DB;

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
        $farmers = FarmerInfo::with('enterprises', 'lands.documents', 'bankInfo')
            ->orderBy('created_at', 'desc')
            ->paginate(5);
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
        $min_date_of_birth = Carbon::today()->addYears(-18);

        $rules = [
            'user_id' => 'required|numeric|unique:farmer_info',
            'surname' => 'required|max:250',
            'first_name' => 'required|alpha|max:250',
            'middle_name' => 'required|alpha|max:250',
            'nickname' => 'string|max:250',
            'sex' => 'required|alpha|in:male,female',
            'date_of_birth' => 'required|date|before:' . $min_date_of_birth->toDateString(), //TODO:: return appropriate error messaging telling the user he/she is not 18 years and not eligible.
            'id_type' => 'required|alpha',
            'id_number' => 'required|numeric',
            'town_village_settlement' => 'required',
            'road_street_trace_address' => 'required',
            'house_number' => 'required',
            'email' => 'required|email|max:255|unique:farmer_info',
            'postal_office_box' => 'required',
            'postal_town_village_settlement' => 'required',
            'postal_street_road_trace_sentence' => 'required',
            'district_province' => 'required',
            'region' => 'required|alpha',
            'country' => 'required|alpha',
            'is_absentee_farmer' => 'required|boolean',
            'is_verified' => 'required|boolean',
            'date_verified' => 'required|date',
            'photograph_url' => '',
            'applicant_signage_url' => '',
        ];

        $this->validate($request, $rules);

        DB::transaction(static function () use ($request) {
            $farmerInfo = FarmerInfo::create($request->all());
        });

        return $this->errorResponse('Could not store new farmer', Response::HTTP_CREATED);

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
