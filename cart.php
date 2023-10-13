<?php
require('top.php');
?>

<style>

.row{
    margin-left: 70px;
}
/* Style for the card body */
.card-body {
    padding: 1rem;
}

/* Style for the card title (product name) */
.card-title {
    font-size: 1.25rem;
    font-weight: bold;
}

/* Style for the card text (price, quantity, total) */
.card-text {
    margin-bottom: 0.5rem;
}

/* Style for the card image */
.card-img {
    width: 140px;
    height: 140px;
    object-fit: cover;
}

/* Style for the card container */
.card {
    margin: 10px 0;
}
.img-link img{
    margin-top:20px;
}
/* Style for the product details */
.product-details {
    display: flex;
    align-items: center;
}

/* Style for the product price */
.product-price {
    flex: 1;
    font-weight: bold;
}

/* Style for the product quantity and total */
.product-quantity,
.product-subtotal {
    display: flex;
    flex-direction: column;
    align-items: center;
}

/* Style for the "Remove" button */
.btn-danger {
    background-color: #dc3545;
    border-color: #dc3545;
    color: #fff;
    text-decoration: none;
}

.btn-danger:hover {
    background-color: #c82333;
    border-color: #bd2130;
    color: #fff;
}


</style>

<div class="cart-main-area ptb--100 bg__white">
    <div class="container">
        <div class="row">
            <div class="col-md-12 col-sm-12 col-xs-12">
                <form action="#">
                    <div class="row">
                        <?php
                        if (isset($_SESSION['cart'])) {
                            foreach ($_SESSION['cart'] as $key => $val) {
                                $productArr = get_product($con, '', '', $key);
                                $pname = $productArr[0]['name'];
                                $mrp = $productArr[0]['mrp'];
                                $price = $productArr[0]['price'];
                                $image = $productArr[0]['image'];
                                $qty = $val['qty'];
                                $product_url = 'product.php?id=' . $key; // Product page URL
                                ?>
                                <div class="col-12">
                                    <div class="card mb-3">
                                        <div class="row no-gutters">
                                            <div class="col-md-4">
                                                <a href="<?php echo $product_url ?>" class="img-link">
                                                    <img src="<?php echo PRODUCT_IMAGE_SITE_PATH . $image ?>"
                                                         class="card-img" alt="Product Image" width="130" height="140" />
                                                </a>
                                            </div>
                                            <div class="col-md-8">
                                                <div class="card-body">
                                                    <h5 class="card-title">
                                                        <a href="<?php echo $product_url ?>"><?php echo $pname ?></a>
                                                    </h5>
                                                    <p class="card-text">Price: Rs.<?php echo $price ?></p>
                                                    <p class="card-text">Quantity:
                                                        <input type="number" id="<?php echo $key ?>qty" value="<?php echo $qty ?>" />
                                                        <a href="javascript:void(0)" onclick="manage_cart('<?php echo $key ?>','update')">Update</a>
                                                    </p>
                                                    <p class="card-text">Total: Rs.
                                                        <?php echo number_format((float)$qty * (float)$price, 2, '.', '') ?>
                                                    </p>
                                                    <a href="javascript:void(0)"
                                                       onclick="manage_cart('<?php echo $key ?>','remove')"
                                                       class="btn btn-danger">Remove</a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <hr>
                                </div>
                            <?php }
                        } ?>
                    </div>
                </form>
                <div class="buttons-cart--inner">
                    <div class="buttons-cart">
                        <a href="<?php echo SITE_PATH ?>">Continue Shopping</a>
                    </div>
                    <div class="buttons-cart checkout--btn">
                        <a href="checkout.php">Checkout</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>



<!-- End Cart Main Area -->

<?php require('footer.php') ?>
