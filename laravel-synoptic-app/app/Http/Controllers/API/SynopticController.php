<?php

namespace App\Http\Controllers\API;

use App\Http\Requests\WeatherRequest;
use App\Services\WeatherService;

class SynopticController extends Controller
{
    /**
     * Service property
     *
     * @var WeatherService
     */
    protected $weatherService;

    /**
     * Method Constructor
     *
     * @param WeatherService $weatherService
     */
    public function __construct(WeatherService $weatherService)
    {
        $this->weatherService = $weatherService;
    }

    /**
     *   @OA\Get(
     *      path="/weather",
     *      operationId="weatherData",
     *
     *      summary="Get a data about current weather",
     *      description="Get a data about current weather",
     *     @OA\Parameter(
     *          name="cities",
     *          description="Cities",
     *          required=false,
     *          in="query",
     *          @OA\Schema(
     *              schema="ArrayField",
     *              @OA\Property(property="city[]", type="array",
     *              @OA\Items(anyOf={@OA\Schema(type="string")})),
     *      ),
     *      ),
     *      @OA\Response(
     *          response=200,
     *          description="Successful operation",
     *       ),
     *      @OA\Response(
     *          response=401,
     *          description="Unauthenticated",
     *      ),
     *      @OA\Response(
     *          response=403,
     *          description="Forbidden"
     *      )
     *     )
     *
     *
     * Get a data about current weather
     *
     * @param WeatherRequest $request
     * @return array|int
     */
    public function index(WeatherRequest $request)
    {
        if ($request->has('city')) {
            $weather = $this->weatherService->handleWeatherShowing($request->input('city'));
        }
        if (!$weather) {
            return response()->json()->getStatusCode();
        }

        return $weather;
    }

}
