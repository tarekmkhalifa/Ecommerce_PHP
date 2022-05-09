<?php
// header ==>
require_once("layouts/header.php");
// middllware ==> only default useres can enter logged in useres can't
require_once("app/middllwares/guest.php");
// navBar ==>
require_once("layouts/nav.php");
// login Process ==>
require_once("app/process/login.php");
?>

<!-- Breadcrumb Area Start -->
<div class="breadcrumb-area bg-image-3 ptb-150">
    <div class="container">
        <div class="breadcrumb-content text-center">
            <h3>LOGIN</h3>
            <ul>
                <li><a href="index.php">Home</a></li>
                <li class="active">Login</li>
            </ul>
        </div>
    </div>
</div>
<!-- Breadcrumb Area End -->
<div class="login-register-area ptb-100">
    <div class="container">
        <div class="row">
            <div class="col-lg-7 col-md-12 ml-auto mr-auto">
                <div class="login-register-wrapper">
                    <div class="login-register-tab-list nav">
                        <a class="active" data-toggle="tab">
                            <h4> login </h4>
                        </a>
                    </div>
                    <div class="tab-content">
                        <div id="lg1" class="tab-pane active">
                            <div class="login-form-container">
                                <div class="login-register-form">
                                    <form action="" method="post">
                                        <?php
                                        if (isset($errors) && $errors) {
                                            foreach ($errors as $key => $error) {
                                                echo $error;
                                            }
                                        }

                                        ?>
                                        <input type="text" name="email" placeholder="Enter Your Email" value="<?php if(isset($_POST['email']) && $_POST['email']) { echo $_POST['email'];} ?>">
                                        <?php
                                        if (isset($emailValidation) && $emailValidation) {
                                            foreach ($emailValidation as $key => $error) {
                                                echo $error;
                                            }
                                        }
                                        ?>

                                        <input type="password" name="password" placeholder="Password">
                                        <?php
                                        if (isset($passwordValidation) && $passwordValidation) {
                                            foreach ($passwordValidation as $key => $error) {
                                                echo $error;
                                            }
                                        }
                                        ?>
                                        <div class="button-box">
                                            <div class="login-toggle-btn">
                                                <a href="verify-email.php">Forgot Password?</a>
                                            </div>
                                            <button type="submit" name="login"><span>Login</span></button>
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