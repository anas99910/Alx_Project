<?php

include '../components/connect.php';

session_start();

$admin_id = $_SESSION['admin_id'];

if(!isset($admin_id)){
   header('location:admin_login.php');
}

if(isset($_POST['submit'])){

   $name = $_POST['name'];
   $name = filter_var($name, FILTER_SANITIZE_STRING);

   $update_profile_name = $conn->prepare("UPDATE `admins` SET name = ? WHERE id = ?");
   $update_profile_name->execute([$name, $admin_id]);

   $empty_pass = 'da39a3ee5e6b4b0d3255bfef95601890afd80709';
   $prev_pass = $_POST['prev_pass'];
   $old_pass = sha1($_POST['old_pass']);
   $old_pass = filter_var($old_pass, FILTER_SANITIZE_STRING);
   $new_pass = sha1($_POST['new_pass']);
   $new_pass = filter_var($new_pass, FILTER_SANITIZE_STRING);
   $confirm_pass = sha1($_POST['confirm_pass']);
   $confirm_pass = filter_var($confirm_pass, FILTER_SANITIZE_STRING);

   if($old_pass == $empty_pass){
      $message[] = 'please enter old password!';
   }elseif($old_pass != $prev_pass){
      $message[] = 'old password not matched!';
   }elseif($new_pass != $confirm_pass){
      $message[] = 'confirm password not matched!';
   }else{
      if($new_pass != $empty_pass){
         $update_admin_pass = $conn->prepare("UPDATE `admins` SET password = ? WHERE id = ?");
         $update_admin_pass->execute([$confirm_pass, $admin_id]);
         $message[] = 'password updated successfully!';
      }else{
         $message[] = 'please enter a new password!';
      }
   }
   
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Update Profile</title>

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
        <h2>Update Profile</h2>
    </div>
    <div class="row g-4">
        <div class="col-md-6 offset-md-3">
            <div class="panel mb-30">
                <div class="panel-body">
                    <form action="" method="post">
                        <h3 class="mb-4">Update Profile</h3>
                        <input type="hidden" name="prev_pass" value="<?= $fetch_profile['password']; ?>">
                        <div class="mb-3">
                            <label for="name" class="form-label">Username</label>
                            <input type="text" id="name" name="name" value="<?= $fetch_profile['name']; ?>" required placeholder="Enter your username" maxlength="20" class="form-control" oninput="this.value = this.value.replace(/\s/g, '')">
                        </div>
                        <div class="mb-3">
                            <label for="old_pass" class="form-label">Old Password</label>
                            <input type="password" id="old_pass" name="old_pass" placeholder="Enter old password" maxlength="20" class="form-control" oninput="this.value = this.value.replace(/\s/g, '')">
                        </div>
                        <div class="mb-3">
                            <label for="new_pass" class="form-label">New Password</label>
                            <input type="password" id="new_pass" name="new_pass" placeholder="Enter new password" maxlength="20" class="form-control" oninput="this.value = this.value.replace(/\s/g, '')">
                        </div>
                        <div class="mb-3">
                            <label for="confirm_pass" class="form-label">Confirm New Password</label>
                            <input type="password" id="confirm_pass" name="confirm_pass" placeholder="Confirm new password" maxlength="20" class="form-control" oninput="this.value = this.value.replace(/\s/g, '')">
                        </div>
                        <div class="mb-3 text-center">
                            <input type="submit" value="Update Now" class="btn btn-primary" name="submit">
                        </div>
                    </form>
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
