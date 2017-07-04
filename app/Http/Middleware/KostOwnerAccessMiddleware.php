<?php

namespace App\Http\Middleware;

use Closure;
use Help;
use Session;

class KostOwnerAccessMiddleware
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
        if (Help::grant()) {
          return $next($request);
        }else{
          Session::flash('alert','Anda tidak bisa mengakses beberapa menu sebelum melakukan pembayaran');
          return redirect(Help::url('dashboard'));
        }
    }
}
