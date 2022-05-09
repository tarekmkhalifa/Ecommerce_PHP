<?php
require_once(dirname(__DIR__) . "/validations/userValidation.php");
require_once(dirname(__DIR__) . "/models/User.php");

//Import PHPMailer classes into the global namespace
//These must be at the top of your script, not inside a function
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

//Load Composer's autoloader
require 'vendor/autoload.php';



if (isset($_POST['verify'])) {
    $errors = [];
    if (!isset($_POST['email'])) {
        $errors['key'] = "<div class='alert alert-danger'> Something Wrong </div> ";
    } else {
        $validate = new userValidation;
        $validate->setEmail($_POST['email']);
        $validation = $validate->emailValidation();
        if (empty(($validation))) {
            $emailCheck = new userValidation;
            $emailCheck->setEmail($_POST['email']);
            $emailChecked = $emailCheck->emailCheckDB();
            if ($emailChecked) {
                // generate new code
                $code = rand(10000, 99999);
                // update code in db
                $upCode = new User;
                $upCode->setEmail($_POST['email']);
                $upCode->setCode($code);
                $result = $upCode->updateCode();
                if ($result) {
                    // get data of user
                    $user = $emailChecked->fetch_object();

                    // send email with code
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
                        $mail->Body    = '  <p> Dear ' . $user->name . ',</p>
                                                <p> Your Verification Code is: <b>' . $code . '</b></p>
                                                <p>Thank You</p>';

                        $mail->send();

                        // header to check-code page
                        header("Location:check-code.php?email=". $user->email."&fp=1");
                    } catch (Exception $e) {
                        echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
                    }
                } else {
                    $errors['dbError'] = "<div class='alert alert-danger'> Something Wrong </div> ";
                }
            } else {
                $errors['wrongEmail'] = "<div class='alert alert-danger'> Wrong Email </div> ";
            }
        }
    }
}

?>