<?php

namespace App\Http\Middleware;

use Closure;
use Auth;

class isAdmin
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
        if (!Auth::check()) {
		    return redirect('/kirjaudu');
	    }
    	if($request->user()->role != "admin"){
		    abort(403, 'You do not have permission to perform this action.');
	    }

        return $next($request);
    }
}
