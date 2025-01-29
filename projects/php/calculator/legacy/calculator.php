<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $num1 = $_POST['num1'];
    $num2 = $_POST['num2'];
    $operation = $_POST['operation'];

    if ($operation == "add") {
        $result = $num1 + $num2;
    } elseif ($operation == "subtract") {
        $result = $num1 - $num2;
    } elseif ($operation == "multiply") {
        $result = $num1 * $num2;
    } elseif ($operation == "divide") {
        if ($num2 != 0) {
           $result = $num1 / $num2;
        } else {
           $result = "cannot divide by zero";
        }
    } elseif ($operation == "percentage") {
        $result = ($num1 /100) * $num2;
    }
    echo "Result: " . $result;
}
?>