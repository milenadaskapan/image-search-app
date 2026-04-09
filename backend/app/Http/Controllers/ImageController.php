<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Http;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;

class ImageController extends Controller
{
    public function search(Request $request) {
        $query = $request->query('query');

        if (Cache::has($query)) { #Check if the query is stored in the Cache already
            return response()->json([
                "source" => "cache",
                "data" => Cache::get($query)
            ]);
        }

        $response = Http::withHeaders([
            'Authorization' => env('PEXELS_API_KEY')
                ])->get('https://api.pexels.com/v1/search', [
                    'query' => $query
                ]);

        $photos = $response->json()['photos'];

        $data = [];

        foreach ($photos as $photo) {
            $data[] = [
                "id" => $photo['id'],
                "photographer" => $photo['photographer'],
                "image_url" => $photo['src']['medium']
            ];
        }
        Cache::put($query, $data, 60); #Minimum caching of 60 seconds

        return response()->json([
            "source" => "api",
            "data" => $data
        ]);
    }
}