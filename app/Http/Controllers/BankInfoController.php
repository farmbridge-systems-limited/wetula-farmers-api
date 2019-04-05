<?php
/**
 * Created by PhpStorm.
 * User: Dan White
 * Date: 4/4/2019
 * Time: 3:03 PM
 */

namespace App\Http\Controllers;


use App\Models\BankInfo;
use App\traits\ApiResponser;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class BankInfoController extends Controller
{
    use ApiResponser;


    /**
     * Returns BankInfo of Farmer
     * @param $farmer_info_id
     * @return \Illuminate\Http\JsonResponse
     */
    public function show($farmer_info_id): JsonResponse
    {
        $bank_info = BankInfo::where('farmer_info_id', $farmer_info_id)->first();
        if (empty($bank_info)) {
            return $this->errorResponse('Bank Info for farmer with Specified ID does not exit', Response::HTTP_NOT_FOUND);
        }
        return $this->successResponse($bank_info, Response::HTTP_OK);
    }

    public function update(Request $request, $farmer_info_id)
    {
        $rules = [
            'applicant_signage_url' => '',
            'account_type' => 'string',
            'account_name' => 'string',
            'account_number' => 'string',
            'bic_swift_code' => '',
            'bank_name' => 'string',
            'branch_address' => 'string',
            'bank_phone_number' => 'string',
        ];

        $this->validate($request, $rules);

        $bankInfo = BankInfo::where('farmer_info_id', $farmer_info_id)->first();

        if (empty($bankInfo)) {
            return $this->errorResponse('Bank Info not found', Response::HTTP_NOT_FOUND);
        }

        $bankInfo->fill($request->all());

        if ($bankInfo->isClean()) {
            return $this->errorResponse('At least one value must change.',
                Response::HTTP_UNPROCESSABLE_ENTITY);
        }
        $bankInfo->save();

        return $this->successResponse($bankInfo);
    }

    public function destroy($bank_info_id)
    {
        $bankInfo = BankInfo::findOrFail($bank_info_id);
        $bankInfo->delete();
        return $this->successResponse($bankInfo);
    }
}
