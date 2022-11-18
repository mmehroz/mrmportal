<?php

namespace App\Http\Middleware;

use Closure;
use App\User;

class CheckUserStatus
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $user_status = User::where('email',$request->email)->pluck('status')->first();
        if(isset($user_status) && $user_status == 0){
            abort('403');
        }
        return $next($request);
    }
}
