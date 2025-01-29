<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Distance Converter</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f9;
            color: #333;
            margin: 0;
            padding: 20px;
            text-align: center;
        }
        h1 {
            color: #4CAF50;
        }
        form {
            background: #fff;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            display: inline-block;
            max-width: 400px;
            width: 100%;
        }
        label {
            display: block;
            margin: 10px 0 5px;
            font-weight: bold;
        }
        input, select {
            width: calc(100% - 20px);
            padding: 10px;
            margin: 5px 0 15px;
            border: 1px solid #ccc;
            border-radius: 5px;
            font-size: 1em;
        }
        button {
            background-color: #4CAF50;
            color: white;
            padding: 10px 20px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            font-size: 1em;
        }
        button:hover {
            background-color: #45a049;
        }
        .result {
            margin-top: 20px;
            font-size: 1.2em;
            font-weight: bold;
        }
    </style>

<?php
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $distance = $_POST['distance'];
        $from_unit = $_POST['from_unit'];
        $to_unit = $_POST['to_unit'];

        function convert_distance($distance, $from, $to) {
            $conversion_rates = [
                "ft_to_m" => 0.3048,
                "ft_to_km" => 0.0003048,
                "m_to_ft" => 3.28084,
                "m_to_km" => 0.001,
                "km_to_ft" => 3280.84,
                "km_to_m" => 1000,
            ];

            $key = "{$from}_to_{$to}";

            if ($from === $to) {
                return $distance; // Same unit
            } elseif (isset($conversion_rates[$key])) {
                return $distance * $conversion_rates[$key];
            } else {
                return "Conversion not supported.";
            }
        }

        $result = convert_distance($distance, $from_unit, $to_unit);
        echo "<div class='result'>Result: $distance $from_unit is equal to $result $to_unit.</div>";
    }
?>

</head>
<body>
    <h1>Distance Converter</h1>
    <form method="POST">
        <label for="distance">Enter Distance:</label>
        <input type="number" name="distance" id="distance" required step="any">
        
        <label for="from_unit">From:</label>
        <select name="from_unit" id="from_unit">
            <option value="ft">Ft - Feet</option>
            <option value="m">M - Meters</option>
            <option value="km">KM - Kilometers</option>
        </select>
        
        <label for="to_unit">To:</label>
        <select name="to_unit" id="to_unit">
            <option value="ft">Ft - Feet</option>
            <option value="m">M - Meters</option>
            <option value="km">KM - Kilometers</option>
        </select>
        
        <button type="submit">Convert</button>
    </form>
</body>
</html>
