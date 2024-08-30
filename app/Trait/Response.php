<?php

namespace App\Trait;

use Illuminate\Http\JsonResponse;

trait Response
{
    public function success($data, $msg, $status = 200): JsonResponse
    {
        return response()->json([
            'status' => $status,
            'msg' => $msg,
            'data' => $data,
        ], $status);
    }


    public function failed($msg, $data = [], $status = 400): JsonResponse
    {
        return response()->json([
            'status' => $status,
            'msg' => $msg,
            'data' => $data,
        ], $status);
    }

    public function msg($msg, $status = 200): JsonResponse
    {
        return response()->json([
            'status' => $status,
            'msg' => $msg,
        ], $status);
    }
}


