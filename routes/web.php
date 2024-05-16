<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\WeatherController;

Route::get('/', [WeatherController::class, 'showForm'])->name('weather.form');
Route::post('/weather', [WeatherController::class, 'getWeather'])->name('weather.get');
Route::get('/weather', [WeatherController::class, 'showWeather'])->name('weather.show');
