<?php

namespace CP;

class AjaxResponse {

    public function success($message, array $extra = null) {

        $json = [
            'success' => true,
            'code' => 200,
            'message' => $message,
        ];

        if ($extra) {
            $json = array_merge($json, $extra);
        }

        return response()->json($json);
    }

    public function successWithToken($message, $token) {

        $json = [
            'success' => true,
            'message' => $message,
        ];

        return response()->json(compact('json', 'token'));
    }

    public function error($message, int $statusCode = null, $eCode = null) {

        // set default status code
        if ($statusCode == null) {
            $statusCode = 400;
        }

        $json = [
            'success' => false,
            'error' => [
                'code' => $statusCode,
                'message' => $message,
            ],
        ];

        if ($eCode) {
            $json['error']['e_code'] = $eCode;
        }

        return response()->json($json, $statusCode);
    }
}