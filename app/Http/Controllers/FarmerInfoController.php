<?php

namespace App\Http\Controllers;

use App\Models\FarmerInfo;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class FarmerInfoController extends Controller
{

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

    }

    /**
     * Creates an instance of @see FarmerInfo
     * @param Request $request
     * @return void
     */
    public function store(Request $request)
    {

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
