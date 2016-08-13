<?php

namespace App\Http\Middleware;

use Closure;
use App\Services;
use Mockery\CountValidator\Exception;

class MoremiAuthMiddleware
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
        if (!$request->has(config('settings.userId'))) {
            throw new \Exception("User ID must be provided");
        }

        $userId =customdecrypt($request->get(config('settings.userId')));
        if(is_null($userId)){
            throw new \Exception("Invalid User Id");
        }

        $service = new Services\UserService();

        if(!$service->isValid($userId)){
            throw new \Exception("Invalid User!");
        }

        return $next($request);
    }
}
