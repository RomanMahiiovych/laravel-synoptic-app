<?php

namespace Tests\Feature;

use Illuminate\Support\Facades\Http;
use Tests\TestCase;

class WeatherTest extends TestCase
{
    /**
     * A basic test example.
     *
     * @return void
     */
    public function test_api_status_code()
    {
        $response = $this->get('/api/weather?city[]=KYIV&city[]=LVIV');
        $response->assertOk();
    }

    public function test_fragment_weather_API()
    {
        $response = Http::get('https://api.openweathermap.org/data/2.5/weather', [
            'q' => 'Kyiv' . ",UA",
            'appid' => env('OPEN_WEATHER_API_KEY'),
        ])->json();

        $this->assertEquals($response['name'], 'Kyiv');
    }
}
