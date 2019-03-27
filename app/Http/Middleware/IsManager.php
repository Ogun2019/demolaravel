<?php
namespace App\Http\Middleware;
use Closure;
class IsManager
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
        if(auth()->user()->isAdmin() or auth()->user()->type=='manager' or auth()->user()->type=='assistant') {
            return $next($request);
        }
        return redirect('home');
    }
}