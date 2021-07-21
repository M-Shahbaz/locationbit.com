<?php

namespace App\Domain\Bing\Service;

use App\Domain\Bing\Data\BingMapsGeocodingData;
use Psr\Log\LoggerInterface;

/**
 * Service.
 */
final class BingMapsGeocodingReader
{
    private $loggerInterface;

    public function __construct(LoggerInterface $loggerInterface)
    {
        $this->loggerInterface = $loggerInterface;
    }

    public function getBingMapsGeocodingByAddress(string $address): BingMapsGeocodingData
    {

        $bingMapsGeocodingData = new BingMapsGeocodingData();

        $keys = [
            $_ENV['BING_MAPS_API_KEY_1'],
            $_ENV['BING_MAPS_API_KEY_2'],
        ];
        $key = $keys[array_rand($keys)];

        $client = new \GuzzleHttp\Client();

        try {

            $url = BING_MAPS_API_URL . 'Locations?' . http_build_query(
                [
                    'q' => $address,
                    'o' => 'json',
                    'maxResults' => 1,
                    'key' => $key
                ]
            );

            $response = $client->request('GET', $url);

            $result = json_decode($response->getBody(), true);
            $geocodePoints = $result['resourceSets'][0]['resources'][0]['geocodePoints'][0]['coordinates'] ?? null;

            $bingMapsGeocodingData->lat = $geocodePoints[0] ?? null;
            $bingMapsGeocodingData->lon = $geocodePoints[1] ?? null;
            
        } catch (\Throwable $th) {
            if (APP_DEBUG_MODE) {
                $this->loggerInterface->error($th);
            }
        }

        return $bingMapsGeocodingData;
    }
}
