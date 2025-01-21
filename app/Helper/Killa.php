<?php
namespace App\Helper;

class Killa
{

    public static function responseSuccessWithMetaAndResult(
        $http_code,
        $status_code,
        $message,
        $result_data
    ) {
        $response = [
            'meta' => [
                'success' => true,
                'status' => $status_code,
                'message' => $message
            ],
            'result' => $result_data
        ];

        return response($response, $http_code);
    }

    public static function responseErrorWithMetaAndResult(
        $http_code,
        $status_code,
        $message,
        $error_data
    ) {
        $response = [
            'meta' => [
                'success' => false,
                'status' => $status_code,
                'message' => $message
            ],
            'result' => $error_data
        ];

        return response($response, $http_code);
    }
}
