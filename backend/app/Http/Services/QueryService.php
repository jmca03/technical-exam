<?php

namespace App\Http\Services;

use App\Http\Repositories\QueryRepository;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Client\Response;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Validator;

class QueryService implements QueryRepository
{
    /**
     * Query url
     * 
     * @param \Illuminate\Http\Request $request
     * 
    //  * @return \Illuminate\Http\JsonResponse|\Illuminate\Http\Client\Response
     */
    public function query(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'url' => 'required|url'
        ]);

        if ($validator->fails()) {
            return response()->json([
                'message' => 'url is not valid url or is not an api.'
            ], 400);
        }

        $urlResponse = $this->urlResponse($request->url);

        $reverseResponse = $this->reverseResponse($urlResponse);

        // return $urlResponse;
        return $reverseResponse;
    }

    /**
     * Returns URL Response
     * 
     * @param string url
     * 
     * @return \Illuminate\Http\Client\Response
     */
    private function urlResponse($url): Response
    {
        $response = Http::withHeaders([
            'Content-Type' => 'application/json'
        ])->get($url);

        return $response;
    }

    /**
     * Reverse URL Response
     * 
     * @param \Illuminate\Http\Client\Response $response
     * 
     * @return  \Illuminate\Http\JsonResponse
     */
    private function reverseResponse($response): JsonResponse
    {

        $jsonRespons = $response->collect()->reverse()->map(function ($values, $key) {

            return collect($values)->flatten(function ($value, $key) {
                $reverseValue = strrev($value);
                $reverseKey = strrev($key);

                return [
                    $reverseKey => $reverseValue
                ];
            })->all();
        })->values();

        return response()->json($jsonRespons);
    }
}
