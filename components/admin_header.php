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

<header class="header">

<section class="bottom-header">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-xxl-2 col-lg-3 col-6">
                <div class="logo-wrap">
                    <div class="logo">
                        <a href="../admin/dashboard.php" class="logo">Admin<span>Dashboard</span></a>
                    </div>
                </div>
            </div>
            <div class="col-xxl-9 col-lg-7 d-lg-block d-none">
                <nav class="navbar navbar-expand-lg">
                    <div class="container-fluid">
                        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                            <span class="navbar-toggler-icon"></span>
                        </button>
                        <div class="collapse navbar-collapse" id="navbarSupportedContent">
                            <nav id="revel-mobile-menu" class="revel-mobile-menu">
                                <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
                                    <li class="nav-item">
                                        <a class="nav-link" href="../admin/dashboard.php">Home</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" href="../admin/products.php">Products</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" href="../admin/add_products.php">Add Products</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" href="../admin/placed_orders.php">Orders</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" href="../admin/admin_accounts.php">Admins</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" href="../admin/users_accounts.php">Users</a>
                                    </li>
                                   
                                    <li class="nav-item dropdown">
                                        <a class="nav-link dropdown-toggle" href="#" id="profileDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                            Profile
                                        </a>
                                        <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="profileDropdown">
                                            <?php
                                            $select_profile = $conn->prepare("SELECT * FROM `admins` WHERE id = ?");
                                            $select_profile->execute([$admin_id]);
                                            if ($select_profile->rowCount() > 0) {
                                                $fetch_profile = $select_profile->fetch(PDO::FETCH_ASSOC);
                                                ?>
                                                <li><a class="dropdown-item" href="../admin/update_profile.php">Update Profile</a></li>
                                                <li><a class="dropdown-item" href="../components/admin_logout.php" onclick="return confirm('Logout from the website?');">Logout</a></li>
                                                <?php
                                            } else {
                                                ?>
                                                <li><a class="dropdown-item" href="../admin/register_admin.php">Register</a></li>
                                                <li><a class="dropdown-item" href="../admin/admin_login.php">Login</a></li>
                                                <?php
                                            }
                                            ?>
                                        </ul>
                                    </li>
                                </ul>
                            </nav>
                        </div>
                    </div>
                </nav>
            </div>
            <div class="col-xxl-1 col-lg-2 col-6">
                <div class="icons">
                    <div id="menu-btn" class="fas fa-bars"></div>
                </div>
            </div>
        </div>
    </div>
</section>


</header>