<?php
// header==>
require_once("layouts/header.php");
// middllware ==> only logged in useres can enter
// require_once("app/middllwares/guest.php");
// check-code Process==>
require_once("app/process/check-code.php");
?>

<div class="login-register-area ptb-100">
    <div class="container">
        <div class="row">
            <div class="col-lg-7 col-md-12 ml-auto mr-auto">
                <div class="login-register-wrapper">
                    <div class="login-register-tab-list nav">
                        <a class="active" data-toggle="tab">
                            <h4> Verification </h4>
                        </a>
                    </div>
                    <div class="tab-content">
                        <div class="tab-pane active">
                            <div class="login-form-container">
                                <div class="login-register-form">
                                    <form action="" method="post">
                                        <?php
                                        if (isset($errors) && $errors) {
                                            foreach ($errors as $key => $error) {
                                                echo $error;
                                            }
                                        }
                                        if(isset($codeValidation) && $codeValidation){
                                            foreach ($codeValidation as $key => $error) {
                                                echo $error;
                                            }   
                                        }
                                        
                                        ?>
                                        <input type="text" name="code" placeholder="Verification Code">
                                        <div class="button-box">
                                            <button type="submit" name="verify"><span>Verify</span></button>
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
<?php
// footer==>
require_once("layouts/footer.php");
?>