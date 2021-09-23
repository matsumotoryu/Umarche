<?php

namespace App\Http\Middleware;

use App\Providers\RouteServiceProvider;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RedirectIfAuthenticated
{
    private const GUARD_USER='users';
    private const GUARD_OWNER='owners';
    private const GUARD_ADMIN='admin';

    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @param  string|null  ...$guards
     * @return mixed
     */
    public function handle(Request $request, Closure $next, ...$guards)
    {
//         $guards = empty($guards) ? [null] : $guards;

//         foreach ($guards as $guard) {
//             if (Auth::guard($guard)->check()) {
//                 return redirect(RouteServiceProvider::HOME);
//             }
//         }
       if(Auth::guard(self::GUARD_USER)->check() && $request->routeIs('user.*')){
	       //Auth::guard()でアプリケーションの個別の部分での認証を管理できる
	       //guardメソッドに渡すガード名は、auth.php で設定しているガード名の一つである必要がある
	       //->check()現在のユーザーが認証済かを判定している
	       //routeIs()受信リクエストが名前付きルートに一致するかを判定する。

	       return redirect(RouteServiceProvider::HOME);
        }
        if(Auth::guard(self::GUARD_OWNER)->check() && $request->routeIs('owner.*')){
	       return redirect(RouteServiceProvider::OWNER_HOME);
        }
        if(Auth::guard(self::GUARD_ADMIN)->check() && $request->routeIs('admin.*')){
	       return redirect(RouteServiceProvider::ADMIN_HOME);
        }


        return $next($request);
    }
}
