<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Support\Facades\Response;
use App\Helpers\ResponseObject;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    public function handleResponse($data)
    {
        $response = new ResponseObject();
        $response->Object = $data;
        $response->status_code = 200;
        //$headers["Access-Control-Allow-Headers"] = "Authorization, Content-Type";
        return Response::json($response,$response->status_code);
    }
}
