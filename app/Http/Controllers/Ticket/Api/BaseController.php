<?php

namespace App\Http\Controllers\Ticket\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\JsonResponse;

/**
 * Class BaseController
 * @package App\Http\Controllers\Ticket\Api
 */
abstract class BaseController extends Controller
{
    /**
     * Return generic json response with the given data.
     *
     * @param       $data
     * @param int   $statusCode
     * @param array $headers
     *
     * @return JsonResponse
     */
    protected function respond($data, $statusCode = 200, $headers = [])
    {
        return response()->json($data, $statusCode, $headers);
    }
}
