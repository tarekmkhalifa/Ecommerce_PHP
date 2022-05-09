<?php 
require_once(dirname(__DIR__) . "/models/Category.php");
require_once(dirname(__DIR__) . "/models/Subcategory.php");

// select all categories
$category = new Category;
$categories = $category->selectAllData()->fetch_all(MYSQLI_ASSOC);


?>