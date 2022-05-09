<?php
// userValidation Class==>
require_once(dirname(__DIR__) . "/validations/userValidation.php");
// user Model ==>
require_once(dirname(__DIR__) . "/models/User.php");

//Import PHPMailer classes into the global namespace
//These must be at the top of your script, not inside a function
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

//Load Composer's autoloader
require 'vendor/autoload.php';


// Registeration process:
// check if the form have been submitted or not
if (isset($_POST['register'])) {



    $errors = [];
    // check if the user change the form keys or not
    // if user change the key
    if ((!isset($_POST['name']))  | (!isset($_POST['phone'])) |
        (!isset($_POST['email'])) | (!isset($_POST['password'])) |
        (!isset($_POST['confirmPassword'])) | (!isset($_POST['gender']))
    ) {
        $errors['key'] = "<div class='alert alert-danger'> Something Wrong </div>";
    } else {
        /// if keys are valid

        // validation stage
        $validation = new userValidation;
        // get data from post array
        $validation->setName($_POST['name']);
        $validation->setPhone($_POST['phone']);
        $validation->setEmail($_POST['email']);
        $validation->setPassword($_POST['password']);
        $validation->setConfirmPassword($_POST['confirmPassword']);
        $validation->setGender($_POST['gender']);
        // validate on it
        $nameValidation = $validation->nameValidation();
        $phoneValidation = $validation->phoneValidation();
        $emailValidation = $validation->emailValidation();
        $passwordValidation = $validation->passwordValidation();
        $genderValidation = $validation->genderValidation();

        if (
            // if methods return emtpy array so data are valid
            empty($nameValidation) && empty($phoneValidation) && empty($emailValidation) &&
            empty($passwordValidation) && empty($genderValidation)
        ) {
            // check if the email and phone already on the database or not
            $emailExist = $validation->emailCheckDB();
            $phoneExist = $validation->phoneCheckDB();
            // if the email is already exist
            if ($emailExist) {
                $errors['emailExist'] = "<div class='alert alert-danger'> Email Already Exists </div>";
                // if the phone is already exist
            } else if ($phoneExist) {
                $errors['phoneExist'] = "<div class='alert alert-danger'> Phone Already Exists </div>";
            }else {
                // if email and phone are new
                // save user into db
                $user = new User;
                $user->setName($_POST['name']);
                $user->setPhone($_POST['phone']);
                $user->setEmail($_POST['email']);
                $user->setPassword($_POST['password']);
                $user->setGender($_POST['gender']);
                // create code then save in database to check it later
                $code = rand(10000, 99999);
                $user->setCode($code);
                $resultUser = $user->insertData();
                // if data inserted
                if ($resultUser) {
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
                        $mail->Body    = '  <p> Dear ' . $_POST['name'] . ',</p>
                            <p> Your Verification Code is: <b>' . $code . '</b></p>
                            <p>Thank You</p>';

                        $mail->send();
                    } catch (Exception $e) {
                        echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
                    }
                    // redirect to check-code page
                    // send email entered in URL
                    header('Location:check-code.php?email='. $_POST['email']."&fp=1");
                } else {
                    // if data not inserted into database
                    $errors['dbError'] = "<div class='alert alert-danger'> Something Went Wrong Please try Again </div>";
                }
            }
        }
    }
}
