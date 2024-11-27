<?php

// ShopController.php
namespace App\Http\Controllers;

use Illuminate\Support\Facades\Http;
use Illuminate\Http\Request;

class ShopController extends Controller
{
    public function show($id)
    {   
        error_log("Received ID: " . $id); 
        $apiKey = 'b63cb0588fff6793'; // あなたのAPIキー
        $url = 'http://webservice.recruit.co.jp/hotpepper/gourmet/v1/';

        // APIリクエストを実行
        $response = Http::get($url, [
            'key' => $apiKey,
            'id' => $id,
            'format' => 'json'
        ]);
        
        error_log("API Response Status: " . $response->status()); 
        // APIエラーの場合
        if ($response->failed()) {
            error_log("API Request Failed: " . $response->body());
            return response()->json(['error' => 'ホットペッパーAPIリクエスト失敗'], $response->status());
        }

        $data = $response->json();

        // レストラン情報が存在しない場合
        if (empty($data['results']['shop'])) {
            error_log("No Shop Found for ID: " . $id);
            return response()->json(['error' => 'レストランが見つかりません'], 404);
        }

        // レストラン情報を整形して返却
        $shop = $data['results']['shop'][0];
        return response()->json([
            'id' => $shop['id'],
            'name' => $shop['name'],
            'address' => $shop['address'] ?? '住所情報なし',
            'access' => $shop['access'] ?? 'アクセス情報はありません',
            'openingHours' => $shop['open'] ?? '営業時間情報なし',
            'phone' => $shop['tel'] ?? '電話番号情報なし',
            'budget' => $shop['budget']['average'] ?? '予算情報なし',
            'image' => $shop['photo']['mobile']['l'] ?? '画像情報なし',
        ]);
    }
    
}

