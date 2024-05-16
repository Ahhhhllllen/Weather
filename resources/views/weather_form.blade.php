<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Weather App</title>
    <!-- Font Awesome for icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <style>
        /* General styles */
        body {
            font-family: 'Arial', sans-serif;
            background: linear-gradient(to bottom, #87CEEB, #00BFFF); /* SkyBlue to DeepSkyBlue */
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
        }
        /* Weather app container */
        .weather-app {
            background: rgba(255, 255, 255, 0.80); /* 80% opacity white */
            padding: 30px;
            border-radius: 12px;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.2);
            width: 350px;
            text-align: center;
            transition: transform 0.3s ease;
        }
        /* Hover effect on weather app */
        .weather-app:hover {
            transform: scale(1.05);
        }
        /* Heading styles */
        .weather-app h1 {
            font-size: 28px;
            margin-bottom: 20px;
            color: #333; /* Dark gray */
        }
        /* Form styles */
        .weather-app form {
            margin-top: 20px;
        }
        /* Input styles */
        .weather-app input {
            width: calc(100% - 42px);
            padding: 12px;
            border: 2px solid #ccc; /* Light gray */
            border-radius: 8px;
            margin-bottom: 15px;
            font-size: 16px;
            transition: border 0.3s ease;
        }
        /* Input focus styles */
        .weather-app input:focus {
            border: 2px solid #007bff; /* Blue */
            outline: none;
        }
        /* Button styles */
        .weather-app button {
            padding: 12px 25px;
            border: none;
            background: #007bff; /* Blue */
            color: #fff; /* White */
            border-radius: 8px;
            cursor: pointer;
            font-size: 16px;
            transition: background 0.3s ease, transform 0.3s ease;
        }
        /* Button hover styles */
        .weather-app button:hover {
            background: #0056b3; /* Darker blue */
            transform: translateY(-2px);
        }
    </style>
</head>
<body>
    <!-- Weather app container -->
    <div class="weather-app">
        <!-- Heading -->
        <h1>Weather App</h1>
        <!-- Form -->
        <form action="{{ route('weather.get') }}" method="POST">
            @csrf
            <!-- Input field -->
            <input type="text" name="city" placeholder="Enter Location" required>
            <!-- Submit button -->
            <button type="submit">Get Weather</button>
        </form>
    </div>
</body>
</html>
