<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
<?php

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $color = $_POST['color'];
        $make = $_POST['make'];
        $model = $_POST['model'];
    }
    // Parent class
    class Vehicle {
        public $color;

        public function __construct($color) {
            $this->color = $color;
        }

        public function displayColor() {
            echo "This vehicle is " . $this->color . "<br>";
        }   
    }

    // Child class
    class Car extends Vehicle {
        public $make;
        public $model;

        public function __construct($color, $make, $model) {
            parent::__construct($color); // Call parent constructor
            $this->make = $make;
            $this->model = $model;
        }

        // Method overriding
        public function displayInfo() {
            echo "Car: " . $this->make . " " . $this->model . " - Color: " . $this->color . "<br>";
        }
    }

    // Instantiate a Car object
    $myCar = new Car("Red", "Honda", "Civic");
    $myCar->displayColor(); // From parent class
    $myCar->displayInfo(); // Overridden method from child class
?>

<form method="POST">
    <label for="car color">car color</label>
    <input type="text" name="color"><br><br>

    <label for="car make">car make</label>
    <input type="text" name="make"><br>

    <label for="car model">car model</label>
    <input type="text" name="model"><br><br>

    <input type="submit" value="check Car">
</form>
</body>
</html>