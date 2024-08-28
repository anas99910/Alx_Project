<?php

include 'components/connect.php';

session_start();

if(isset($_SESSION['user_id'])){
   $user_id = $_SESSION['user_id'];
}else{
   $user_id = '';
   header('location:user_login.php');
};

if(isset($_POST['delete'])){
   $cart_id = $_POST['cart_id'];
   $delete_cart_item = $conn->prepare("DELETE FROM `cart` WHERE id = ?");
   $delete_cart_item->execute([$cart_id]);
}

if(isset($_GET['delete_all'])){
   $delete_cart_item = $conn->prepare("DELETE FROM `cart` WHERE user_id = ?");
   $delete_cart_item->execute([$user_id]);
   header('location:cart.php');
}

if(isset($_POST['update_qty'])){
   $cart_id = $_POST['cart_id'];
   $qty = $_POST['qty'];
   $qty = filter_var($qty, FILTER_SANITIZE_STRING);
   $update_qty = $conn->prepare("UPDATE `cart` SET quantity = ? WHERE id = ?");
   $update_qty->execute([$qty, $cart_id]);
   $message[] = 'cart quantity updated';
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Shopping Cart</title>

    <!-- font awesome cdn link -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">

    <!-- custom css file link -->
    <link rel="stylesheet" href="assets/vendor/css/bootstrap.min.css">
    <link rel="stylesheet" href="assets/vendor/css/all.min.css">
    <link rel="stylesheet" href="assets/vendor/css/nice-select.css">
    <link rel="stylesheet" href="assets/vendor/css/flags.css">
    <link rel="stylesheet" href="assets/vendor/css/slick.css">
    <link rel="stylesheet" href="assets/vendor/css/owl.carousel.min.css">
    <link rel="stylesheet" href="assets/vendor/css/modal-video.min.css">
    <link rel="stylesheet" href="assets/vendor/css/nouislider.min.css">
    <link rel="stylesheet" href="assets/vendor/css/meanmenu.css">
    <link rel="stylesheet" href="assets/css/style.css">
</head>
<body>
   
<?php include 'components/user_header.php'; ?>

<section class="products shopping-cart tab-section py-120">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="tab-nav">
                    <button class="single-nav active" data-tab="cartTab">
                        <span class="txt">Shopping Cart</span>
                        <span class="sl-no">01</span>
                    </button>
                    <button class="single-nav" data-tab="checkOutTab" disabled>
                        <span class="txt">Check Out</span>
                        <span class="sl-no">02</span>
                    </button>
                    <button class="single-nav" data-tab="orderCompletedTab" disabled>
                        <span class="txt">Order Completed</span>
                        <span class="sl-no">03</span>
                    </button>
                </div>
                <div class="tab-contents">
                    <div class="single-tab active" id="cartTab">
                        <div class="table-wrap revel-table">
                            <div class="table-responsive">
                                <table class="table table-borderless">
                                    <thead>
                                        <tr>
                                            <th>Image</th>
                                            <th>Product Name</th>
                                            <th>Price</th>
                                            <th>Quantity</th>
                                            <th>Total</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    <?php
                                        $grand_total = 0;
                                        $select_cart = $conn->prepare("SELECT * FROM `cart` WHERE user_id = ?");
                                        $select_cart->execute([$user_id]);
                                        if($select_cart->rowCount() > 0){
                                            while($fetch_cart = $select_cart->fetch(PDO::FETCH_ASSOC)){
                                    ?>
                                        <tr>
                                            <td>
                                                <div class="product-img">
                                                    <img src="uploaded_img/<?= $fetch_cart['image']; ?>" alt="">
                                                </div>
                                            </td>
                                            <td><a href="quick_view.php?pid=<?= $fetch_cart['pid']; ?>" class="product-name"><?= $fetch_cart['name']; ?></a></td>
                                            <td><span class="price-txt"><span class="main-price"><?= $fetch_cart['price']; ?></span> USD </span></td>
                                            <td>
                                                <div class="product-count cart-product-count">
                                                    <div class="quantity rapper-quantity">
                                                        <input type="number" name="qty" class="qty" min="1" max="99" onkeypress="if(this.value.length == 2) return false;" value="<?= $fetch_cart['quantity']; ?>">
                                                        <div class="quantity-nav">
                                                            <div class="quantity-button quantity-down">
                                                                <i class="fa-solid fa-minus"></i>
                                                            </div>
                                                            <div class="quantity-button quantity-up">
                                                                <i class="fa-solid fa-plus"></i>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </td>
                                            <td><span class="price-txt"><span class="total-price"><?= $sub_total = ($fetch_cart['price'] * $fetch_cart['quantity']); ?></span> USD </span></td>
                                            <td>
                                                <form action="" method="post">
                                                    <input type="hidden" name="cart_id" value="<?= $fetch_cart['id']; ?>">
                                                    <button type="submit" class="fas fa-edit" name="update_qty"></button>
                                                    <button type="submit" class="cart-delete" name="delete" onclick="return confirm('delete this from cart?');"><i class="fa-light fa-trash-can"></i></button>
                                                </form>
                                            </td>
                                        </tr>
                                    <?php
                                        $grand_total += $sub_total;
                                            }
                                        }else{
                                            echo '<tr><td colspan="6" class="empty">Your cart is empty</td></tr>';
                                        }
                                    ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <div class="cart-total">
                            <p>Grand Total: <span><?= $grand_total; ?> USD </span></p>
                            <a href="shop.php" class="def-btn">Continue Shopping</a>
                            <a href="cart.php?delete_all" class="delete-btn <?= ($grand_total > 1) ? '' : 'disabled'; ?>" onclick="return confirm('delete all from cart?');">Delete All Items?</a>
                            <a href="checkout.php" class="def-btn <?= ($grand_total > 1) ? '' : 'disabled'; ?>">Proceed to Checkout</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<?php include 'components/footer.php'; ?>

<script src="assets/vendor/js/jquery-3.6.0.min.js"></script>
<script src="assets/vendor/js/bootstrap.bundle.min.js"></script>
<script src="assets/vendor/js/all.min.js"></script>
<script src="assets/vendor/js/slick.min.js"></script>
<script src="assets/vendor/js/owl.carousel.min.js"></script>
<script src="assets/vendor/js/modal-video.min.js"></script>
<script src="assets/vendor/js/nouislider.min.js"></script>
<script src="assets/vendor/js/jquery.meanmenu.min.js"></script>
<script src="assets/js/main.js"></script>

</body>
</html>
