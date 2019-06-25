<?php

namespace Shahnewaz\Redprint\Http\Middleware;

use Closure;

class Redprint
{
    /**
     * The URIs that should be excluded from CSRF verification.
     *
     * @var array
     */
    protected $except = [
    ];

    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {

        $dotenv = new \Dotenv\Dotenv(base_path());
        $dotenv->load();

        if (getenv('APP_ENV', 'local') === 'REDPRINT'){
            return $next($request);
        }
        
        if (getenv('APP_ENV', 'local') === 'REDPRINT_DEMO'){
            return $next($request);
        }

        abort(404);
    }

}
