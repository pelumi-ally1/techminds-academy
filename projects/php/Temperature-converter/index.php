<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>vote</title>
</head>
<body>
    <?php

        function convertTemperature($temp, $from, $to) {
            if ($from == "celsius" && $to == "fahrenheit"){
                return ($temp * 9/5) + 32;
            }elseif ($from == "fahrenheit" && $to == "celsius") {
                return ($temp - 32) * 5/9;
            }
            return $temp; // No conversion needed if same unit
        }

        if ($_SERVER ["REQUEST_METHOD"] == "POST") {
           $temprature = $_POST['temperature'];
           $unit_from = $_POST['unit_from'];
           $unit_to = $_POST['unit_to'];

           $converted_temp = convertTemperature($temprature, $unit_from, $unit_to);
           echo "Converted temperature:" . $converted_temp;
        }
    ?>
    
    <form action="" method="POST">
        Enter temperature: <input type="number" name="temperature">
        Convert form:
            <select name="unit_from">
                <option value="celsius">Celcius</option>
                <option value="fahrenheit">Fahrenheit</option>
            </select><br>
            Convert to:
            <select name="unit_to">
                <option value="celsius">Celcius</option>
                <option value="fahrenheit">Fahrenheit</option>
            </select><br>
            <input type="submit" value="convert">
    </form>
</body>
</html>