<?php

namespace App\Http\Middleware;

use App\Traits\AuthTrait;
use Closure;

class AdminAuthenticate
{
    use AuthTrait;
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @param  string|null  $guard
     * @return mixed
     */
    public function handle($request, Closure $next, $guard = null)
    {
       $this->authenticate();

       if(!$this->getProfile()){
           if ($request->ajax() || $request->wantsJson()) {
               return response('Unauthorized.', 401);
           } else {
               return redirect()->guest('/');
           }
       }

        return $next($request);
    }

    private function getProfile(){
        if($this->auth){
            if($this->activeProfile->role == \ProfileConstant::ADMIN_ROLE){
                return true;
            }else{
                return false;
            }
        }else{
            return false;
        }
    }
}
