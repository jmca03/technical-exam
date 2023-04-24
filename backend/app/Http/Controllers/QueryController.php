<?php

namespace App\Http\Controllers;

use App\Http\Services\QueryService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Client\Response;
use Illuminate\Http\Request;

class QueryController extends Controller
{
    protected $queryService;

    public function __construct(QueryService $queryService)
    {
        $this->queryService = $queryService;
    }

    /**
     * Returns URL Response and Reverted Response
     * 
     * @param \Illuminate\Http\Request $request
     * 
     * @return \Illuminate\Http\JsonResponse|\Illuminate\Http\Client\Response
     */
    public function query(Request $request): JsonResponse|Response
    {
        return $this->queryService->query($request);
    }
}
