<?php

namespace App\Helper;

class ApiResponse
{
    public static function error($e, $message = 'Internal Server Error', $code = 500)
    {
        $response = [
            'success' => false,
            'message' => $message,
            'error'  => $e->getMessage(),
        ];

        if (empty($response['error'])) {
            unset($response['error']);
        }

        return response()->json($response, $code);
    }

    public static function validationError($errors, $message = "Validation Error", $code = 422)
    {
        return response()->json([
            'success' => false,
            'message' => $message,
            'error' => $errors,
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
