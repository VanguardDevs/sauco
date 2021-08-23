<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Contracts\Auth\Guard;

class Role 
{
    /**
     * @var Illuminate\Contracts\Auth\Guard
     */
    protected $auth;

    /**
     * Create a new UserHasPermission instance.
     *
     * @param Guard $auth
     */
    public function __construct(Guard $auth)
    {
        $this->auth = $auth;
    }

    /**
     * Run the request filter.
     *
     * @param \Illuminate\Http\Request $request
     * @param \Closure                 $closure
     * @param string                   $role
     *
     * @return mixed
     */
    public function handle($request, Closure $next, $role)
    {
        $roles = explode("|", $role);
        
        foreach($roles as $role) {
            if ($this->auth->user()->hasRole($role)) {
                return $next($request);
            } 
        }
        
        if ($request->ajax()) {
            return response('Unauthorized.', 401);
        }

        return abort(401);
    }
}
