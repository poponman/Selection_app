<?php
use App\Http\Controllers\RestaurantController;
use App\Http\Controllers\ShopController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Http;
use Illuminate\Http\Request;


Route::post('/api/search', [RestaurantController::class, 'search']);

Route::get('/hotpepper-proxy', function (Request $request) {
    try {
        $url = 'http://webservice.recruit.co.jp/hotpepper/gourmet/v1/';
        
        // リクエストパラメータを取得
        $queryParams = $request->query();
        
        // 必須パラメータをチェック
        if (!isset($queryParams['key']) || empty($queryParams['key'])) {
            return response()->json(['error' => 'Missing API key'], 400);
        }

        // 外部 API 呼び出し
        //$response = Http::get($url, $queryParams);
        $response = Http::get($url, $request->all());
        // API レスポンスを返却
        if ($response->successful()) {
            return response()->json($response->json());
        } else {
            return response()->json(['error' => 'Hotpepper API request failed'], $response->status());
        }
    } catch (\Exception $e) {
        return response()->json(['error' => $e->getMessage()], 500);
    }
});
Route::get('restauts', [ShopController::class, 'index']);
#Route::get('/resutaurants/{id}', [ShopController::class, 'show']);
#Route::get('/results/{id}', [ShopController::class, 'show']);
Route::get('/results/{id}', [ShopController::class, 'show'])->where('id', '[A-Za-z0-9]+');

Route::post('/results', [ShopController::class, 'store']);

