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
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class BankInfoController extends Controller
{
    use ApiResponser;

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

        return $this->successResponse($bankInfo);
    }
}
