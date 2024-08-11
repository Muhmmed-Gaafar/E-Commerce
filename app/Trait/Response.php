<?php

namespace App\Trait;

use Illuminate\Http\JsonResponse;

trait Response
{
    /**
     * Generate a success response.
     *
     * @param mixed $data
     * @param string $msg
     * @param int $status
     * @return JsonResponse
     */
    public function success($data, $msg, $status = 200): JsonResponse
    {
        return response()->json([
            'status' => $status,
            'msg' => $msg,
            'data' => $data,

        ], $status);
    }

    /**
     * Generate a failed response.
     *
     * @param mixed $data
     * @param string $msg
     * @param int $status
     * @return JsonResponse
     */
    public function failed($msg, $data = [], $status = 400): JsonResponse
    {
        return response()->json([
            'status' => $status,
            'msg' => $msg,
            'data' => $data,

        ], $status);
    }

    /**
     * Generate a message response.
     *
     * @param string $msg
     * @param int $status
     * @return JsonResponse
     */
    public function msg($msg, $status = 200): JsonResponse
    {
        return response()->json([
            'status' => $status,
            'msg' => $msg,

        ], $status);
    }
}


