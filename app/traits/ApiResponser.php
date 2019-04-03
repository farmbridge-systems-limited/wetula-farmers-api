<?php
/**
 * Created by PhpStorm.
 * User: Dan White
 * Date: 4/3/2019
 * Time: 6:54 PM
 */

namespace App\traits;


use Illuminate\Http\JsonResponse;
use Illuminate\Http\Response;

trait ApiResponser
{
    /**
     * Builds success response
     * @param string|array $data
     * @param int $code
     * @return \Illuminate\Http\JsonResponse
     */
    public function successResponse($data, $code = Response::HTTP_OK): JsonResponse
    {
        return response()->json(['data' => $data], $code);
    }

    /**
     * Builds error responses
     * @param string|array $message
     * @param int $code
     * @return \Illuminate\Http\JsonResponse
     */
    public function errorResponse($message, $code): JsonResponse
    {
        return response()->json(['message' => $message, 'code' => $code], $code);
    }
}
