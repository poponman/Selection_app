<?php

namespace App\Providers;

use Illuminate\Support\Facades\Route;
use Illuminate\Foundation\Support\Providers\RouteServiceProvider as ServiceProvider;

class RouteServiceProvider extends ServiceProvider
{
    /**
     * コントローラーの名前空間
     */
    protected $namespace = 'App\\Http\\Controllers';

    /**
     * The path to the "home" route for your application.
     */
    public const HOME = '/home';

    /**
     * Define your route model bindings, pattern filters, etc.
     */
    public function boot(): void
    {
        parent::boot();

        $this->routes(function () {
            Route::prefix('api')
                ->middleware('api')
                ->namespace($this->namespace) // 名前空間を設定
                ->group(base_path('routes/api.php'));

            Route::middleware('web')
                ->namespace($this->namespace) // 名前空間を設定
                ->group(base_path('routes/web.php'));
        });
    }
}
