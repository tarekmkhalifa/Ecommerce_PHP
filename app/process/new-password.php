<?php 

require_once(dirname(__DIR__) . "/validations/userValidation.php");
require_once(dirname(__DIR__) . "/models/User.php");

// Check on URL
$validate = new userValidation;
$userValidation = $validate->emailURLValidation($_GET);
// $userValidation --> data of user include (old password)
if(isset($_SESSION['fp']) && $_SESSION['fp'] == 1){
    if(isset($_POST['confirm'])){
        $errors = [];
        if(!isset($_POST['password']) | !isset($_POST['confirmPassword'])){
            $errors['key'] = "<div class='alert alert-danger'>Something Wrong </div>";
        }else {
            // Validate on Password and Confirm
            $validate->setPassword($_POST['password']);
            $validate->setConfirmPassword($_POST['confirmPassword']);
            $validation = $validate->passwordValidation();
            if(empty($validation)){
                // update password in database
                $user = new User;
                $user->setEmail($_GET['email']);
                $user->setPassword($_POST['password']);
                // prevent old passowrd
                // old passowrd with encryption == new password with encryption
                if ($userValidation->password == $user->getPassword()){
                    $errors['oldPass'] = "<div class='alert alert-danger'> This Password Used Before, Please Enter Another Password</div>";
                }else {
                    $result = $user->updatePassword();
                    if($result){
                        // end session
                        // header to logout the login page
                        header("Location:logout.php");
        
                    }else {
                        $errors['dbError'] = "<div class='alert alert-danger'>Something Wrong Please Try Again Later </div>";
                    }
                }
    
            }
        }
    }
}else {
    header("Location:404.php");
}
?>