<?php

namespace App\Http\Middleware;

use Closure;

class StudentProfessorAuthMiddleware
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
      if ($request->session()->get('role') == 1 || $request->session()->get('role') == 2) {
         return $next($request);
      }
      if ($request->ajax() || $request->wantsJson()) {
         return response('Unauthorized.', 401);
      } else{
         return redirect()->route('login');
      }

   }
}
