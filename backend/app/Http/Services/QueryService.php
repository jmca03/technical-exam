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
    public function query(Request $request): JsonResponse|Response
    {
        $validator = Validator::make($request->all(), [
            'url' => 'required|url'
        ]);

        if ($validator->fails()) {
            return response()->json([
                'message' => 'url is not valid url or is not a rest api'
            ], 400);
        }

        $urlResponse = $this->urlResponse($request->url);

        return $urlResponse;
    }

    private function urlResponse($url)
    {
        $response = Http::withHeaders([
            'Content-Type' => 'application/json'
        ])->get($url);

        return $response;
    }
}
