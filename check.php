<?php
session_start();
include 'connect.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = $_POST['email'];
    $password = $_POST['password'];
    $query = "INSERT INTO admins_tb (email, password) VALUES ('$email', '$password')";
    
    if (mysqli_query($connection, $query)) {
        $_SESSION['email'] = $email;
        $_SESSION['username'] = $_POST['username']; 
        $_SESSION['password'] = $password;
        header("Location: index.php");
        exit();
    } else {
        echo "Error: " . mysqli_error($connection);
    }
}
?>


<?php
$i = 1;
$cats = $conn->query("SELECT * FROM category_ ORDER BY id ASC");

if ($cats && $cats->num_rows > 0) {
    while ($row = mysqli_fetch_assoc($cats)) {
        ?>
        <tr>
            <td class="text-center"><?php echo $i++; ?></td>
            <td class=""><?php echo $row['name']; ?></td>
            <td class="text-center">
                <button class="btn btn-sm btn-primary edit_cat" type="button" data-id="<?php echo $row['id']; ?>" data-name="<?php echo $row['name']; ?>">Edit</button>
                <button class="btn btn-sm btn-danger delete_cat" type="button" data-id="<?php echo $row['id']; ?>">Delete</button>
            </td>
        </tr>
        <?php
    }
} else {
    echo "No categories found.";
}
?>

<?php
include 'connect.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = $_POST['name'];
    
    // Perform any necessary validation or sanitization checks
    
    // Insert the name into the database table
    $query = "INSERT INTO category_ (name) VALUES ('$name')";
    if (mysqli_query($conn, $query)) {
        // Name added successfully, redirect to the desired URL
        header("Location: category.php");
        exit();
    } else {
        echo "Error: " . mysqli_error($conn);
    }
}

$i = 1;
$cats = $conn->query("SELECT * FROM category_ ORDER BY id ASC");

if ($cats && $cats->num_rows > 0) {
    while ($row = mysqli_fetch_assoc($cats)) {
        ?>
        <tr>
            <td class="text-center"><?php echo $i++; ?></td>
            <td class=""><?php echo $row['name']; ?></td>
            <td class="text-center">
                <button class="btn btn-sm btn-primary edit_cat" type="button" data-id="<?php echo $row['id']; ?>" data-name="<?php echo $row['name']; ?>">Edit</button>
                <button class="btn btn-sm btn-danger delete_cat" type="button" data-id="<?php echo $row['id']; ?>">Delete</button>
            </td>
        </tr>
        <?php
    }
} else {
    echo "No categories found.";
}
?>




include 'connect.php';
if(isset($_POST['submit'])){
    $name = $_POST['fname'];
    $sql = "SELECT name FROM categories WHERE name='$name'";
    $result = mysqli_query($conn, $sql);
    if(mysqli_num_rows($result) > 0){
        // Name already exists
        header('location: display-copy.php');
        exit;
    } else {
        $sql = "INSERT INTO `categories` (name) VALUES ('$name')";
        $result = mysqli_query($conn, $sql);
        if($result){
            header('location: display-copy.php');
            exit;
        } else {
            die(mysqli_error($conn));
        }
    }
}
<div class="row">
  <div class="col-md-3">
    <div class="white_card position-relative mb_20">
    <form method="POST" action="">
            <div class="form-group">
                <label>category name</label>
                <input type="text" class="form-control" placeholder="" name="fname" autocomplete="off">

            </div><br>
           

            <!-- Display the error message if there are any -->
            <?php if(!empty($error)){ ?>
                <div class="alert alert-danger" role="alert" align="center">
                    <?php echo $error; ?>
                </div>
            <?php } ?>

            <button type="submit" class="btn btn-primary" name="submit">Submit</button>
            </form>

      </div>
    </div>
  </div>
</div>



<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css"
    >

    <title>Crud operation</title>
  </head>
  <body>
<div class="container my-5">

