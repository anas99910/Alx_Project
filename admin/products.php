<?php

include '../components/connect.php';

session_start();

$admin_id = $_SESSION['admin_id'];

if(!isset($admin_id)){
   header('location:admin_login.php');
};

if(isset($_POST['add_product'])){

   $name = $_POST['name'];
   $name = filter_var($name, FILTER_SANITIZE_STRING);
   $price = $_POST['price'];
   $price = filter_var($price, FILTER_SANITIZE_STRING);
   $details = $_POST['details'];
   $details = filter_var($details, FILTER_SANITIZE_STRING);

   $image_01 = $_FILES['image_01']['name'];
   $image_01 = filter_var($image_01, FILTER_SANITIZE_STRING);
   $image_size_01 = $_FILES['image_01']['size'];
   $image_tmp_name_01 = $_FILES['image_01']['tmp_name'];
   $image_folder_01 = '../uploaded_img/'.$image_01;

   $image_02 = $_FILES['image_02']['name'];
   $image_02 = filter_var($image_02, FILTER_SANITIZE_STRING);
   $image_size_02 = $_FILES['image_02']['size'];
   $image_tmp_name_02 = $_FILES['image_02']['tmp_name'];
   $image_folder_02 = '../uploaded_img/'.$image_02;

   $image_03 = $_FILES['image_03']['name'];
   $image_03 = filter_var($image_03, FILTER_SANITIZE_STRING);
   $image_size_03 = $_FILES['image_03']['size'];
   $image_tmp_name_03 = $_FILES['image_03']['tmp_name'];
   $image_folder_03 = '../uploaded_img/'.$image_03;

   $select_products = $conn->prepare("SELECT * FROM `products` WHERE name = ?");
   $select_products->execute([$name]);

   if($select_products->rowCount() > 0){
      $message[] = 'product name already exist!';
   }else{

      $insert_products = $conn->prepare("INSERT INTO `products`(name, details, price, image_01, image_02, image_03) VALUES(?,?,?,?,?,?)");
      $insert_products->execute([$name, $details, $price, $image_01, $image_02, $image_03]);

      if($insert_products){
         if($image_size_01 > 2000000 OR $image_size_02 > 2000000 OR $image_size_03 > 2000000){
            $message[] = 'image size is too large!';
         }else{
            move_uploaded_file($image_tmp_name_01, $image_folder_01);
            move_uploaded_file($image_tmp_name_02, $image_folder_02);
            move_uploaded_file($image_tmp_name_03, $image_folder_03);
            $message[] = 'new product added!';
         }

      }

   }  

};

if(isset($_GET['delete'])){

   $delete_id = $_GET['delete'];
   $delete_product_image = $conn->prepare("SELECT * FROM `products` WHERE id = ?");
   $delete_product_image->execute([$delete_id]);
   $fetch_delete_image = $delete_product_image->fetch(PDO::FETCH_ASSOC);
   unlink('../uploaded_img/'.$fetch_delete_image['image_01']);
   unlink('../uploaded_img/'.$fetch_delete_image['image_02']);
   unlink('../uploaded_img/'.$fetch_delete_image['image_03']);
   $delete_product = $conn->prepare("DELETE FROM `products` WHERE id = ?");
   $delete_product->execute([$delete_id]);
   $delete_cart = $conn->prepare("DELETE FROM `cart` WHERE pid = ?");
   $delete_cart->execute([$delete_id]);
   $delete_wishlist = $conn->prepare("DELETE FROM `wishlist` WHERE pid = ?");
   $delete_wishlist->execute([$delete_id]);
   header('location:products.php');
}


?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Products</title>

   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">

   <link rel="shortcut icon" href="favicon.png">
    <link rel="stylesheet" href="../dashboad/assets/vendor/css/all.min.css">
    <link rel="stylesheet" href="../dashboad/assets/vendor/css/OverlayScrollbars.min.css">
    <link rel="stylesheet" href="../dashboad/assets/vendor/css/jquery.uploader.css">
    <link rel="stylesheet" href="../dashboad/assets/vendor/css/select2.min.css">
    <link rel="stylesheet" href="../dashboad/assets/vendor/css/bootstrap-material-datetimepicker.css">
    <link rel="stylesheet" href="../dashboad/assets/vendor/css/material-icon.css">
    <link rel="stylesheet" href="../dashboad/assets/vendor/css/selectize.css">
    <link rel="stylesheet" href="../dashboad/assets/vendor/css/bootstrap.min.css">
    <link rel="stylesheet" href="../dashboad/assets/css/style.css">
    <link rel="stylesheet" id="primaryColor" href="../dashboad/assets/css/orange-color.css">
    <link rel="stylesheet" id="rtlStyle" href="#">
    <link rel="stylesheet" href="../css/admin_style.css">
   

</head>
<body>

<?php include '../components/admin_header.php'; ?>




<div class="main-content">
    <div class="row g-4">
        <div class="col-12">
            <div class="panel">
                <div class="panel-header">
                    <h5>Products Added.</h5>
                </div>
                <div class="panel-body">
                    <table class="table table-bordered table-hover">
                        <thead>
                            <tr>
                                <th>Image</th>
                                <th>Name</th>
                                <th>Price</th>
                                <th>Description</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                                $select_products = $conn->prepare("SELECT * FROM `products`");
                                $select_products->execute();
                                if($select_products->rowCount() > 0){
                                    while($fetch_products = $select_products->fetch(PDO::FETCH_ASSOC)){ 
                            ?>
                            <tr>
                                <td><img src="../uploaded_img/<?= $fetch_products['image_01']; ?>" alt="" style="width: 100px; height: auto;"></td>
                                <td><?= $fetch_products['name']; ?></td>
                                <td>Nrs.<?= $fetch_products['price']; ?>/-</td>
                                <td><?= $fetch_products['details']; ?></td>
                                <td>
                                    <a href="update_product.php?update=<?= $fetch_products['id']; ?>" class="btn btn-primary">Update</a>
                                    <a href="products.php?delete=<?= $fetch_products['id']; ?>" class="btn btn-danger" onclick="return confirm('Delete this product?');">Delete</a>
                                </td>
                            </tr>
                            <?php
                                    }
                                }else{
                                    echo '<tr><td colspan="5">No products added yet!</td></tr>';
                                }
                            ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>








<script src="../dashboad/assets/vendor/js/jquery.min.js"></script>
<script src="../dashboad/assets/vendor/js/bootstrap.bundle.min.js"></script>
<script src="../dashboad/assets/vendor/js/OverlayScrollbars.min.js"></script>
<script src="../dashboad/assets/vendor/js/select2.min.js"></script>
<script src="../dashboad/assets/vendor/js/jquery.uploader.js"></script>
<script src="../dashboad/assets/vendor/js/bootstrap-material-datetimepicker.js"></script>
<script src="../dashboad/assets/vendor/js/selectize.min.js"></script>
<script src="../dashboad/assets/js/main.js"></script>
<script src="../js/admin_script.js"></script>
   
</body>
</html>