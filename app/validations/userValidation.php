<?php
require_once(dirname(__DIR__) . "/database/data_base.php");

class userValidation extends database
{
    private $name;
    private $phone;
    private $email;
    private $password;
    private $confirmPassword;
    private $gender;
    private $code;
    private $oldPassword;


    /**
     * Get the value of name
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Set the value of name
     *
     * @return  self
     */
    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * Get the value of phone
     */
    public function getPhone()
    {
        return $this->phone;
    }

    /**
     * Set the value of phone
     *
     * @return  self
     */
    public function setPhone($phone)
    {
        $this->phone = $phone;

        return $this;
    }

    /**
     * Get the value of email
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * Set the value of email
     *
     * @return  self
     */
    public function setEmail($email)
    {
        $this->email = $email;

        return $this;
    }

    /**
     * Get the value of password
     */
    public function getPassword()
    {
        return $this->password;
    }

    /**
     * Set the value of password
     *
     * @return  self
     */
    public function setPassword($password)
    {
        $this->password = $password;

        return $this;
    }

    /**
     * Get the value of confirmPassword
     */
    public function getConfirmPassword()
    {
        return $this->confirmPassword;
    }

    /**
     * Set the value of confirmPassword
     *
     * @return  self
     */
    public function setConfirmPassword($confirmPassword)
    {
        $this->confirmPassword = $confirmPassword;

        return $this;
    }

    /**
     * Get the value of gender
     */
    public function getGender()
    {
        return $this->gender;
    }

    /**
     * Set the value of gender
     *
     * @return  self
     */
    public function setGender($gender)
    {
        $this->gender = $gender;

        return $this;
    }

    /**
     * Get the value of code
     */
    public function getCode()
    {
        return $this->code;
    }

    /**
     * Set the value of code
     *
     * @return  self
     */
    public function setCode($code)
    {
        $this->code = $code;

        return $this;
    }

       /**
     * Get the value of oldPassword
     */ 
    public function getOldPassword()
    {
        return $this->oldPassword;
    }

    /**
     * Set the value of oldPassword
     *
     * @return  self
     */ 
    public function setOldPassword($oldPassword)
    {
        $this->oldPassword = $oldPassword;

        return $this;
    }



    public function nameValidation()
    {
        $errors = [];
        if (empty($this->name)) {
            $errors['name'] = "<div class='alert alert-danger'> Name Required </div>";
        } else {
            $pattern = "/^([a-zA-Z]+)/";
            if (!preg_match($pattern, $this->name)) {
                $errors['name'] = "<div class='alert alert-danger'> Inavalid Name </div>";
            }
        }

        return $errors;
    }

    public function phoneValidation()
    {
        $errors = [];
        if (empty($this->phone)) {
            $errors['phone'] = "<div class='alert alert-danger'> Phone Required </div>";
        } else {
            if (!is_numeric($this->phone)) {
                $errors['phone'] = "<div class='alert alert-danger'> Invalid Phone </div>";
            }
        }
        return $errors;
    }

    public function emailValidation()
    {
        $errors = [];
        if (!$this->email) {
            $errors['email'] = "<div class='alert alert-danger'> Email Required </div>";
        } else {
            $pattern = "/^([a-zA-Z0-9_\-\.]+)@([a-zA-Z0-9_\-\.]+)\.([a-zA-Z]{2,5})$/";
            if (!preg_match($pattern, $this->email)) {
                $errors["emailPattern"] = "<div class='alert alert-danger'> Invalid Email </div>";
            }
        }
        return $errors;
    }


    public function passwordValidation()
    {
        $errors = [];
        if (!$this->password | !$this->confirmPassword) {
            $errors['password'] = "<div class='alert alert-danger'> Password and Confirm Password Required</div>";
        }

        if (empty($errors)) {
            $pattern = "/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]{8,}$/";
            if ($this->password != $this->confirmPassword) {
                $errors['match'] = "<div class='alert alert-danger'> Password doesn't match </div>";
            } else if (!preg_match($pattern, $this->password)) {
                $errors['passwordPattern'] = "<div class='alert alert-danger'>Password Minimum eight characters, at least one uppercase letter, one lowercase letter, one number and one special character</div>";
            }
        }
        return $errors;
    }

    public function genderValidation()
    {
        $errors = [];
        if (empty($this->gender)) {
            $errors['gender'] = "<div class='alert alert-danger'> Gender Required </div>";
        }
        return $errors;
    }