<form method="POST" action="update.php">
            <div class="form-group">
                <label>Name</label>
                <input type="hidden" class="form-control" placeholder="Enter your name" name="id" autocomplete="off" value="<?php echo $data[0]['id'];?>">
                <input type="text" class="form-control" placeholder="Enter your name" name="fname" autocomplete="off" value="<?php echo $data[0]['name'];?>">

            </div>
            


            <button type="submit" class="btn btn-primary" name="submit">Submit</button>
        </form>
</div>

  </body>
</html>



<?php
include 'connect.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $product_id = $_POST['product_id'];
    $product_name = $_POST['product_name'];
    $price = $_POST['price'];
    $description = $_POST['description'];
    $category_id = $_POST['category_id'];

    // Check if a new image file is uploaded
    if ($_FILES["image"]["name"]) {
        $image = $_FILES["image"]["name"];
        $tempname = $_FILES["image"]["tmp_name"];
        $dir = "img/" . basename($image);
        move_uploaded_file($tempname, $dir);

        $query = "UPDATE products 
                  SET product_name = '$product_name', price = '$price', description = '$description', category_id = '$category_id', image_url = '$image'
                  WHERE product_id = '$product_id'";
    } else {
        $query = "UPDATE products 
                  SET product_name = '$product_name', price = '$price', description = '$description', category_id = '$category_id'
                  WHERE product_id = '$product_id'";
    }

    if (mysqli_query($conn, $query)) {
        header("Location: index.php");
        exit; // Important: Exit the script after the redirect
    } else {
        echo "Error: " . mysqli_error($conn);
    }
}

// Check if product ID is provided in the URL
if (isset($_GET['id'])) {
    $product_id = $_GET['id'];
    // Retrieve the product data from the database
    $result = $conn->query("SELECT * FROM products WHERE product_id = '$product_id'");
    $product = $result->fetch_assoc();

    // Retrieve all categories from the database
    $categories = $conn->query("SELECT * FROM categories ORDER BY name ASC");
} else {
    // Redirect to index.php if product ID is not provided
    header("Location: index.php");
    exit;
}
?>

<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="position-relative mb_20">
                <h2>Update Product</h2>
                <form method="post" enctype="multipart/form-data">
                    <input type="hidden" name="product_id" value="<?php echo $product['product_id']; ?>">

                    <div class="form-group">
                        <label for="product_name">Product Name:</label>
                        <input type="text" class="form-control" id="product_name" name="product_name" value="<?php echo $product['product_name']; ?>" required>
                    </div>

                    <div class="form-group">
                        <label for="price">Price:</label>
                        <input type="number" class="form-control" id="price" name="price" value="<?php echo $product['price']; ?>" required>
                    </div>

                    <div class="form-group">
                        <label for="description">Description:</label>
                        <textarea class="form-control" id="description" name="description" rows="4" required><?php echo $product['description']; ?></textarea>
                    </div>

                    <div class="form-group">
                        <label for="category_id">Category:</label>
                        <select class="form-control" id="category_id" name="category_id" required>
                            <?php while ($row = $categories->fetch_assoc()) { ?>
                                <option value="<?php echo $row['category_id']; ?>" <?php if ($row['category_id'] == $product['category_id']) echo 'selected'; ?>>
                                    <?php echo $row['                                    name']; ?>
                                </option>
                            <?php } ?>
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="image">Image:</label>
                        <input type="file" class="form-control-file" id="image" name="image">
                    </div>

                    <div class="form-group">
                        <label for="current_image">Current Image:</label>
                        <br>
                        <?php if ($product['image_url']) { ?>
                            <img src="img/<?php echo $product['image_url']; ?>" alt="Current Image" width="150">
                        <?php } else { ?>
                            <p>No image available.</p>
                        <?php } ?>
                    </div>

                    <button type="submit" class="btn btn-primary">Update</button>
                    <a href="index.php" class="btn btn-secondary">Cancel</a>
                </form>
            </div>
        </div>
    </div>
</div>

