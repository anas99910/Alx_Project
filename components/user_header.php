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



    <!--------------------------------- HEADER CART LIST START --------------------------------->
    <div class="header-cart-wrap" id="headerCartWrap">
        <div class="cart-list">
            <div class="title">
                <h3>Shopping Cart</h3>
                <button class="cart-close"><i class="fa-regular fa-xmark"></i></button>
            </div>
            <ul>
                <li>
                    <a href="shop-details.html">
                        <div class="part-img">
                            <img src="assets/images/feat-product-3.jpg" alt="Image">
                        </div>
                        <div class="part-txt">
                            <span class="name">Diamond wedding ring</span>
                            <span>1 <i class="fa-regular fa-xmark"></i> $5.00</span>
                        </div>
                    </a>
                    <button class="delete-btn"><i class="fa-regular fa-trash-can"></i></button>
                </li>
                <li>
                    <a href="shop-details.html">
                        <div class="part-img">
                            <img src="assets/images/feat-product-2.jpg" alt="Image">
                        </div>
                        <div class="part-txt">
                            <span class="name">Living Summer Chair</span>
                            <span>1 <i class="fa-regular fa-xmark"></i> $5.00</span>
                        </div>
                    </a>
                    <button class="delete-btn"><i class="fa-regular fa-trash-can"></i></button>
                </li>
                <li>
                    <a href="shop-details.html">
                        <div class="part-img">
                            <img src="assets/images/feat-product-10.jpg" alt="Image">
                        </div>
                        <div class="part-txt">
                            <span class="name">Wireless Headphone</span>
                            <span>1 <i class="fa-regular fa-xmark"></i> $5.00</span>
                        </div>
                    </a>
                    <button class="delete-btn"><i class="fa-regular fa-trash-can"></i></button>
                </li>
            </ul>
            <div class="total">
                <p>Subtotal: <span>$15:00</span></p>
            </div>
            <div class="btn-box">
                <a href="#" class="def-btn">View Cart</a>
                <a href="#" class="def-btn">Checkout</a>
            </div>
        </div>
    </div>
    <!--------------------------------- HEADER CART LIST END --------------------------------->



    <!--------------------------------- HEADER WISH LIST START --------------------------------->
    <div class="header-cart-wrap" id="headerWishWrap">
        <div class="cart-list">
            <div class="title">
                <h3>Wish List</h3>
                <button class="wish-close"><i class="fa-regular fa-xmark"></i></button>
            </div>
            <ul>
                <li>
                    <a href="shop-details.html">
                        <div class="part-img">
                            <img src="assets/images/feat-product-3.jpg" alt="Image">
                        </div>
                        <div class="part-txt">
                            <span class="name">Diamond wedding ring</span>
                            <span>1 <i class="fa-regular fa-xmark"></i> $5.00</span>
                        </div>
                    </a>
                    <button class="delete-btn"><i class="fa-regular fa-trash-can"></i></button>
                </li>
                <li>
                    <a href="shop-details.html">
                        <div class="part-img">
                            <img src="assets/images/feat-product-2.jpg" alt="Image">
                        </div>
                        <div class="part-txt">
                            <span class="name">Living Summer Chair</span>
                            <span>1 <i class="fa-regular fa-xmark"></i> $5.00</span>
                        </div>
                    </a>
                    <button class="delete-btn"><i class="fa-regular fa-trash-can"></i></button>
                </li>
                <li>
                    <a href="shop-details.html">
                        <div class="part-img">
                            <img src="assets/images/feat-product-10.jpg" alt="Image">
                        </div>
                        <div class="part-txt">
                            <span class="name">Wireless Headphone</span>
                            <span>1 <i class="fa-regular fa-xmark"></i> $5.00</span>
                        </div>
                    </a>
                    <button class="delete-btn"><i class="fa-regular fa-trash-can"></i></button>
                </li>
            </ul>
            <div class="total">
                <p>Subtotal: <span>$15:00</span></p>
            </div>
            <div class="btn-box">
                <a href="#" class="def-btn">View Wish List</a>
                <a href="#" class="def-btn">Add All To Cart</a>
            </div>
        </div>
    </div>
    <!--------------------------------- HEADER WISH LIST END --------------------------------->



    <!--------------------------------- HEADER SECTION START --------------------------------->
    <div class="header header-inner" >

        <div class="bottom-header">
            <div class="container">
                
                <div class="row align-items-center">
                    <div class="col-xxl-2 col-lg-3 col-6">
                        <div class="logo-wrap">
                            <div class="logo">
                                <a href="home.php">
                                    <img src="assets/images/logo-black.svg" alt="logo">
                                </a>
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
                                            <li class="nav-item dropdown has-mega-menu">
                                                <a class="nav-link" href="home.php">Home</a>

                                            </li>
                                            <li class=" nav-item">
                                                <a class="nav-link" href="about.php">About</a>
                                            </li>
                                            <li class=" nav-item">
                                                <a class="nav-link" href="shop.php">Shop</a>
                                            </li>
                                            <li class="nav-item dropdown">
    <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
        <?php
        $select_profile = $conn->prepare("SELECT * FROM `users` WHERE id = ?");
        $select_profile->execute([$user_id]);
        if ($select_profile->rowCount() > 0) {
            $fetch_profile = $select_profile->fetch(PDO::FETCH_ASSOC);
            echo $fetch_profile["name"];
        } else {
            echo "Account";
        }
        ?>
    </a>
    <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="userDropdown">
        <?php if ($select_profile->rowCount() > 0) { ?>
            <li><a class="dropdown-item" href="update_user.php">Update Profile</a></li>
            <li><a class="dropdown-item" href="components/user_logout.php" onclick="return confirm('Logout from the website?');">Logout</a></li>
        <?php } else { ?>
            <li><a class="dropdown-item" href="user_register.php">Register</a></li>
            <li><a class="dropdown-item" href="user_login.php">Login</a></li>
        <?php } ?>
    </ul>
</li>

                                            
                                            <li class="nav-item">
                                                <a class="nav-link" href="contact.php">Contact</a>
                                            </li>
                                        </ul>
                                    </nav>
                                </div>
                            </div>
                        </nav>
                    </div>


                    <div class="col-xxl-1 col-lg-2 col-6">
         <?php
            $count_wishlist_items = $conn->prepare("SELECT * FROM `wishlist` WHERE user_id = ?");
            $count_wishlist_items->execute([$user_id]);
            $total_wishlist_counts = $count_wishlist_items->rowCount();

            $count_cart_items = $conn->prepare("SELECT * FROM `cart` WHERE user_id = ?");
            $count_cart_items->execute([$user_id]);
            $total_cart_counts = $count_cart_items->rowCount();
         ?>
         
         <a href="wishlist.php"><i class="fa-light fa-heart"></i><span>(<?= $total_wishlist_counts; ?>)</span></a>
         <a href="cart.php"><i class="fa-light fa-cart-shopping"></i><span>(<?= $total_cart_counts; ?>)</span></a>
         
         
      </div>

         
         
                                </div>


                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!--------------------------------- HEADER SECTION END --------------------------------->


    </header>
 
