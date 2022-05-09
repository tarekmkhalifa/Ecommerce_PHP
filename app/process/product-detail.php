<?php
require_once(dirname(__DIR__) . "/models/Product.php");
require_once(dirname(__DIR__) . "/models/Review.php");

// show product details
if(isset($_GET['pr'])){
    if($_GET['pr'] && is_numeric($_GET['pr'])){
        $productsDetails = new Product;
        $productsDetails->setId($_GET['pr']);
        $productDetails = $productsDetails->productDetails();
        if($productDetails){
            $productDetails = $productDetails->fetch_object();
            $productImages = $productsDetails->productImages();
            if($productImages){
                $images = $productImages->fetch_all(MYSQLI_ASSOC);
                $productsReview = $productsDetails->productReviews();
                if($productsReview){
                    $productReviews = $productsReview->fetch_all(MYSQLI_ASSOC);
                }
            }
        }else {
            header("Location:shop.php");

        }

    }else {
    header("Location:shop.php");
}

}else {
    header("Location:shop.php");
}

// add review
if (isset($_POST['send-review'])){
    $reviewErrors = [];
    // validate on keys
    if(!isset($_POST['rate']) | !isset($_POST['review'])){
        $reviewErrors['key'] = " <div class='alert alert-danger'> Something Wrong </div> ";
    }else {
        // insert review into database
        $review = new Review;
        $review->setUser_id($_SESSION['user']->id);
        $review->setProduct_id($_GET['pr']);
        $review->setratevalue($_POST['rate']);
        $review->setComment($_POST['review']);
        $result = $review->addReview();
        if($result){
            $reviewErrors['success'] = " <div class='alert alert-success'> Thanks for reviewing </div> ";
                        // refresh page
                        header("refresh:4,url=product-details.php?pr=".$_GET['pr']);
        }else {
            $reviewErrors['dbError'] = " <div class='alert alert-danger'> Something Wrong</div> ";
        }
    }
}

// exists review 
    // select review
    if(isset ($_SESSION['user'])){
        $review = new Review;
        $review->setUser_id($_SESSION['user']->id);
        $review->setProduct_id($productDetails->id);
    $selectedReview = $review->selectReview();
    }

// Related Products
$relatedProducts = new Product;
$relatedProducts->setId($productDetails->id);
$relatedProducts->setSubcategory_id($productDetails->subcategory_id);
$relatedProductsBeforeFetch = $relatedProducts->relatedProducts();
if($relatedProductsBeforeFetch){
    $relatedProductsAfterFetch = $relatedProductsBeforeFetch->fetch_all(MYSQLI_ASSOC);
}