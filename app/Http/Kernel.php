<?php

namespace App\Http;

use Illuminate\Foundation\Http\Kernel as HttpKernel;

class Kernel extends HttpKernel
{
   /**
   * The application's global HTTP middleware stack.
   *
   * These middleware are run during every request to your application.
   *
   * @var array
   */
   protected $middleware = [
      \Illuminate\Foundation\Http\Middleware\CheckForMaintenanceMode::class,
   ];

   /**
   * The application's route middleware groups.
   *
   * @var array
   */
   protected $middlewareGroups = [
      'web' => [
         \App\Http\Middleware\EncryptCookies::class,
         \Illuminate\Cookie\Middleware\AddQueuedCookiesToResponse::class,
         \Illuminate\Session\Middleware\StartSession::class,
         \Illuminate\View\Middleware\ShareErrorsFromSession::class,
         \App\Http\Middleware\VerifyCsrfToken::class,
         \Illuminate\Routing\Middleware\SubstituteBindings::class,
      ],

      'api' => [
         'throttle:60,1',
         'bindings',
      ],


   ];

   /**
   * The application's route middleware.
   *
   * These middleware may be assigned to groups or used individually.
   *
   * @var array
   */
   protected $routeMiddleware = [
      'auth' => \App\Http\Middleware\Authenticate::class,
      'auth.basic' => \Illuminate\Auth\Middleware\AuthenticateWithBasicAuth::class,
      'can' => \Illuminate\Auth\Middleware\Authorize::class,
      'guest' => \App\Http\Middleware\RedirectIfAuthenticated::class,
      'throttle' => \Illuminate\Routing\Middleware\ThrottleRequests::class,
      'bindings' => \Illuminate\Routing\Middleware\SubstituteBindings::class,
      'auth.user' => \App\Http\Middleware\UserAuthMiddleware::class,
      'auth.admin' => \App\Http\Middleware\AdminAuthMiddleware::class,
      'auth.student' => \App\Http\Middleware\StudentMiddleware::class,
      'auth.professor' => \App\Http\Middleware\ProfessorMiddleware::class,
      'auth.profAdmin' => \App\Http\Middleware\ProfessorAdminAuthMiddleware::class,
      'auth.studentAdmin' => \App\Http\Middleware\StudentAdminAuthMiddleware::class,
      'auth.studentProf' => \App\Http\Middleware\StudentProfessorAuthMiddleware::class,
   ];
}
