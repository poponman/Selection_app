<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use App\Models\Restaurant;

class RestaurantController extends Controller
{
    public function search(Request $request)
    {
        $apiKey = env('b63cb0588fff6793');
        $endpoint = 'https://webservice.recruit.co.jp/hotpepper/gourmet/v1/';
        
        $params = [
            'key' => $apiKey,
            'keyword' => $request->input('query', ''),
            'genre' => $request->input('foodType', ''),
            'large_area' => $request->input('storeType', ''),
            'non_smoking' => $request->input('isNonSmoking') ? 1 : 0,
            'parking' => $request->input('hasParking') ? 1 : 0,
            'drink' => $request->input('hasAlcohol') ? 1 : 0,
            'child' => $request->input('isFamilyFriendly') ? 1 : 0,
            'lat' => $request->input('lat', 0),
            'lng' => $request->input('lng', 0),
            'range' => $request->input('radius', 5),
            'format' => 'json',
        ];

        $response = Http::get($endpoint, $params);

        if ($response->successful()) {
            return response()->json($response->json());
        } else {
            return response()->json(['error' => 'APIリクエストに失敗しました'], 500);
        }
    }

    public function getRestaurants()
{
    // レストランデータを取得
    $restaurants = Restaurant::all();

    // 各レストランに画像URLを追加
    $restaurantsWithImages = $restaurants->map(function($restaurant) {
        // 画像ファイルのパスを取得
        $imagePath = Http::url('images/' . $restaurant->image_filename); // 画像が storage/app/public/images に保存されている場合

        // URLを追加
        $restaurant->logo_image = $imagePath;

        return $restaurant;
    });

    // レスポンスを返す
    return response()->json($restaurantsWithImages);
}
}
