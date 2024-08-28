<?php
include 'components/connect.php';

session_start();

if(isset($_SESSION['user_id'])){
   $user_id = $_SESSION['user_id'];
}else{
   $user_id = '';
};

if(isset($_POST['submit'])){

   $email = $_POST['email'];
   $email = filter_var($email, FILTER_SANITIZE_STRING);
   $pass = sha1($_POST['pass']);
   $pass = filter_var($pass, FILTER_SANITIZE_STRING);

   $select_user = $conn->prepare("SELECT * FROM `users` WHERE email = ? AND password = ?");
   $select_user->execute([$email, $pass]);
   $row = $select_user->fetch(PDO::FETCH_ASSOC);

   if($select_user->rowCount() > 0){
      $_SESSION['user_id'] = $row['id'];
      header('location:home.php');
   }else{
      $message[] = 'Incorrect username or password!';
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
   
   <!-- font awesome cdn link  -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">

   <!-- custom css file link  -->
   <link rel="stylesheet" href="css/style.css">
   <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Revel eCommerce-Multi vendor Ecommerce HTML Template</title>

    <link rel="icon" type="image/x-icon" href="favicon.png">
    <link rel="stylesheet" href="assets/vendor/css/all.min.css">
    <link rel="stylesheet" href="assets/vendor/flaticon/flaticon.css">
    <link rel="stylesheet" href="assets/vendor/css/nice-select.css">
    <link rel="stylesheet" href="assets/vendor/css/flags.css">
    <link rel="stylesheet" href="assets/vendor/css/slick.css">
    <link rel="stylesheet" href="assets/vendor/css/bootstrap.min.css">
    <link rel="stylesheet" href="assets/vendor/css/meanmenu.css">
    <link rel="stylesheet" href="assets/vendor/css/modal-video.min.css">
    <link rel="stylesheet" href="assets/css/style.css">

</head>
<body>
<?php include 'components/user_header.php'; ?>

<div class="register py-120">
    <div class="container">
        <div class="row justify-content-around">
            <div class="col-md-6">
                <div class="login-area">
                    <h2>Log in your Account</h2>
                    <p>There are no enrollment fees or shipping quotas. Simply provide your contact information, create a user ID and password.</p>
                    <?php
                    if(isset($message) && !empty($message)){
                        echo '<div class="error-message">';
                        foreach($message as $msg){
                            echo '<p>'.$msg.'</p>';
                        }
                        echo '</div>';
                    }
                    ?>
                    <form class="login-form" method="post">
                        <input type="email" name="email" placeholder="Username or Email Address">
                        <input type="password" name="pass" placeholder="Enter Password">
                        <button class="def-btn btn-border" type="submit" name="submit">Login</button>
                    </form>
                    <span class="divider">or</span>
                    <div lass="login-form">
                      
                      <button class="def-btn btn-border" type="button" onclick="window.location.href='user_register.php'">Register</button>

                  
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?php include 'components/footer.php'; ?>

<script src="js/script.js"></script>

</body>
</html>
