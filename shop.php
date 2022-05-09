<?php
require_once("app/process/shop.php");
?>
<!-- Breadcrumb Area Start -->
<div class="breadcrumb-area bg-image-3 ptb-150">
    <div class="container">
        <div class="breadcrumb-content text-center">
            <h3>SHOP PAGE</h3>
            <ul>
                <li><a href="index.php">Home</a></li>
                <li class="active">SHOP PAGE</li>
            </ul>
        </div>
    </div>
</div>
<!-- Breadcrumb Area End -->
<!-- Shop Page Area Start -->
<div class="shop-page-area ptb-100">
    <div class="container">
        <div class="row flex-row-reverse">
            <div class="col-lg-9">
                <div class="shop-topbar-wrapper">
                    <div class="shop-topbar-left">
                        <ul class="view-mode">
                            <li class="active"><a href="#product-grid" data-view="product-grid"><i class="fa fa-th"></i></a></li>
                            <li><a href="#product-list" data-view="product-list"><i class="fa fa-list-ul"></i></a></li>
                        </ul>
                        <p>Showing 1 - 20 of 30 results </p>
                    </div>
                    <div class="product-sorting-wrapper">
                        <div class="product-shorting shorting-style">
                            <label>View:</label>
                            <select>
                                <option value=""> 20</option>
                                <option value=""> 23</option>
                                <option value=""> 30</option>
                            </select>
                        </div>
                        <div class="product-show shorting-style">
                            <label>Sort by:</label>
                            <select>
                                <option value="">Default</option>
                                <option value=""> Name</option>
                                <option value=""> price</option>
                            </select>
                        </div>
                    </div>
                </div>
                <div class="grid-list-product-wrapper">
                    <div class="product-grid product-view pb-20">
                        <div class="row">
                            <!-- loop on products -->
                            <?php
                            if (isset($products) && $products) {
                                $products = $products->fetch_all(MYSQLI_ASSOC);
                                foreach ($products as $key => $product) {
                            ?>
                                    <div class="product-width col-xl-4 col-lg-4 col-md-4 col-sm-6 col-12 mb-30">
                                        <div class="product-wrapper">
                                            <div class="product-img">
                                                <a href="product-details.php?pr=<?=$product['id']?>">
                                                    <img width="268" height="288"  alt="" src="assets/img/product/<?= $product['image'] ?>">
                                                </a>
                                                <div class="product-action">
                                                    <a class="action-wishlist" href="#" title="Wishlist">
                                                        <i class="ion-android-favorite-outline"></i>
                                                    </a>
                                                    <a class="action-cart" href="#" title="Add To Cart">
                                                        <i class="ion-ios-shuffle-strong"></i>
                                                    </a>
                                                </div>
                                            </div>
                                            <div class="product-content text-center">
                                                <div class="product-hover-style">
                                                    <div class="product-title">
                                                        <h4>
                                                            <a href="product-details.php"><?= $product['name'] ?></a>
                                                        </h4>
                                                    </div>
                                                </div>
                                                <div class="product-price-wrapper">
                                                    <span><?= $product['price'] ?> EGP</span>
                                                </div>
                                            </div>
                                            <div class="product-list-details">
                                                <h4>
                                                    <a href="product-details.php?pro=<?=$product['id']?>"><?= $product['name'] ?></a>
                                                </h4>
                                                <div class="product-price-wrapper">
                                                    <span><?= $product['price'] ?> EGP</span>
                                                </div>
                                                <p><?= $product['details'] ?></p>
                                                <div class="shop-list-cart-wishlist">
                                                    <a href="#" title="Wishlist"><i class="ion-android-favorite-outline"></i></a>
                                                    <a href="#" title="Add To Cart"><i class="ion-ios-shuffle-strong"></i></a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                            <?php
                                }
                            } else {
                                echo "<div class=' col-12 alert alert-warning text-center'> There Is No Products Yet </div>";
                            }
                            ?>



                        </div>
                    </div>
                    <div class="pagination-total-pages">
                        <div class="pagination-style">
                            <ul>
                                <li><a class="prev-next prev" href="#"><i class="ion-ios-arrow-left"></i> Prev</a></li>
                                <li><a class="active" href="#">1</a></li>
                                <li><a href="#">2</a></li>
                                <li><a href="#">3</a></li>
                                <li><a href="#">...</a></li>
                                <li><a href="#">10</a></li>
                                <li><a class="prev-next next" href="#">Next<i class="ion-ios-arrow-right"></i> </a></li>
                            </ul>
                        </div>
                        <div class="total-pages">
                            <p>Showing 1 - 20 of 30 results </p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-3">
                <div class="shop-sidebar-wrapper gray-bg-7 shop-sidebar-mrg">
                    <div class="shop-widget">
                        <h4 class="shop-sidebar-title">Shop By Categories</h4>
                        <div class="shop-catigory">
                            <ul id="faq">
                                <?php
                                foreach ($categories as $key => $category) {
                                ?>
                                    <li> <a data-toggle="collapse" data-parent="#faq" href="#shop-catigory-<?= $category['id'] ?>"><?= $category['name'] ?> <i class="ion-ios-arrow-down"></i></a>
                                        <ul id="shop-catigory-<?= $category['id'] ?>" class="panel-collapse collapse">
                                            <?php
                                            $subCategory = new Subcategory;
                                            $subCategory->setCategory_id($category['id']);
                                            $subCategories = $subCategory->selectAllData()->fetch_all(MYSQLI_ASSOC);
                                            foreach ($subCategories as $key => $subcategory) {
                                            ?>
                                                <li><a href="shop.php?sc=<?= $subcategory['id'] ?>"><?= $subcategory['name'] ?></a></li>
                                            <?php
                                            }
                                            ?>
                                        </ul>
                                    </li>
                                <?php

                                }
                                ?>

                            </ul>
                        </div>
                    </div>

                    <div class="shop-widget mt-40 shop-sidebar-border pt-35">
                        <h4 class="shop-sidebar-title">By Brand</h4>
                        <div class="sidebar-list-style mt-20">
                            <ul>
                                <?php
                                foreach ($brands as $key => $brand) {
                                ?>
                                    <li>
                                        <a href="shop.php?br=<?= $brand['id'] ?>"><?= $brand['name'] ?></a>
                                    </li>
                                <?php
                                }
                                ?>
                            </ul>
                        </div>
                    </div>


                </div>
            </div>
        </div>
    </div>
</div>
<!-- Shop Page Area End -->
<?php
require_once("layouts/footer.php");
?>