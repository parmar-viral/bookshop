<?php
 $servername="localhost";
 $username="root";
 $password="";

 $con=mysqli_connect($servername,$username,$password);
 if (!$con) {
    die("fail to connect".mysqli_connect_error());
 }
 $sql = "CREATE DATABASE bookshop";
if (mysqli_query($con, $sql)) {
  echo "Database created successfully";
} else {
  echo "Error creating database: " . mysqli_error($con);
}

mysqli_close($con);

?>