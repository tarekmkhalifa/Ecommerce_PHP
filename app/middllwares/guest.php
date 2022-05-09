<?php 
// for Default Users only (guests)
if(isset($_SESSION['user'])){
    header("location:index.php");
}
?>