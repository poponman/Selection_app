<?php

return [
'paths' => ['api/*', '/search','sanctum/csrf-cookie','restaurants'], // 適用するルートを指定
'allowed_methods' => ['*'], // 許可するHTTPメソッド ('*' ですべて許可)
'allowed_origins' => ['http://localhost:3000'], // 許可するオリジン (フロントエンドのURL)
'allowed_origins_patterns' => [], // パターン指定が必要ならこちらを使用
'allowed_headers' => ['*'], // 許可するリクエストヘッダー ('*' ですべて許可)
'exposed_headers' => [], // クライアントに公開するレスポンスヘッダー
'max_age' => 0, // プリフライトリクエストのキャッシュ期間 (秒)
'supports_credentials' => false, // 認証情報付きのリクエストを許可するか

];
