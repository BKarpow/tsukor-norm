<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use App\Models\TrustIp;
use Illuminate\Support\Facades\Http;

class StopRussianUser
{
    private function getIpInfo(string $ip)
    {
        $response = Http::get("https://api.ipgeolocation.io/ipgeo",[
            'apiKey' => env('API_KEY_IPGEOLOC'),
            'ip' => $ip,
            'fields' => 'country_code2,country_name',
        ]);
        return $response->json();
    }

    public function isTrustCountry(string $ip, array $trustCountries)
    {
        $inf = $this->getIpInfo($ip);
        return !(bool)in_array($inf['country_code2'], $trustCountries);
    }
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
            $trust = $this->isTrustCountry($request->ip(), TrustIp::$notTrustCountry);

            TrustIp::insert([
                'ip' => $request->ip(),
                'user_agent' => $request->userAgent(),
                'visits' => 1,
                'trust' => $trust,
                'created_at' => now(),
                'updated_at' => now(),

            ]);
            if (!$trust) {

                die("Stop russian war!");
            }
        } else {
            if (!$ip->trust) {

                die("Stop russian war!");
            }
            // $ip->increment('visits');
            $ip->user_agent = $request->userAgent();
            $ip->save();
        }
        return $next($request);
    }
}