    //Method to check the email exist or not in database
    public function emailCheckDB()
    {
        $query = "SELECT `users`.* FROM `users` WHERE `users`.`email` = '$this->email' ";
        return $this->runDQL($query);
    }


    //Method to check the phone exist or not in database
    public function phoneCheckDB()
    {
        $query = "SELECT `users`.* FROM `users` WHERE `users`.`phone` = '$this->phone' ";
        return $this->runDQL($query);
    }

    //Method to check the code exist or not in database
    public function checkCodeDB()
    {
        $query = "SELECT `users`.* FROM `users` WHERE `users`.`email` = '$this->email' AND `users`.`code` = '$this->code' ";
        return $this->runDQL($query);
    }

    // Method to check url contain on email
    public function emailURLValidation($URL)
    {
        // check if url with key email
        if (isset($URL['email'])) {
            // check if email has value
            if ($URL['email']) {
                // check if email exists in database
                $this->setEmail($URL['email']);
                $userData = $this->emailCheckDB();
                // if email exists
                if ($userData) {
                    // return user data and fetch the data
                    return $userData->fetch_object();
                } else {
                    header("Location:404.php");
                }
            } else {
                header("Location:404.php");
            }
        } else {
            header("Location:404.php");
        }
    }

    // Method to check code input empty or invalid length 
    public function codeInputValidation($code)
    {
        $errors = [];
        if (empty($code)) {
            $errors['empty'] = "<div class='alert alert-danger'> Please Enter Your Code </div>";
        } else if (!is_numeric($code) | strlen($code) != 5) {
            $errors['invalid'] = "<div class='alert alert-danger'> Wrong Code </div>";
        }

        return $errors;
    }



    // Method to check password input empty and password pattern
    public function passwordLoginValidataion()
    {
        $errors = [];
        $pattern = "/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]{8,}$/";
        if (!$this->password) {
            $errors['empty'] = "<div class='alert alert-danger'> Password Required </div>";
        } else if (!preg_match($pattern, $this->password)) {
            $errors['passwordPattern'] = "<div class='alert alert-danger'> Wrong Email or Password </div>";
        }
        return $errors;
    }



    public function profileKeyUpdateInfoValidation()
    {
        $errors = [];
        if (!isset($_POST['name']) | !isset($_POST['phone']) | !isset($_POST['gender'])) {
            $errors['key'] = "<div class='alert alert-danger text-center'> Something Wrong </div>";
        }
        return $errors;
    }

    public function profileUpdateInfoValidation()
    {
        $errors = [];
        if (!$this->name | !$this->phone | !$this->gender) {
            $errors['empty'] = "<div class='alert alert-danger'> All Fields Required </div>";
        } else if (!preg_match("/^([a-zA-Z]+)/", $this->name)) {
            $errors['name'] = "<div class='alert alert-danger'> Invalid Name </div>";
        } else if (!is_numeric($this->phone) | strlen($this->phone) != 11) {
            $errors['phone'] = "<div class='alert alert-danger'> Invalid Phone </div>";
        } else if ( $this->gender == 'm' | $this->gender == 'f') {
            // Valid Gender
        }else {
            $errors['gender'] = "<div class='alert alert-danger'> Invalid Gender </div>";
        }
        return $errors;
    }

    public function passwordKeyValidation()
    {
        $errors = [];
        if(!isset($_POST['old-password']) | !isset($_POST['new-password']) | !isset($_POST['confirm-password']) ){
            $errors['key'] = "<div class='alert alert-danger'> Something Wrong </div>";
        }
        return $errors;
    }





    public function changePasswordValidation()
    {
        $errors = [];
        if ( !$this->oldPassword | !$this->password | !$this->confirmPassword) {
            $errors['password'] = "<div class='alert alert-danger'> All Fields Required </div>";
        }
        if (empty($errors)) {
            $pattern = "/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]{8,}$/";
            if(!preg_match($pattern, $this->oldPassword)){
                $errors['wrong'] = "<div class='alert alert-danger'> Old Password is Wrong </div>";
            } else if ($this->password != $this->confirmPassword) {
                $errors['match'] = "<div class='alert alert-danger'> Password doesn't match </div>";
            } else if ($this->oldPassword == $this->password){
                $errors['match'] = "<div class='alert alert-danger'> Can't Enter Same Password </div>";
            } else if (!preg_match($pattern, $this->password)) {
                $errors['passwordPattern'] = "<div class='alert alert-danger'> Password Minimum eight characters, at least one uppercase letter, one lowercase letter, one number and one special character</div>";
            }
        }
        return $errors;
    }
 
}
