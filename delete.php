<?php
include 'connect.php';
if(isset($_GET['deleteid'])){
    $id=$_GET['deleteid'];
    $sql="delete from `categories` where id=$id";
    $result=mysqli_query($conn,$sql);
    if($result){
       // echo "deleted successfully";

       header ('location:category.php');
    }else{
        die(mysqli_error($conn));
    }
}
?>