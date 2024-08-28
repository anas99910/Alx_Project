<?php

include '../components/connect.php';

session_start();

if(isset($_POST['submit'])){

   $name = $_POST['name'];
   $name = filter_var($name, FILTER_SANITIZE_STRING);
   $pass = sha1($_POST['pass']);
   $pass = filter_var($pass, FILTER_SANITIZE_STRING);

   $select_admin = $conn->prepare("SELECT * FROM `admins` WHERE name = ? AND password = ?");
   $select_admin->execute([$name, $pass]);
   $row = $select_admin->fetch(PDO::FETCH_ASSOC);

   if($select_admin->rowCount() > 0){
      $_SESSION['admin_id'] = $row['id'];
      header('location:dashboard.php');
   }else{
      $message[] = 'incorrect username or password!';
   }

}

?>
<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Login</title>

   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">

   <!-- Add your CSS here -->
   <style>
      /* Add the CSS for the .register class here */
      .register {
         padding-top: 120px;
         padding-bottom: 120px;
      }
      .login-area {
         background-color: #f9f9f9;
         padding: 20px;
         border-radius: 10px;
         box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
      }
      /* Centering the form horizontally */
      .register {
         display: flex;
         justify-content: center;
      }
      .login-area form {
         max-width: 400px; /* Adjust as needed */
         width: 100%;
      }
   </style>

   <link rel="icon" type="image/x-icon" href="favicon.png">
    <link rel="stylesheet" href="../assets/vendor/css/all.min.css">
    <link rel="stylesheet" href="../assets/vendor/flaticon/flaticon.css">
    <link rel="stylesheet" href="../assets/vendor/css/nice-select.css">
    <link rel="stylesheet" href="../assets/vendor/css/flags.css">
    <link rel="stylesheet" href="../assets/vendor/css/slick.css">
    <link rel="stylesheet" href="../assets/vendor/css/bootstrap.min.css">
    <link rel="stylesheet" href="../assets/vendor/css/meanmenu.css">
    <link rel="stylesheet" href="../assets/vendor/css/modal-video.min.css">
    <link rel="stylesheet" href="../assets/css/style.css">
 

</head>
<body>

<?php
   if(isset($message)){
      foreach($message as $message){
         echo '
         <div class="message">
            <span>'.$message.'</span>
            <i class="fas fa-times" onclick="this.parentElement.remove();"></i>
         </div>
         ';
      }
   }
?>

<div class="register py-120">
    <div class="row justify-content-around">
        <div>
            <div class="login-area">
                <h2>Admin Login</h2>
                <form class="login-form" action="" method="post">
                    <input type="text" name="name" placeholder="Username">
                    <input type="password" name="pass" placeholder="Enter Password">
                    <button class="def-btn btn-border" type="submit" name="submit">Login</button>
                </form>
            </div>
        </div>
    </div>
</div>
   
</body>
</html>









