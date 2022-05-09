<?php
require_once("layouts/header.php");
require_once("layouts/nav.php");
require_once("app/process/product-detail.php");
?>

<!-- Breadcrumb Area Start -->
<div class="breadcrumb-area bg-image-3 ptb-150">
    <div class="container">
        <div class="breadcrumb-content text-center">
            <h3>SINGLE PRODUCT</h3>
            <ul>
                <li><a href="index.php">Home</a></li>
                <li class="active">Single Product</li>
            </ul>
        </div>
    </div>
</div>
<!-- Breadcrumb Area End -->
<!-- Product Deatils Area Start -->
<div class="product-details pt-100 pb-95">
    <div class="container">
        <div class="row">
            <div class="col-lg-6 col-md-12">
                <div class="product-details-img">
                    <img class="zoompro" src="assets/img/product/<?= $images[0]['image'] ?>" data-zoom-image="assets/img/product/<?= $images[0]['image'] ?>" alt="zoom" />
                    <div id="gallery" class="mt-20 product-dec-slider owl-carousel">
                        <?php
                        if (isset($images) && $images) {
                            foreach ($images as $key => $image) {
                        ?>
                                <a data-image="assets/img/product/<?= $image['image'] ?>" data-zoom-image="assets/img/product/<?= $image['image'] ?>"">
                                    <img style=" max-width: 75px;" src="assets/img/product/<?= $image['image'] ?>" alt="">
                                </a>
                        <?php
                            }
                        }
                        ?>

                    </div>
                </div>
            </div>
            <div class="col-lg-6 col-md-12">
                <div class="product-details-content">
                    <h4><?= $productDetails->name ?></h4>
                    <div class="rating-review">
                        <div class="pro-dec-rating">
                            <?php
                            for ($i = 0; $i < $productDetails->reviewAvg; $i++) {
                            ?>
                                <i class="ion-android-star-outline theme-star"></i>
                            <?php
                            }
                            ?>

                            <?php
                            for ($i = 0; $i < 5 - $productDetails->reviewAvg; $i++) {
                            ?>
                                <i class="ion-android-star-outline"></i>
                            <?php
                            }
                            ?>
                        </div>
                        <div class="pro-dec-review">
                            <ul>
                                <li><?= $productDetails->reviewsNumber ?> Review </li>
                            </ul>
                        </div>
                    </div>
                    <span><?= $productDetails->price ?> EGP</span>
                    <div class="in-stock">
                        <p>Available:
                            <?php
                            if ($productDetails->quantity < 1) {
                            ?>
                                <span>Out Of Stock</span>
                            <?php

                            } else {
                            ?>
                                <span>In Stock</span>
                            <?php
                            }
                            ?>
                        </p>
                    </div>
                    <p><?= $productDetails->details ?></p>
                    <div class="pro-dec-feature">
                    </div>
                    <div class="quality-add-to-cart">
                        <div class="quality">
                            <label>Qty:</label>
                            <input class="cart-plus-minus-box" type="text" name="qtybutton" value="<?= $productDetails->quantity ?>">
                        </div>
                        <div class="shop-list-cart-wishlist">
                            <a title="Add To Cart" href="#">
                                <i class="icon-handbag"></i>
                            </a>
                            <a title="Wishlist" href="#">
                                <i class="icon-heart"></i>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Product Deatils Area End -->
