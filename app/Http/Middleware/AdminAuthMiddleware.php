<?php

namespace App\Http\Middleware;

use Closure;

class AdminAuthMiddleware
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
      if ($request->session()->get('role') != 'Administrador') {
         if ($request->ajax() || $request->wantsJson()) {
            return response('Unauthorized.', 401);
         } else{
            return redirect()->route('home');
         }
      }
      return $next($request);
   }
}
