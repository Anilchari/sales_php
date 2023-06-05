<?php
include 'connect.php';
$data = $conn->query("SELECT * FROM `categories`");
$allData = $data->fetch_all(MYSQLI_ASSOC);
// echo "<pre>";
// print_r($allData);
// die();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>crud operation</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css"
    >
</head>
<body>
    <div class="container">
        <button class="btn btn-primary my-5"><a href="category.php" class="text-light">Add category</a>
</button>
<table class="table">
  <thead>
    <tr>
      <th scope="col">Id</th>
      <th scope="col">Name</th>
      <th scope="col">action</th>
      
    </tr>
  </thead>
  <tbody>
    <?php foreach($allData as $dataVal){ ?>
      <tr>
        <th scope="row"><?php echo $dataVal['id'] ;?></th>
        <td><?= $dataVal['name'] ;?></td>
       
        <td><button class="btn btn-primary mr-2"><a href="update.php?id=<?php echo $dataVal['id'] ;?>" class="text-light">Update</a></button><button class="btn btn-danger"><a href="delete.php?deleteid=<?php echo $dataVal['id'] ;?>" class="text-light">Delete</a></button></td>
        <td></td>
      </tr>
    <?php } ?>
  </tbody>
</table>           
</div>
</body>
</html>