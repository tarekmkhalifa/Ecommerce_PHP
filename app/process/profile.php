<?php
// Include User Class
require_once(dirname(__DIR__) . "/validations/userValidation.php");
require_once(dirname(__DIR__) . "/validations/addressValidation.php");
require_once(dirname(__DIR__) . "/models/User.php");
require_once(dirname(__DIR__) . "/models/City.php");
require_once(dirname(__DIR__) . "/models/Region.php");
require_once(dirname(__DIR__) . "/models/Address.php");

// Email CLass
//Import PHPMailer classes into the global namespace
//These must be at the top of your script, not inside a function
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

//Load Composer's autoloader
require 'vendor/autoload.php';

// Select All Data Of User From DataBase to show user information
$loggedInUser = new User;
$loggedInUser->setId($_SESSION['user']->id);
$user = $loggedInUser->selectAllData()->fetch_object();


// update info process:
if (isset($_POST['update-info'])) {
    $updateInfoErrors = [];
    // Validate on Name, Phone, Gender
    $validate = new userValidation;
    $keyValidation = $validate->profileKeyUpdateInfoValidation();
    if (empty($keyValidation)) {
        $validate->setName($_POST['name']);
        $validate->setPhone($_POST['phone']);
        $validate->setGender($_POST['gender']);
        $fieldValidation = $validate->profileUpdateInfoValidation();

        if (empty($fieldValidation)) {
            // Update Info in Database
            $userUpdate = new User;
            $userUpdate->setId($user->id);
            $userUpdate->setName($_POST['name']);
            $userUpdate->setPhone($_POST['phone']);
            $userUpdate->setGender($_POST['gender']);

            // upload photo
            // if user select photo
            if (isset($_FILES['image']) && $_FILES['image']['error'] == 0) {
                // check on size
                if ($_FILES['image']['size'] > (10 ** 6)) {
                    $updateInfoErrors['imageSize'] = "<div class='alert alert-danger'> Image must be less than 1 megabyte </div>";
                }
                // file extension
                $extension = pathinfo($_FILES['image']['name'], PATHINFO_EXTENSION);
                // allowed extensions
                $allowedExtensions = ['jpg', 'png', 'jpeg', 'JPG', 'PNG', 'JPEG'];
                // check on extension
                if (!in_array($extension, $allowedExtensions)) {
                    $updateInfoErrors['imageExt'] = "<div class='alert alert-danger'> Image Extension must be (jpg, jpeg, png) </div>";
                }

                if (empty($updateInfoErrors)) {
                    $directory = "assets/img/users/";
                    $photoName = $user->id . "-user-" . time() . "." . $extension;
                    $fullPath = $directory . $photoName;
                    // save photo in server
                    move_uploaded_file($_FILES['image']['tmp_name'], $fullPath);
                    // save photo in database
                    $userUpdate->setImage($photoName);
                    // update image in session
                    $_SESSION['user']->image = $photoName;
                }
            }

            if (empty($updateInfoErrors)) {
                // update data in database
                $result = $userUpdate->updateData();
                if ($result) {
                    // Update user infromation in session
                    // select updated user data from database first
                    $user = $loggedInUser->selectAllData()->fetch_object();
                    $_SESSION['user']->name = $user->name;
                    $_SESSION['user']->phone = $user->phone;
                    $_SESSION['user']->gender = $user->gender;
                    // show message success
                    $updateInfoErrors['success'] = "<div class='alert alert-success'> Your Information Has Been Updated Successfully </div>";
                } else {
                    // Has been error in database
                    $updateInfoErrors['dbError'] = "<div class='alert alert-danger'> Something Went Wrong Please Try Again </div>";
                }
            }
        }
    }
}


