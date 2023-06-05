<?php
$host = 'localhost';
$db_user = 'root';
$db_password = '';
$db_name = 'e_commerce';

$conn = new mysqli($host, $db_user, $db_password, $db_name);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>

<!-- // <!?php
// $con =new mysqli('localhost','root', '', 'prabal_tej_crud');

// if(!$con) {
//     die(mysqli_error($con));
//   }
  ?>
//  -->


// <!-- <!?php 

// $conn= new mysqli('localhost','root','','e_commerce')or die("Could not connect to mysql".mysqli_error($con)); -->
// -->