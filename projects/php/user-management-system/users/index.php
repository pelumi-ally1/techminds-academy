<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <?php 
       include "../connect.php";
       $sql = "SELECT * FROM users";
       
       if($result->num_rows > 0) {
         while($row = $result->fecth_assooc()) {
            echo "Name; " . $row['name'] . " - Email: " . $row['email'] . "<br>";
         }                   
       }else {
        echo "0 results";
       }

       $conn->close();
    ?>
</body>
</html>