// change email process:
if (isset($_POST['change-email'])) {
    $updateEmailErrors = [];
    // validate on key
    if (!isset($_POST['email'])) {
        $updateEmailErrors['key'] = "<div class='alert alert-danger'> Something Went Wrong </div>";
    } else {
        // validate on same email
        if ($_POST['email'] == $_SESSION['user']->email) {
            $updateEmailErrors['sameEmail'] = "<div class='alert alert-danger'> You Entered Same Email </div>";
        } else {
            // validate on email value
            $validate = new userValidation;
            $validate->setEmail($_POST['email']);
            $emailValidation = $validate->emailValidation();
            if (empty($emailValidation)) {
                // check entered email has already exists in db or not
                $emailExists = new User;
                $emailExists->setEmail($_POST['email']);
                $result = $emailExists->selectUseresByEmail();
                if ($result) {
                    $updateEmailErrors['exists'] = "<div class='alert alert-danger'> This Email Has Already Register Before </div>";
                } else {
                    // generate new code and send it to old email to verify
                    $code = rand(10000, 99999);
                    // update code in database
                    $updateCode = new User;
                    $updateCode->setEmail($_SESSION['user']->email);
                    $updateCode->setCode($code);
                    $updatedCode = $updateCode->updateCode();
                    if ($updateCode) {
                        // send mail with verification code
                        //Instantiation and passing `true` enables exceptions
                        $mail = new PHPMailer(true);

                        try {
                            //Server settings
                            $mail->SMTPDebug = SMTP::DEBUG_SERVER;                      //Enable verbose debug output
                            $mail->isSMTP();                                            //Send using SMTP
                            $mail->Host       = 'smtp.gmail.com';                     //Set the SMTP server to send through
                            $mail->SMTPAuth   = true;                                   //Enable SMTP authentication
                            $mail->Username   = 'play.shop.222@gmail.com';               //SMTP username
                            $mail->Password   = 'Play@123';                               //SMTP password
                            $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;         //Enable TLS encryption; `PHPMailer::ENCRYPTION_SMTPS` encouraged
                            $mail->Port       = 465;                                    //TCP port to connect to, use 465 for `PHPMailer::ENCRYPTION_SMTPS` above

                            //Recipients
                            $mail->setFrom('play.shop.222@gmail.com', 'Play Shop');
                            $mail->addAddress($_POST['email']);               //Name is optional

                            //Content
                            $mail->isHTML(true);                                  //Set email format to HTML
                            $mail->Subject = 'Verification Code';
                            $mail->Body    = '  <p> Dear ' . $_SESSION['user']->name . ',</p>
                            <p> Your Verification Code to update your email is: <b>' . $code . '</b></p>
                            <p>Thank You</p>';

                            $mail->send();
                        } catch (Exception $e) {
                            echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
                        }
                        // save new email in session
                        $_SESSION['new-mail'] = $_POST['email'];
                        // redirect to check-code page with fp = 2 to update email
                        header("Location:check-code.php?email=" . $_SESSION['user']->email . "&fp=2");
                    } else {
                        $updateEmailErrors['dbError'] = "<div class='alert alert-danger'> Something Went Wrong </div>";
                    }
                }
            }
        }
    }
}

// change password process:
if (isset($_POST['change-password'])) {
    $updatePasswordErrors = [];
    // validate on keys of inputs
    $validate = new userValidation;
    $passwordKeyValidation = $validate->passwordKeyValidation();
    if (empty($passwordKeyValidation)) {
        // validate on passwords
        $validate->setOldPassword($_POST['old-password']);
        $validate->setPassword($_POST['new-password']);
        $validate->setConfirmPassword($_POST['confirm-password']);
        $passwordValidation = $validate->changePasswordValidation();
        if (empty($passwordValidation)) {
            // check on old password in database
            $userPasswordUpdate = new User;
            $userPasswordUpdate->setEmail($user->email);
            $userPasswordUpdate->setPassword($_POST['old-password']);
            $selectUser = $userPasswordUpdate->selectUsersByEmailPassword();
            // Old Password Exist
            if ($selectUser) {
                // update password in database
                $userPasswordUpdate->setId($user->id);
                $userPasswordUpdate->setPassword($_POST['new-password']);
                $result = $userPasswordUpdate->updatePasswordByID();
                if ($result) {
                    $updatePasswordErrors['success'] = "<div class='alert alert-success'> Your Password Has Been Changed Successfuly</div>";
                    // update password in session
                    $_SESSION['user']->password = $userPasswordUpdate->getPassword();
                } else {
                    $updatePasswordErrors['dbError'] = "<div class='alert alert-danger'> Something Went Wrong Please try again</div>";
                }
            } else {
                // Old Password Not Exists
                $updatePasswordErrors['wrongPassword'] = "<div class='alert alert-danger'> Wrong Password </div>";
            }
        }
    }
}

