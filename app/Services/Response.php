<?php

namespace App\Services;

class Response
{
    public static function success($data)
    {
        $result = [
            'status' => true,
            'data' => $data
        ];
        return json_encode($result);
    }

    public static function error($data)
    {
        if ($data instanceof \Exception) {
            $data = $data->getMessage();
        }
        $result = [
            'status' => false,
            'data' => $data
        ];
        return json_encode($result);
    }
}