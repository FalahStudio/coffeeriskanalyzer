<?php

namespace App\Http\Middleware;

use App\Models\Auth\UserModel;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\View;
use Symfony\Component\HttpFoundation\Response;

class AdminMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next)
    {
        if (Auth::check()) {
            $user = UserModel::where('email', Auth::user()->email)->first();

            View::share('getAllUserDatas', $user);
        } else {
            $flash = [
                'title' => 'Gagal',
                'desc'  => 'Silahkan login terlebih dahulu!',
            ];

            return redirect(\route('login'))->with('error', $flash);
        }

        return $next($request);
        
    }

}
