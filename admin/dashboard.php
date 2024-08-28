<?php

include '../components/connect.php';

session_start();

$admin_id = $_SESSION['admin_id'];

if(!isset($admin_id)){
   header('location:admin_login.php');
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Dashboard</title>

   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">
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
    <div class="dashboard-breadcrumb mb-30">
        <h2>Dashboard</h2>
    </div>
    <div class="row g-4">
        <div class="col-md-3">
            <div class="panel mb-30">
                <div class="panel-body">
                    <h3>Welcome!</h3>
                    <p><?= $fetch_profile['name']; ?></p>
                    <a href="update_profile.php" class="btn btn-primary">Update Profile</a>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="panel mb-30">
                <div class="panel-body">
                    <?php
                        $total_pendings = 0;
                        $select_pendings = $conn->prepare("SELECT * FROM `orders` WHERE payment_status = ?");
                        $select_pendings->execute(['pending']);
                        if($select_pendings->rowCount() > 0){
                            while($fetch_pendings = $select_pendings->fetch(PDO::FETCH_ASSOC)){
                                $total_pendings += $fetch_pendings['total_price'];
                            }
                        }
                    ?>
                    <h3><span></span><?= $total_pendings; ?><span> USD </span></h3>
                    <p>Total pendings</p>
                    <a href="placed_orders.php" class="btn btn-primary">See Orders</a>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="panel mb-30">
                <div class="panel-body">
                    <?php
                        $total_completes = 0;
                        $select_completes = $conn->prepare("SELECT * FROM `orders` WHERE payment_status = ?");
                        $select_completes->execute(['completed']);
                        if($select_completes->rowCount() > 0){
                            while($fetch_completes = $select_completes->fetch(PDO::FETCH_ASSOC)){
                                $total_completes += $fetch_completes['total_price'];
                            }
                        }
                    ?>
<h3><span></span><?= $total_pendings; ?><span> USD </span></h3>                    <p>Completed orders</p>
                    <a href="placed_orders.php" class="btn btn-primary">See orders</a>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="panel mb-30">
                <div class="panel-body">
                    <?php
                        $select_orders = $conn->prepare("SELECT * FROM `orders`");
                        $select_orders->execute();
                        $number_of_orders = $select_orders->rowCount()
                    ?>
                    <h3><?= $number_of_orders; ?></h3>
                    <p>Orders Placed</p>
                    <a href="placed_orders.php" class="btn btn-primary">See orders</a>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="panel mb-30">
                <div class="panel-body">
                    <?php
                        $select_products = $conn->prepare("SELECT * FROM `products`");
                        $select_products->execute();
                        $number_of_products = $select_products->rowCount()
                    ?>
                    <h3><?= $number_of_products; ?></h3>
                    <p>Products added</p>
                    <a href="products.php" class="btn btn-primary">See products</a>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="panel mb-30">
                <div class="panel-body">
                    <?php
                        $select_products = $conn->prepare("SELECT * FROM `products`");
                        $select_products->execute();
                        $number_of_products = $select_products->rowCount()
                    ?>
                    <h3><?= $number_of_products; ?></h3>
                    <p>Products added</p>
                    <a href="add_products.php" class="btn btn-primary">Add products</a>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="panel mb-30">
                <div class="panel-body">
                    <?php
                        $select_users = $conn->prepare("SELECT * FROM `users`");
                        $select_users->execute();
                        $number_of_users = $select_users->rowCount()
                    ?>
                    <h3><?= $number_of_users; ?></h3>
                    <p>Normal users</p>
                    <a href="users_accounts.php" class="btn btn-primary">See Users</a>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="panel mb-30">
                <div class="panel-body">
                    <?php
                        $select_admins = $conn->prepare("SELECT * FROM `admins`");
                        $select_admins->execute();
                        $number_of_admins = $select_admins->rowCount()
                    ?>
                    <h3><?= $number_of_admins; ?></h3>
                    <p>Admin users</p>
                    <a href="admin_accounts.php" class="btn btn-primary">See admins</a>
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