<div class="description-review-area pb-70">
    <div class="container">
        <div class="description-review-wrapper">
            <div class="description-review-topbar nav text-center">
                <a class="<?php if(!isset($reviewErrors)){echo "active";}else {echo "";} ?>" data-toggle="tab" href="#des-details1">Description</a>
                <a <?php if(isset($reviewErrors)){echo "class='active'";} ?> data-toggle="tab" href="#des-details3">Review</a>
            </div>
            <div class="tab-content description-review-bottom">
                <div id="des-details1" class="tab-pane <?php if(!isset($reviewErrors)){echo "active";}else {echo "";} ?>">
                    <div class="product-description-wrapper">
                        <?= $productDetails->details ?>
                    </div>
                </div>
                <div id="des-details3" class="tab-pane <?php if(isset($reviewErrors)){echo "active";} ?> ">

                    <?php
                    if (isset($productReviews)) {
                        foreach ($productReviews as $key => $review) {
                    ?>

                            <div class="rattings-wrapper">
                                <div class="sin-rattings">
                                    <div class="star-author-all">
                                        <div class="ratting-star f-left">

                                            <?php
                                            for ($i = 0; $i < $review['ratevalue']; $i++) {
                                            ?>
                                                <i class="ion-star theme-color"></i>
                                            <?php
                                            }
                                            ?>

                                            <?php
                                            for ($i = 0; $i < 5 - $review['ratevalue']; $i++) {
                                            ?>
                                                <i class="ion-android-star-outline"></i>
                                            <?php
                                            }
                                            ?>

                                            <span><?= $review['ratevalue'] ?></span>
                                        </div>
                                        <div class="ratting-author f-right">
                                            <h3><?= $review['name'] ?></h3>
                                            <span><?= $review['date'] ?></span>
                                        </div>
                                    </div>
                                    <p> <?= $review['comment'] ?> </p>
                                </div>
                            </div>
                    <?php
                        }
                    }else {
                        ?>
                        <div class='alert alert-warning'> This Product Has Not Reviews Yet </div>
                        <?php
                    } 
                        if(isset($reviewErrors)){
                            foreach($reviewErrors AS $key => $error){
                                echo $error;
                            }
                        }
                             
                    
                    ?>

                    <?php
                        if(isset($selectedReview)){
                            if(!$selectedReview){
                    ?>
                        <div class="ratting-form-wrapper">
                            <h4>Add your Comment :</h4>
                            <div class="ratting-form">
                                <form method="POST">
                                    <div class="star-box">
                                        <h2>Rating:</h2>
                                        <div class='col-2'>
                                            <select name="rate">
                                                    <option value="1">1</option>
                                                    <option value="2">2</option>
                                                    <option value="3">3</option>
                                                    <option value="4">4</option>
                                                    <option value="5">5</option>
                                            </select>
                                        </div>

                                        <!-- <div class="ratting-star">
                                        <i class="ion-star theme-color"></i>
                                        <i class="ion-star theme-color"></i>
                                        <i class="ion-star theme-color"></i>
                                        <i class="ion-star theme-color"></i>
                                        <i class="ion-star"></i>
                                    </div> -->
                                    </div>
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="rating-form-style form-submit">
                                                <textarea name="review" placeholder="Your Review is Important"></textarea>
                                                <input type="submit" name="send-review" value="add review">
                                            </div>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>


                    <?php
                    }}
                    ?>


                </div>
            </div>
        </div>
    </div>
</div>
<div class="product-area pb-100">
    <div class="container">
        <div class="product-top-bar section-border mb-35">
            <div class="section-title-wrap">
                <h3 class="section-title section-bg-white">Related Products</h3>
            </div>
        </div>

        <div class="row">
        <?php 
            if(isset($relatedProductsAfterFetch)){
                foreach($relatedProductsAfterFetch AS $key => $relatedProduct){
                    ?>

            <div class="col-3">
                <div class="product-img">
                    <a href="product-details.php?pr=<?= $relatedProduct['id'] ?>">
                        <img alt="" src="assets/img/product/product-1.jpg">
                    </a>
                    <div class="product-action">
                        <a class="action-wishlist" href="#" title="Wishlist">
                            <i class="ion-android-favorite-outline"></i>
                        </a>
                        <a class="action-cart" href="#" title="Add To Cart">
                            <i class="ion-ios-shuffle-strong"></i>
                        </a>
                        <a class="action-compare" href="#" data-target="#exampleModal" data-toggle="modal" title="Quick View">
                            <i class="ion-ios-search-strong"></i>
                        </a>
                    </div>
                </div>
                <div class="product-content text-left">
                    <div class="product-hover-style">
                        <div class="product-title">
                            <h4>
                                <a href="product-details.php?pr=<?= $relatedProduct['id'] ?>"><?= $relatedProduct['name'] ?></a>
                            </h4>
                        </div>
                        <div class="cart-hover">
                            <h4><a href="product-details.php?pr=<?= $relatedProduct['id'] ?>">+ Add to cart</a></h4>
                        </div>
                    </div>
                    <div class="product-price-wrapper">
                        <span> <?= $relatedProduct['price'] ?> EGP </span>
                    </div>
                </div>
            </div>

                    <?php
                }
            }else {
                ?>
            <div class="col-12 alert alert-warning text-center">
                This Product Have Not Related Products
            </div>
                <?php
            }
        ?>

        </div>
    </div>
</div>

<?php
require_once("layouts/footer.php");
?>