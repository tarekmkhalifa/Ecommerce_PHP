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



if (isset($_POST['login'])) {
    $errors = [];
    if (!isset($_POST['email']) | !isset($_POST['password'])) {
        $errors['key'] = "<div class='alert alert-danger'> Please Try Again </div>";
    } else {
        $validate = new userValidation;
        $validate->setEmail($_POST['email']);
        $validate->setPassword($_POST['password']);
        $emailValidation = $validate->emailValidation();
        $passwordValidation = $validate->passwordLoginValidataion();
        if (empty($emailValidation) && empty($passwordValidation)) {
            // check the user in database or not
            $user = new User;
            $user->setEmail($_POST['email']);
            $user->setPassword($_POST['password']);
            $userLoggedin = $user->selectUsersByEmailPassword();
            // user found in database and login valid
            if ($userLoggedin) {
                // fetch data
                $userLoggedin = $userLoggedin->fetch_object();
                // check on status
                if ($userLoggedin->status == 1) {
                    // user account verified
                    // save user data in session
                    $_SESSION['user'] = $userLoggedin;
                    header("Location:index.php");
                } else if ($userLoggedin->status == 0) {
                    // user account not verified
                    // send email with the code again

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
                        $mail->Body    = '  <p> Dear ' . $userLoggedin->name . ',</p>
                                                <p> Your Verification Code is: <b>' . $userLoggedin->code . '</b></p>
                                                <p>Thank You</p>';

                        $mail->send();
                    } catch (Exception $e) {
                        echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
                    }

                    // header to check code page to verify account
                    header("Location:check-code.php?email=". $userLoggedin->email."&fp=0");
                }else{
                    $errors['dbError'] = "<div class='alert alert-danger'> Something Went Wrong </div>";
                }

            }else {
                //user not found in database
                $errors['auth'] = "<div class='alert alert-danger'> Wrong Email or Password </div>";
        } 
        }
    }
}

