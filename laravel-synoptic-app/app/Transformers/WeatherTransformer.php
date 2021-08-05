<?php

namespace App\Transformers;

use App\Services\WeatherService;

class WeatherTransformer
{
    public static function make($response) {
        return [
            'id' => (isset($response['id'])) ? $response['id'] : null,
            'name' => (isset($response['name'])) ? $response['name'] : null,
            'temp' => (isset($response['main']['temp']))
                ? (new WeatherService())->getConvertTemperatureToCelsius($response['main']['temp'])
                : null,
            'date' => date('Y-m-d H:i:s'),
        ];
    }
}
