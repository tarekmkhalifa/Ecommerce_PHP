<?php 
require_once(dirname(__DIR__) . "/validations/userValidation.php");
require_once(dirname(__DIR__) . "/models/User.php");

 // validate on URL _GET request
 $validation = new userValidation;
 $user = $validation->emailURLValidation($_GET);
 
if (isset($_POST['verify'])) {
    $errors = [];
    if (!isset($_POST['code'])) {
        $errors['key'] = "<div class='alert alert-danger'> Please Try Again </div>";
    }else {
        // validate on code input 
        $codeValidate = new userValidation;
        $codeValidation = $codeValidate->codeInputValidation($_POST['code']);
        if (empty($codeValidation)){
        // if method return data
        if ($user) {
            // Get entered email and code then send it to validate
            $codeValidate = new userValidation;
            $codeValidate->setEmail($_GET['email']);
            $codeValidate->setCode($_POST['code']);
            // check code is same in database or not
            $result = $codeValidate->checkCodeDB();
            if ($result) {
                if(isset($_GET['fp']) && $_GET['fp'] == 0 ){
                // change status user to verified user
                $userverified = new User;
                $userverified->setStatus(1);
                // set email to update status where email
                $userverified->setEmail($_GET['email']);
                // update user data
                $userUpdated = $userverified->updateDataStatus();
                // user status updated and became verified user
                if ($userUpdated) {
                    // save logged in user data to session
                    $_SESSION['user'] = $user;
                    // redirect to home page
                    header("Location:index.php");
                }else {
                    $errors['dbError'] = "<div class='alert alert-danger'> Something Went Wrong </div>";
                }
                }else if(isset($_GET['fp']) && $_GET['fp'] == 1 ){
                    // start session with fp key to no one can access new-password page
                    session_start();
                    $_SESSION['fp'] = 1;
                    header("Location:new-password.php?email=" . $_GET['email']);
                }else if(isset($_GET['fp']) && $_GET['fp'] == 2 ){
                    // update email in database
                    $updateEmail = new User;
                    $updateEmail->setId($_SESSION['user']->id);
                    $updateEmail->setEmail($_SESSION['new-mail']);
                    $updatedEmail = $updateEmail->updateEmail();
                    if($updatedEmail){
                        // email updated
                        $errors['success'] = "<div class='alert alert-success'> Your Email Has Been Changed Successfully, You Will Be Redirectly To Login With New Email </div>";
                        // logout user to login with new email
                        header("refresh:4,url=logout.php");
                    }else {
                        // error in database
                        $errors['dbError'] = "<div class='alert alert-danger'> Something Went Wrong </div>";
                    }
                }
            } else {
                // code invalid
                $errors['wrongCode'] = "<div class='alert alert-danger'> Wrong Code </div>";
            }
        }
        }

    }
}
?>