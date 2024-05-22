<?php

namespace App\Traits\Api;

trait Response
{
    protected function error($message, $statusCode){
        return response()->json([
            'message' => $message,
            'status' => $statusCode
        ], $statusCode);
    }

    protected function success($message, $data= [], $statusCode= 200){
        return response()->json([
            'message' => $message,
            'data' => $data,
            'status' => $statusCode
        ], $statusCode);
    }
}
