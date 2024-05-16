<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Weather Report</title>
    <!-- Font Awesome for icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <style>
        /* General styles */
        body {
            font-family: Arial, sans-serif;
            background: {{ $gradient }};
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
        }
        /* Weather app container */
        .weather-app {
            background: rgba(255, 255, 255, 0.80); /* 80% opacity white */
            padding: 20px;
            border-radius: 12px;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.2);
            width: 100%;
            max-width: 400px;
            text-align: center;
            transition: transform 0.3s ease;
        }
        /* Hover effect on weather app */
        .weather-app:hover {
            transform: scale(1.05);
        }
        /* Heading and paragraph styles */
        .weather-app h1,
        .weather-app p {
            transition: color 0.3s ease;
        }
        /* Heading styles */
        .weather-app h1 {
            font-size: 24px;
            margin-bottom: 10px;
        }
        /* Paragraph styles */
        .weather-app p {
            margin: 5px 0;
        }
        /* Icon styles */
        .weather-app .icon {
            margin-top: 20px;
        }
        /* Button styles */
        .weather-app button {
            padding: 10px 20px;
            border: none;
            background: {{ $buttonColor }};
            color: #fff;
            border-radius: 4px;
            cursor: pointer;
            transition: background 0.3s ease;
            margin-top: 20px;
        }
        /* Button hover styles */
        .weather-app button:hover {
            background: {{ $buttonHoverColor }};
        }
        /* Forecast container styles */
        .forecast-container {
            margin-top: 20px;
            display: flex;
            overflow-x: auto;
            scroll-snap-type: x mandatory;
            padding: 10px;
            gap: 10px;
            transition: transform 0.3s ease;
        }
        /* Hover effect on forecast container */
        .forecast-container:hover {
            transform: scale(1.05);
        }
        /* Forecast item styles */
        .forecast-item {
            background: rgba(255, 255, 255, 0.80); /* 80% opacity white */
            padding: 15px;
            border-radius: 8px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
            min-width: 95%;
            flex: none;
            scroll-snap-align: center;
            text-align: center;
            transition: transform 0.3s ease;
        }
        /* Hover effect on forecast item */
        .forecast-item:hover {
            transform: scale(1.0);
        }
        .forecast-item p {
            margin: 5px 0;
        }
    </style>
</head>
<body>
    <!-- Weather app container -->
    <div class="weather-app">
        <!-- Heading -->
        <h1>Weather Report</h1>
        <!-- Results container -->
        <div class="results-container">
            <!-- Display current weather data if available -->
            @if ($weatherData)
                <p><strong>Location:</strong> {{ $weatherData['location']['name'] }}, {{ $weatherData['location']['country'] }}</p>
                <p><strong>Time:</strong> {{ $weatherData['location']['localtime'] }}</p>
                <p><strong>Temperature:</strong> {{ $weatherData['current']['temp_c'] }} °C</p>
                <p><strong>UV Index:</strong> {{ $weatherData['current']['uv'] }}</p>
                <p><strong>Wind Speed:</strong> {{ $weatherData['current']['wind_kph'] }} kph</p>
                <p><strong>Condition:</strong> {{ $weatherData['current']['condition']['text'] }}</p>
                <!-- Display weather icon -->
                <div class="icon">
                    <img src="{{ 'https:' . $weatherData['current']['condition']['icon'] }}" alt="weather icon">
                </div>
                <!-- Display forecast for the next 5 days -->
                <div class="forecast-container">
                    @foreach ($weatherData['forecast']['forecastday'] as $forecast)
                        <div class="forecast-item">
                            <p><strong>Date:</strong> {{ $forecast['date'] }} ({{ \Carbon\Carbon::parse($forecast['date'])->format('l') }})</p>
                            <p><strong>Condition:</strong> {{ $forecast['day']['condition']['text'] }}</p>
                            <p><strong>Temperature:</strong> {{ $forecast['day']['avgtemp_c'] }} °C</p>
                            <p><strong>UV Index:</strong> {{ $forecast['day']['uv'] }}</p>
                            <p><strong>Wind Speed:</strong> {{ $forecast['day']['maxwind_kph'] }} kph</p>
                            <div class="icon">
                                <img src="{{ 'https:' . $forecast['day']['condition']['icon'] }}" alt="weather icon">
                            </div>
                        </div>
                    @endforeach
                </div>
            <!-- Display error message if there's an error -->
            @elseif ($error)
                <p>{{ $error }}</p>
            @endif
        </div>
        <!-- Link to weather form -->
        <a href="{{ route('weather.form') }}">
            <!-- Back button -->
            <button>Back</button>
        </a>
    </div>
</body>
</html>