// add new address
if(isset($_POST['add-address'])){
    $addAddressErrors = [];
    // validate on keys
    $addressValidate = new addressValidation;
    $addressKeyValidation = $addressValidate->addressKeyValidation();
    if(empty($addressKeyValidation)){
        // validate on values
        $addressValidate->setStreet($_POST['street']);
        $addressValidate->setBuilding($_POST['building']);
        $addressValidate->setFloor($_POST['floor']);
        $addressValidate->setFlat($_POST['flat']);
        $addressValidate->setRegion_id($_POST['region_id']);
        $addressValidation = $addressValidate->addressValidation();
        if(empty($addressValidation)){
            // insert into database
            $addAddress = new Address;
            $addAddress->setStreet($_POST['street']);
            $addAddress->setBuilding($_POST['building']);
            $addAddress->setFloor($_POST['floor']);
            $addAddress->setFlat($_POST['flat']);
            $addAddress->setRegion_id($_POST['region_id']);
            $addAddress->setDetails($_POST['details']);
            $addAddress->setUser_id($_SESSION['user']->id);
            $result = $addAddress->insertData();
            if($result){
                $addAddressErrors['success'] = "<div class='alert alert-success'> Your Address Has Been Added Successfully</div>";
            }else {
                $addAddressErrors['dbError'] = "<div class='alert alert-danger'> Something Went Wrong Please Try Again</div>";
            }

        }

    }
}

// edit address
if(isset($_POST['edit-address'])){
    $editAddressErrors = [];
    // validate on keys
    $editAddress = new addressValidation;
    $addressKeyEdit = $editAddress->addressKeyValidation();
     if(empty($addressKeyEdit)){
        // validate on Values
        $editAddress->setStreet($_POST['street']);
        $editAddress->setBuilding($_POST['building']);
        $editAddress->setFloor($_POST['floor']);
        $editAddress->setFlat($_POST['flat']);
        $editAddress->setRegion_id($_POST['region_id']);
        $addressEditValidation = $editAddress->addressValidation();
        // print_r($addressEditValidation);die;
        if(empty($addressEditValidation)){
            // update address in database
            $updateAddress = new Address;
            $updateAddress->setId($_POST['edit-address']);
            $updateAddress->setStreet($_POST['street']);
            $updateAddress->setBuilding($_POST['building']);
            $updateAddress->setFloor($_POST['floor']);
            $updateAddress->setFlat($_POST['flat']);
            $updateAddress->setRegion_id($_POST['region_id']);
            $updateAddress->setDetails($_POST['details']);
            $result = $updateAddress->updateData();
            if($result){
                $editAddressErrors['success'] = "<div class='alert alert-success'> Your Address Updated Successfully </div>";
            }else {
                $editAddressErrors['dbError'] = "<div class='alert alert-danger'> something Went Wrong Please Try Again </div>";
            }
        }

    }
}

// delete address
if(isset($_POST['delete-address'])){
    $deleteAddreessErrros = [];
    $deleteAddress = new Address;
    $deleteAddress->setId($_POST['delete-address']);
    $result = $deleteAddress->deleteData();
    if($result){
        $deleteAddreessErrros['success'] = "<div class='alert alert-success'> Your Address Has Been Deleted Successfully</div>";
    }else {
        $deleteAddreessErrros['dbError'] = "<div class='alert alert-success'> Something Went Wrong Please Try Again</div>";
    }
}


// Select All Cities From DataBase
$allCities = new City;
$cities = $allCities->selectAllData()->fetch_all(MYSQLI_ASSOC);


// Select All Regions From DataBase
$allRegions = new Region;



// Select All Addresses of User From DataBase to show address information
$address = new Address;
$address->setUser_id($user->id);
$userAddress = $address->userAddressesByID();
if($userAddress){
    $userAddress = $userAddress->fetch_all(MYSQLI_ASSOC);
}