<?php
include 'connect.php';
if(isset($_GET['deleteid'])){
    $id=$_GET['deleteid'];
    $sql="delete from `products` where product_id=$id";
    $result=mysqli_query($conn,$sql);
    if($result){
       // echo "deleted successfully";
header ('location:product.php');
    }else{
        die(mysqli_error($conn));
    }
}
?>