<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\ApiRequest;
use App\Services\getInfoService;
use Illuminate\Http\Request;

class ApiController extends Controller
{
    /**
     * @var getInfoService
     */
    private $service;

    public function __construct(getInfoService $service)
    {
        $this->service = $service;
    }

    public function getInfo(ApiRequest $request) {
        return $this->service->info($request);
    }
}
