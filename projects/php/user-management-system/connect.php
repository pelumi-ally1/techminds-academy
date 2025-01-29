<?php 
  $servername = "localhost";
  $username = "root";
  $password = "";
  $dbname = "php_users";

  //create connection
  $conn = new mysqli($servername,$username,$password,$dbname);

  //check connection
  if ($conn->connect_error) {
    die("connetion failed: " . $conn->connect_error);
  }else {
    echo "Database ☑️";
  }
?>