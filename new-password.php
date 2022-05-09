<?php
// header==>
require_once("layouts/header.php");
// middllware ==> only logged in useres can enter
require_once("app/middllwares/guest.php");
// New Password Process ==>
require_once("app/process/new-password.php");
?>

<div class="login-register-area ptb-100">
    <div class="container">
        <div class="row">
            <div class="col-lg-7 col-md-12 ml-auto mr-auto">
                <div class="login-register-wrapper">
                    <div class="login-register-tab-list nav">
                        <a class="active" data-toggle="tab">
                            <h4>Set New Password</h4>
                        </a>
                    </div>
                    <div class="tab-content">
                        <div id="lg1" class="tab-pane active">
                            <div class="login-form-container">
                                <div class="login-register-form">
                                    <form action="" method="post">
                                        <?php 
                                        if (isset($errors) && $errors){
                                            foreach($errors AS $key=> $error){
                                                echo $error;
                                            }
                                        }
                                        if (isset($validation) && $validation){
                                            foreach($validation AS $key=> $error){
                                                echo $error;
                                            }
                                        }

                                        ?>
                                        <input type="password" name="password" placeholder="New Password">
                                        <input type="password" name="confirmPassword" placeholder="Confirm New Passowrd">
                                        <div class="button-box">
                                            <button type="submit" name="confirm"><span>Confirm</span></button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
</body>

</html>