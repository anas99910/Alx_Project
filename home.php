<?php

include 'components/connect.php';

session_start();

if(isset($_SESSION['user_id'])){
   $user_id = $_SESSION['user_id'];
}else{
   $user_id = '';
};

include 'components/wishlist_cart.php';

?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ecom alx </title>

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

<?php include 'components/userheader.php'; ?>

<section class="rev-8-banner">
        <div class="container">
            <div class="row">
                <div class="col-xxl-6 col-xl-7 col-11">
                    <div class="rev-8-banner__txt">
                        <h6>ALX FINAL PROJECT</h6>
                        <h1>ALX FINAL PROJECT Ecommerce Website</h1>
                        <a href="#" class="def-btn rev-7-def-btn">shop now</a>
                    </div>
                </div>
            </div>
        </div>
    </section>
    
    
    <section class="rev-7-top-product">
    <div class="container">
        <div class="section-heading rev-7-section-heading">
            <div class="row">
                <div class="col-xxl-6">
                    <h2 class="section-title">Latest Products</h2>
                </div>
                <div class="col-xxl-6">
                    <!-- Additional content can be added here if needed -->
                </div>
            </div>
        </div>

        <div class="product-tabs-container">
            <div class="tab-content" id="myTabContent">
                <div class="tab-pane fade show active" id="first-tab-pane" role="tabpanel" aria-labelledby="first-tab" tabindex="0">
                    <div class="products-container">

                        <?php
                        $select_products = $conn->prepare("SELECT * FROM `products` LIMIT 6"); 
                        $select_products->execute();
                        if($select_products->rowCount() > 0){
                            while($fetch_product = $select_products->fetch(PDO::FETCH_ASSOC)){
                        ?>
                        <div class="single-product-card rev-7-single-product">
                            <div class="rev-7-product-tag rev-7-product-tag-2">New</div>
                            <img src="uploaded_img/<?= $fetch_product['image_01']; ?>" alt="product image" class="rev-7-single-product__img">
                            <div class="rev-7-single-product__txt">
                                <div class="rev-7-single-product__info">
                                    <span class="product-category">Category</span>
                                    <a href="quick_view.php?pid=<?= $fetch_product['id']; ?>"><?= $fetch_product['name']; ?></a>
                                    <p class="price">
                                        <?= $fetch_product['price']; ?> $ <span></span>
                                        
                                    </p>
                                </div>
                                <div class="rev-7-single-product__actions d-flex justify-content-between">
                                    <div class="product-count cart-product-count">
                                        <div class="quantity rapper-quantity">
                                        <input type="hidden" name="qty" value="1">
                                        </div>
                                    </div>
                                    <form action="" method="post" class="add-to-cart-form">
                                        <input type="hidden" name="pid" value="<?= $fetch_product['id']; ?>">
                                        <input type="hidden" name="name" value="<?= $fetch_product['name']; ?>">
                                        <input type="hidden" name="price" value="<?= $fetch_product['price']; ?>">
                                        <input type="hidden" name="image" value="<?= $fetch_product['image_01']; ?>">
                                        <button class="add-to-cart-option" type="submit" name="add_to_wishlist"><i class="fa-light fa-heart"></i></button>
                                        <button class="add-to-cart-option" type="submit" value="add to cart" name="add_to_cart"><i class="fa-light fa-cart-shopping"></i></button>
                                       
                                    </form>
                                </div>
                            </div>
                        </div>
                        <?php
                            }
                        } else {
                            echo '<p class="empty">No products added yet!</p>';
                        }
                        ?>

                    </div>
                </div>
            </div>
        </div>
    </div>
</section>



<script src="https://unpkg.com/swiper@8/swiper-bundle.min.js"></script>

<script src="js/script.js"></script>

<?php include 'components/footer.php'; ?>


    </body>
</html>
   
