<?php
namespace App\Http\Middleware;
use Closure;
class IsPweb
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
        if(auth()->user()->isAdmin() or auth()->user()->type=='web') {
            return $next($request);
        }
        return redirect('home');
    }
}