<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use App\Models\TrustIp;

class StopRussianUser
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        $ip = TrustIp::where('ip', $request->ip())->first();
        if (!$ip) {
            TrustIp::insert([
                'ip' => $request->ip(),
                'user_agent' => $request->userAgent(),
                'visits' => 1,
                'trust' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        } else {
            $ip->increment('visits');
            $ip->user_agent = $request->userAgent();
            $ip->save();
        }
        return $next($request);
    }
}
