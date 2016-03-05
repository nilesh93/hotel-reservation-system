<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class QualifiedUserMiddleware
{
    private $blockMessage = 'This account lacks permission to enter the Admin section.';

    /**
     * Restrict Admin section to Customer accounts.
     *
     * @param $request
     * @param Closure $next
     * @return \Illuminate\Http\RedirectResponse
     */
    public function handle($request, Closure $next)
    {
        if(Auth::user()->role != 'admin') {
            return redirect('/')->with('noAccess', $this->blockMessage);
        }
        else {
            return $next($request);
        }
    }
}
