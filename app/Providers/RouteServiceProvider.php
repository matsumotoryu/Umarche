<?php

namespace App\Providers;

use Illuminate\Cache\RateLimiting\Limit;
use Illuminate\Foundation\Support\Providers\RouteServiceProvider as ServiceProvider;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Support\Facades\Route;

class RouteServiceProvider extends ServiceProvider
{
    /**
     * The path to the "home" route for your application.
     *
     * This is used by Laravel authentication to redirect users after login.
     *
     * @var string
     */
    public const HOME = '/dashboard';
    public const ADMIN_HOME = '/admin/dashboard';
    public const OWNER_HOME = '/owner/dashboard';
    //ログイン後のリダイレクト先
    //RedirectlfAutheniticated.phpで使うことになる。

    /**
     * The controller namespace for the application.
     *
     * When present, controller route declarations will automatically be prefixed with this namespace.
     *
     * @var string|null
     */
    // protected $namespace = 'App\\Http\\Controllers';

    /**
     * Define your route model bindings, pattern filters, etc.
     *
     * @return void
     */
    public function boot()
    {
        $this->configureRateLimiting();

        $this->routes(function () {
            Route::prefix('api')
                ->middleware('api')//jsで書く際に使用、今回は関係ない。
                ->namespace($this->namespace)
                ->group(base_path('routes/api.php'));//これはデフォルト
          //以下3つを使う
	//middlewareをグループ内のすべてのルートに割り当てるには、groupを定義する前にmiddlewareを使う
            Route::prefix('/')
	      ->as('user.')//コードを後ほど書く際user.と書くため。スタンバイする。
	      ->middleware('web')
                ->namespace($this->namespace)
                ->group(base_path('routes/web.php'));
	//base_pathはプロジェクトルートの完全パスを返す。

	  Route::prefix('owner')
	      ->as('owner.')
	      ->middleware('web')
                ->namespace($this->namespace)
                ->group(base_path('routes/owner.php'));
	      //prefix('owner')でowner.phpの頭にすべてownerがつくことになる。

	  Route::prefix('admin')
	      ->as('admin.')
	      ->middleware('web')
                ->namespace($this->namespace)
                ->group(base_path('routes/admin.php'));
        });
    }

    /**
     * Configure the rate limiters for the application.
     *
     * @return void
     */
    protected function configureRateLimiting()
    {
        RateLimiter::for('api', function (Request $request) {
            return Limit::perMinute(60)->by(optional($request->user())->id ?: $request->ip());
        });
    }
}
