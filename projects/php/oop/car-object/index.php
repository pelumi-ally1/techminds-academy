<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
<form method="POST">
    <input type="text" name="color" placeholder="car color"><br><br>

    <input type="text" name="make" placeholder="car make"><br><br>

    <input type="text" name="model" placeholder="car model"><br><br>

    <input type="submit" value="check Car">
</form><br>
<?php
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

    
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $color = $_POST['color'];
        $make = $_POST['make'];
        $model = $_POST['model'];

        // Instantiate a Car object
        $myCar = new Car($color, $make, $model);
        $myCar->displayColor(); // From parent class
        $myCar->displayInfo(); // Overridden method from child class
    }
?>
</body>
</html>