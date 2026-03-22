<?php


if (!function_exists('apiResponse')) {
    function apiResponse($data = null, $message = null, $status = 200)
    {
        $response = [];

        if ($message) {
            $response['message'] = $message;
        }

        if (!is_null($data)) {
            $response['data'] = $data;
        }

        return response()->json($response, $status);
    }
}
