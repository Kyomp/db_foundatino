<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class CheckId
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $ID = Auth::user();
        if($ID->getIdentification()->get()->isEmpty()){
            if($ID->foreigner){
                return redirect('/foreigner');
            }
            else{
                return redirect('/citizen');
            }
            
        }
        return $next($request);
    }
}
