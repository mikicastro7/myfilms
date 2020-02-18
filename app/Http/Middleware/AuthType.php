<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class AuthType
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
        if(Auth::user()->type > 1){
            $notification = array(
                'message' => 'No permission for this action',
                'alert-type' => 'error'
            );

            return response()->json([
                'notification' => $notification,
            ]);
        }

        return $next($request);
    }
}
