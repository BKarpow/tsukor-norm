<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use App\Models\TrustIp;
use Illuminate\Support\Facades\Http;
use App\Events\RussianUserVisit;

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

    private function useHeaderIpGeolocation(Request $request, Closure $next) {
        $countryCode = $_SERVER["HTTP_CF_IPCOUNTRY"];
        if ($countryCode == "RU") {
            event(new RussianUserVisit($request->ip(), $request->userAgent(), strtotime(now())));
            die("<h1 align='center'>Рускій воєнний корабль - іді на хуй!</h1>");
        }
        return $next($request);
    }

    private function useServiceIpGeolocation(Request $request) {
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
                event(new RussianUserVisit($request->ip(), $request->userAgent(), strtotime(now())));
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
        if (isset($_SERVER["HTTP_CF_IPCOUNTRY"])) {
            return $this->useHeaderIpGeolocation($request, $next);
        } else {
            $this->useServiceIpGeolocation($request);
        }
        return $next($request);
    }
}
