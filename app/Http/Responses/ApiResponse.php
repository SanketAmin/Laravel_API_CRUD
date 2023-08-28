<?php

namespace App\Http\Responses;

trait ApiResponse
{
    public function successResponse($data, $message = null, $status = 200)
    {
        return response()->json([
            'meta' => [
                'message' => $message ?: 'Success',
            ],
            'data' => $data,
        ], $status);
    }

    public function errorResponse($message, $status)
    {
        return response()->json([
            'meta' => [
                'message' => $message,
            ]
        ], $status);
    }
}
