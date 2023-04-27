<?

namespace App\Lib;
use Illuminate\Support\Facades\Http;

trait CheckGeoIp {

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

}
