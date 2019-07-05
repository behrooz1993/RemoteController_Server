<?php

namespace App\Http\Middleware;

use Closure;
use Config;
use App\Models\User;
use Carbon\Carbon;

class ThrottleLoginRequests
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
        $ttl = Config::get('auth.activation_ttl');
        if (Config::get('app.env') == 'production' AND $u = User::hasMeta('phone_number', $request->get('phone_number'))->first() AND Carbon::createFromTimestamp($u->meta->activation_ttl)->diffInSeconds() < $ttl)
            abort(429, 'You have to wait ' . ($ttl - Carbon::createFromTimestamp($u->meta->activation_ttl)->diffInSeconds()) . ' seconds before you can request for login again');
        return $next($request);
    }
}
