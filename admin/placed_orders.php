<?php

include '../components/connect.php';

session_start();

$admin_id = $_SESSION['admin_id'];

if(!isset($admin_id)){
   header('location:admin_login.php');
}

if(isset($_POST['update_payment'])){
   $order_id = $_POST['order_id'];
   $payment_status = $_POST['payment_status'];
   $payment_status = filter_var($payment_status, FILTER_SANITIZE_STRING);
   $update_payment = $conn->prepare("UPDATE `orders` SET payment_status = ? WHERE id = ?");
   $update_payment->execute([$payment_status, $order_id]);
   $message[] = 'payment status updated!';
}

if(isset($_GET['delete'])){
   $delete_id = $_GET['delete'];
   $delete_order = $conn->prepare("DELETE FROM `orders` WHERE id = ?");
   $delete_order->execute([$delete_id]);
   header('location:placed_orders.php');
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Placed Orders</title>

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
        <h2>Placed Orders</h2>
    </div>
    <div class="row g-4">
        <div class="rev-7-top-product">
            <div class="panel mb-30">
                <div class="panel-body">
                    <div class="table-responsive">
                        <table class="table table-striped table-bordered">
                            <thead>
                                <tr>
                                    <th>Order ID</th>
                                    <th>Placed On</th>
                                    <th>Name</th>
                                    <th>Number</th>
                                    <th>Address</th>
                                    <th>Total Products</th>
                                    <th>Total Price</th>
                                    <th>Payment Method</th>
                                    <th>Payment Status</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                    $select_orders = $conn->prepare("SELECT * FROM `orders`");
                                    $select_orders->execute();
                                    if($select_orders->rowCount() > 0){
                                        while($fetch_orders = $select_orders->fetch(PDO::FETCH_ASSOC)){
                                ?>
                                <tr>
                                    <td><?= $fetch_orders['id']; ?></td>
                                    <td><?= $fetch_orders['placed_on']; ?></td>
                                    <td><?= $fetch_orders['name']; ?></td>
                                    <td><?= $fetch_orders['number']; ?></td>
                                    <td><?= $fetch_orders['address']; ?></td>
                                    <td><?= $fetch_orders['total_products']; ?></td>
                                    <td><?= $fetch_orders['total_price']; ?> USD </td>
                                    <td><?= $fetch_orders['method']; ?></td>
                                    <td>
                                        <form action="" method="post">
                                            <input type="hidden" name="order_id" value="<?= $fetch_orders['id']; ?>">
                                            <select name="payment_status" class="form-select">
                                                <option selected disabled><?= $fetch_orders['payment_status']; ?></option>
                                                <option value="pending">Pending</option>
                                                <option value="completed">Completed</option>
                                            </select>
                                    </td>
                                    <td>
                                            <div class="btn-group">
                                                <input type="submit" value="Update" class="btn btn-primary" name="update_payment">
                                                <a href="placed_orders.php?delete=<?= $fetch_orders['id']; ?>" class="btn btn-danger" onclick="return confirm('Delete this order?');">Delete</a>
                                            </div>
                                        </form>
                                    </td>
                                </tr>
                                <?php
                                        }
                                    } else {
                                        echo '<tr><td colspan="10" class="text-center">No orders placed yet!</td></tr>';
                                    }
                                ?>
                            </tbody>
                        </table>
                    </div>
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
