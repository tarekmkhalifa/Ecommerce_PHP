<?php
// header ==>
require_once("layouts/header.php");
// middllware ==> only default useres can enter logged in useres can't
require_once("app/middllwares/guest.php");
// navBar ==>
require_once("layouts/nav.php");
// Registeration Process ==>
require_once("app/process/register.php");
?>
<!-- Breadcrumb Area Start -->
<div class="breadcrumb-area bg-image-3 ptb-150">
    <div class="container">
        <div class="breadcrumb-content text-center">
            <h3>Register</h3>
            <ul>
                <li><a href="index.php">Home</a></li>
                <li class="active">Register</li>
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
                            <h4> register </h4>
                        </a>
                    </div>
                    <div class="tab-content">
                        <div class="tab-pane active">
                            <div class="login-form-container">
                                <div class="login-register-form">
                                    <div>
                                        <?php 
                                        if (isset($errors) && $errors) {
                                            foreach ($errors as $key => $error) {
                                            echo $error;}} 
                                        ?>
                                    </div>
                                    <form action="" method="post">
                                        <?php                                           
                                            if (isset($nameValidation) && $nameValidation) {
                                                foreach ($nameValidation as $key => $value) {
                                                echo $value;}} ?>
                                        <input type="text" name="name" placeholder="Name" value="<?php if(isset($_POST['name'])){ echo $_POST['name'];}?>">
                                        <?php if (isset($phoneValidation) && $phoneValidation) {    
                                                foreach ($phoneValidation as $key => $value) {
                                                echo $value; } } ?>
                                        <input type="phone" name="phone" placeholder="Phone" value="<?php if(isset($_POST['phone'])){ echo $_POST['phone'];}?>">
                                        <?php
                                              if (isset($emailValidation) && $emailValidation) {
                                                foreach ($emailValidation as $key => $value) {
                                                echo $value; } } ?>
                                        <input type="text" name="email" placeholder="Email" value="<?php if(isset($_POST['email'])){ echo $_POST['email'];}?>">
                                        <?php
                                             if (isset($passwordValidation) && $passwordValidation) {
                                                foreach ($passwordValidation as $key => $value) {
                                                echo $value; } } ?>
                                        <input type="password" name="password" placeholder="Password">

                                        <input type="password" name="confirmPassword" placeholder="Confirm Password">
                                        <?php
                                               if (isset($genderValidation) && $genderValidation) {
                                                 foreach ($genderValidation as $key => $value) {
                                                 echo $value; } } ?>
                                        <select class="form-control mb-4" name="gender">
                                            <option value="m" <?php if(isset($_POST['gender']) && $_POST['gender'] === "m"){ echo "selected";}?> >male</option>
                                            <option value="f" <?php if(isset($_POST['gender']) && $_POST['gender'] === "f"){ echo "selected";}?> >female</option>
                                        </select>
                                        <div class="button-box">
                                            <button type="submit" name="register"><span>Register</span></button>
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