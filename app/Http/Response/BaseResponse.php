<?php

namespace App\Http\Response;

use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Http\JsonResponse;

class BaseResponse extends JsonResponse
{
    public static function error($data = null, $code = null, $message = [], $error = []): JsonResponse
    {
        $code = $code ?? 500;
        $result['status'] = 'error';
        $result['response'] =
            [
                'code'    => $code,
                'message' => $message,
                'error'   => $error ,
            ];
        $result['data'] = $data;


        return new JsonResponse([
            $result
        ], $code);
    }

    public static function success($data = null, $code = null, $message = [], $error = []): JsonResponse
    {
        $code = $code ?? 200;
        $result['status'] = 'success';
        $result['response'] =
            [
                'code'    => $code,
                'message' => $message,
                'error'   => $error ,
            ];
        $result['data'] = $data;

        return new JsonResponse([
            $result
        ], $code);
    }

    public static function handleError($messages = [],  $status = 'error', $status_code = 400, $data = [])
    {
        throw new HttpResponseException(
            response()->json([
                'status' => $status,
                'error' => $messages,
                'data' => $data,
            ], $status_code)
        );
    }
}
