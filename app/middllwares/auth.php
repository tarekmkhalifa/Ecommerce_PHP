<?php
// User Must be Login
if(!isset($_SESSION['user'])){
header("location:login.php");
}
?>