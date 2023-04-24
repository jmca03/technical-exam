<?php

namespace App\Http\Services;

use App\Http\Repositories\QueryRepository;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Client\Response;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Validator;

class QueryService implements QueryRepository
{
    /**
     * Query url
     * 
     * @param \Illuminate\Http\Request $request
     * 
     * @return \Illuminate\Http\JsonResponse
     */
    public function query(Request $request): JsonResponse
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

        return response()->json([
            'url_response' => $urlResponse->json(),
            'reverse_response' => $reverseResponse
        ], 200);
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
     * @return  \Illuminate\Support\Collection
     */
    private function reverseResponse($response): Collection
    {

        $jsonRespons = $response->collect()->reverse()->map(function ($values, $key) {

            return collect($values)->mapWithKeys(function ($value, $key) {
                $reverseValue = strrev($value);
                $reverseKey = strrev($key);

                return [
                    $reverseKey => $reverseValue
                ];
            })->all();
        })->values();

        return $jsonRespons;
    }

    private function iterateThroughAllData(array $data)
    {
        return collect($data)->mapWithKeys(function ($value, $key) {

            if (is_array($value)) {
            } else {
            }

            $reverseValue = strrev($value);
            $reverseKey = strrev($key);

            return [
                $reverseKey => $reverseValue
            ];
        })->all();
    }
}
