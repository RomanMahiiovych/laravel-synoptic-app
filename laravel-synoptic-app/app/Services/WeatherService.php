<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;
use App\Transformers\WeatherTransformer;

class WeatherService
{
    const ZERO_OF_KELVIN_TEMPERATURE = 273.15;

    /**
     * @param $cities
     * @return array|\Illuminate\Http\JsonResponse|object
     */
    public function handleWeatherShowing($cities)
    {
        $weather = [];

        if (!$cities) {
            return [];
        }

        foreach ($cities as $city) {
            $response = $this->getResponseFromAPI($city);
            $weather[] = ($response) ? WeatherTransformer::make($response) : [];
        }

        return response()->json($weather)->setStatusCode(200);
    }

    /**
     * Get the weather data from API OpenWeatherMap
     *
     * @param $city
     * @return array|mixed
     */
    public function getResponseFromAPI($city)
    {
        try {
            return Http::get('https://api.openweathermap.org/data/2.5/weather', [
                'q' => $city . ",UA",
                'appid' => env('OPEN_WEATHER_API_KEY'),
            ])->json();
        } catch (\Exception $e) {
            return [];
        }
    }

    /**
     * Return the converted temperature from Kelvin to Celsium.
     *
     * @param $kelvinTemperature
     * @return int
     */
    public function getConvertTemperatureToCelsius($kelvinTemperature) : int
    {
        return (int) $kelvinTemperature - self::ZERO_OF_KELVIN_TEMPERATURE;
    }

}
