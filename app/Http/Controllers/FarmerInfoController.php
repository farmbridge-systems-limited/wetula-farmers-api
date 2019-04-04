<?php

namespace App\Http\Controllers;

use App\Models\BankInfo;
use App\Models\FarmerEnterprise;
use App\Models\FarmerInfo;
use App\Models\Land;
use App\Models\LandDocument;
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
            'date_of_birth' => 'required|date|before:' . $min_date_of_birth->toDateString(), //TODO:: return appropriate error messaging telling the user he/she is not 18 years and not eligible instead of the current default error message.
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
            'account_type' => 'required',
            'account_name' => 'required',
            'account_number' => 'required',
            'bic_swift_code' => 'required',
            'bank_name' => 'required',
            'branch_address' => 'required',
            'bank_phone_number' => 'required',
            'enterprises' => 'required|array',
            'lands' => 'required|array',


        ];

        $this->validate($request, $rules);

        $data = $request->all();

        DB::beginTransaction();

        // Create FarmerInfo
        $farmer = new FarmerInfo();
        $farmer->user_id = $data['user_id'];
        $farmer->first_name = $data['first_name'];
        $farmer->surname = $data['surname'];
        $farmer->middle_name = $data['middle_name'];
        $farmer->nickname = $data['nickname'];
        $farmer->sex = $data['sex'];
        $farmer->date_of_birth = $data['date_of_birth'];
        $farmer->id_type = $data['id_type'];
        $farmer->id_number = $data['id_number'];
        $farmer->town_village_settlement = $data['town_village_settlement'];
        $farmer->road_street_trace_address = $data['road_street_trace_address'];
        $farmer->house_number = $data['house_number'];
        $farmer->email = $data['email'];
        $farmer->postal_office_box = $data['postal_office_box'];
        $farmer->postal_town_village_settlement = $data['postal_town_village_settlement'];
        $farmer->postal_street_road_trace_sentence = $data['postal_street_road_trace_sentence'];
        $farmer->district_province = $data['district_province'];
        $farmer->region = $data['region'];
        $farmer->country = $data['country'];
        $farmer->is_absentee_farmer = $data['is_absentee_farmer'];
        $farmer->is_verified = $data['is_verified'];
        $farmer->date_verified = $data['date_verified'];
        $farmer->photograph_url = $data['photograph_url'];
        $farmer->applicant_signage_url = $data['applicant_signage_url'];
        $farmer->save();


        // Create Bank Info
        $bankInfo = new BankInfo;
        $bankInfo->farmer_info_id = $farmer->id;
        $bankInfo->account_type = $data['account_type'];
        $bankInfo->account_name = $data['account_name'];
        $bankInfo->account_number = $data['account_number'];
        $bankInfo->bic_swift_code = $data['bic_swift_code'];
        $bankInfo->bank_name = $data['bank_name'];
        $bankInfo->branch_name = $data['branch_name'];
        $bankInfo->branch_address = $data['branch_address'];
        $bankInfo->bank_phone_number = $data['bank_phone_number'];
        $bankInfo->save();

        // Create Farmer Enterprises
        $enterprises_request = collect($data['enterprises']);
        $enterprises_request->each(function ($data, $key) use ($farmer) {
            FarmerEnterprise::create([
                'farmer_info_id' => $farmer->id,
                'enterprise_id' => $data['enterprise_id'],
                'engagement_status' => $data['engagement_status']
            ]);
        });


        // Create Farmer Lands
        $lands_request = collect($data['lands']);
        $lands_request->each(function ($land_data, $key) use ($farmer) {
            /**
             * TODO:// Create a custom validator to validate each object item in the lands_request array
             * The Custom Validators job is validate a single land object entries as to those which are
             * required and also in the correct data type.
             **/

            // Create Land
            $land_parcel = Land::create([
                'farmer_info_id' => $farmer->id,
                'address' => $land_data['address'],
                'size_area' => $land_data['size_area'],
                'region' => $land_data['region'],
                'district' => $land_data['district'],
                'locality' => $land_data['locality']
            ]);

            // Get the above land related documents
            $documents = collect($land_data['documents']);
            $documents->each(static function ($document_item, $key) use ($land_parcel) {

                /**
                 * TODO:// Create a custom validator to validate each object item in the $documents array
                 * The Custom Validators job is validate a single land object entries as to those which are
                 * required and also in the correct data type.
                 **/

                //Create Land Documents
                LandDocument::create([
                    'land_id' => $land_parcel->id,
                    'document_type' => $document_item['document_type'],
                    'document_url' => $document_item['document_url']
                ]);
            });

        });

        DB::commit();

        $response = FarmerInfo::with('enterprises', 'lands.documents', 'bankInfo')->
        where('id', $farmer->id)->get();
        return $this->successResponse($farmer, Response::HTTP_CREATED);

    }

    /**
     * Obtain and show the details of one author
     * @param $farmer_info
     * @return \Illuminate\Http\JsonResponse
     */
    public function show($farmer_info): JsonResponse
    {
        $farmer = FarmerInfo::with('enterprises', 'lands.documents', 'bankInfo')->
        where('id', $farmer_info)->get();
        return $this->successResponse($farmer, Response::HTTP_OK);
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
