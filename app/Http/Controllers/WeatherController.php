<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class WeatherController extends Controller
{
    public function showForm()
    {
        return view('weather_form');
    }

    public function getWeather(Request $request)
    {
        $apiKey = env('WEATHER_API_KEY');
        $city = $request->input('city');
        $response = Http::get("http://api.weatherapi.com/v1/forecast.json?key={$apiKey}&q={$city}&days=6");
        
        if ($response->successful()) {
            $weatherData = $response->json();
            $condition = strtolower($weatherData['current']['condition']['text']);

            [$gradient, $buttonColor, $buttonHoverColor] = $this->getStylesForCondition($condition);

            return view('weather_result', [
                'weatherData' => $weatherData,
                'gradient' => $gradient,
                'buttonColor' => $buttonColor,
                'buttonHoverColor' => $buttonHoverColor,
                'error' => null,
            ]);
        } else {
            return view('weather_result', [
                'weatherData' => null,
                'gradient' => 'linear-gradient(to bottom, gray, darkgray)', // Default gradient for error
                'buttonColor' => '#333',
                'buttonHoverColor' => '#555',
                'error' => 'Unable to fetch weather data. Please try again.',
            ]);
        }
    }

    private function getStylesForCondition($condition)
    {
        switch ($condition) {
            case 'sunny':
            case 'clear':
                return ['linear-gradient(to bottom, #FFD700, #FFA500)', '#FFA500', '#FF8C00'];
            case 'partly cloudy':
            case 'cloudy':
                return ['linear-gradient(to bottom, #B0C4DE, #778899)', '#778899', '#6A5ACD'];
            case 'rain':
            case 'rainy':
            case 'showers':
                return ['linear-gradient(to bottom, #00BFFF, #1E90FF)', '#1E90FF', '#1C86EE'];
            case 'thunderstorm':
                return ['linear-gradient(to bottom, #2F4F4F, #696969)', '#696969', '#808080'];
            case 'snow':
            case 'snowy':
                return ['linear-gradient(to bottom, #ADD8E6, #F0FFFF)', '#F0FFFF', '#E0FFFF'];
            default:
                return ['linear-gradient(to bottom, #87CEEB, #00BFFF)', '#00BFFF', '#1E90FF']; // Default gradient
        }
    }
}
