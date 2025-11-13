<?php

namespace App\Helper;

class ApiResponse
{
    public static function error($e, $code = 500)
    {
        return response()->json([
            'success' => false,
            'message' => $e->getMessage(),
        ], $code);
    }

    public static function validationError($errors, $code = 422)
    {
        return response()->json([
            'success' => false,
            'message' => $errors,
        ], $code);
    }

    public static function success($result = null, $message = "Success", $code = 200)
    {
        $response = [
            'success' => true,
            'message' => $message
        ];

        if (!empty($result)) {
            $response['data'] = $result;
        }

        return response()->json($response, $code);
    }
}
