<?php
require_once("layouts/header.php");
require_once("layouts/nav.php");
require_once("app/models/Brand.php");
require_once("app/models/Category.php");
require_once("app/models/Subcategory.php");
require_once("app/models/Product.php");

// select all Brands
$brand = new Brand;
$brands = $brand->selectAllData()->fetch_all(MYSQLI_ASSOC);

// select all categories
$category = new Category;
$categories = $category->selectAllData()->fetch_all(MYSQLI_ASSOC);

// check url to show products order by url get
$product = new Product;
if(isset($_GET['sc'])){
    if($_GET['sc'] && is_numeric($_GET['sc'])){
        // select product by sub category id
        $product->setSubcategory_id($_GET['sc']);
        $products = $product->productsBySubCategory();
    }else {
        // select all products
        $products = $product->selectAllData();
    }
} else if(isset($_GET['br'])){
    if($_GET['br'] && is_numeric($_GET['br'])){
        // select product by brand id
        $product->setBrand_id($_GET['br']);
        $products = $product->productsByBrand();
    }else {
        // select all products
        $products = $product->selectAllData();
    }
}
else {
    // select all products
    $products = $product->selectAllData();
}



?>