<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Students Array</title>
</head>
<body>
    <?php 
        $students = [
            "John" => "A",
            "Jane" => "B",
            "sam" => "C",
            "Alice" => "A"
        ];

        echo "<table border='1'>
        <tr>
            <th>Name</th>
            <th>Grade</th>
        </tr>";

    foreach ($students as $name => $grade) {
        echo    "<tr> 
                    <td>$name</td>
                    <td>$grade</td>
                <tr>";
    }

    echo "</table>";

    ?>
    <action="" method="POST">
</body>
</html>