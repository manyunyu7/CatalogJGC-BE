<?php

namespace App\Http\Middleware;

use App\Models\MyBasicIdentity;
use Closure;
use Illuminate\Http\Request;

class AddCompanyProfileMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle($request, Closure $next)
    {
        $response = $next($request);

        // Fetch the profile data
        $bsbProfile = MyBasicIdentity::all()->first();
        view()->share('data', [1, 2, 3]);
        return $response;
    }

}
