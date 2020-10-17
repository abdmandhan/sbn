<?php

namespace Abdmandhan\Sbn\Traits;


trait ResponseTrait
{
    function de($data = [])
    {
        echo json_encode($data);
        die;
    }
    function reSuccess($data = [], $message = '')
    {
        return response()->json([
            'status'    => true,
            'data'      => $data,
            'message'   => $message
        ]);
    }

    function reFailed($data = [], $message = '')
    {
        return response()->json([
            'status'    => false,
            'data'      => $data,
            'message'   => $message
        ]);
    }
}
