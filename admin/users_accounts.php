<?php

include '../components/connect.php';

session_start();

$admin_id = $_SESSION['admin_id'];

if(!isset($admin_id)){
   header('location:admin_login.php');
}

if(isset($_GET['delete'])){
   $delete_id = $_GET['delete'];
   $delete_user = $conn->prepare("DELETE FROM `users` WHERE id = ?");
   $delete_user->execute([$delete_id]);
   $delete_orders = $conn->prepare("DELETE FROM `orders` WHERE user_id = ?");
   $delete_orders->execute([$delete_id]);
   $delete_messages = $conn->prepare("DELETE FROM `messages` WHERE user_id = ?");
   $delete_messages->execute([$delete_id]);
   $delete_cart = $conn->prepare("DELETE FROM `cart` WHERE user_id = ?");
   $delete_cart->execute([$delete_id]);
   $delete_wishlist = $conn->prepare("DELETE FROM `wishlist` WHERE user_id = ?");
   $delete_wishlist->execute([$delete_id]);
   header('location:users_accounts.php');
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Users accounts</title>

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
                    <h5>User accounts</h5>
                </div>
                <div class="panel-body">
                    <table class="table table-bordered table-hover">
                        <thead>
                            <tr>
                                <th>User id</th>
                                <th>Username</th>
                                <th>Email</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                                $select_accounts = $conn->prepare("SELECT * FROM `users`");
                                $select_accounts->execute();
                                if($select_accounts->rowCount() > 0){
                                    while($fetch_accounts = $select_accounts->fetch(PDO::FETCH_ASSOC)){   
                            ?>
                            <tr>
                                <td><?= $fetch_accounts['id']; ?></td>
                                <td><?= $fetch_accounts['name']; ?></td>
                                <td><?= $fetch_accounts['email']; ?></td>
                                <td>
                                    <a href="users_accounts.php?delete=<?= $fetch_accounts['id']; ?>" class="btn btn-danger" onclick="return confirm('Delete this account? The user-related information will also be deleted!')">Delete</a>
                                </td>
                            </tr>
                            <?php
                                    }
                                }else{
                                    echo '<tr><td colspan="4">No accounts available!</td></tr>';
                                }
                            ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>













<script src="../js/admin_script.js"></script>
   
</body>
</html>