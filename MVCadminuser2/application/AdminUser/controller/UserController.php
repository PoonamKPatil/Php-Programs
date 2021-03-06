<?php
namespace Compassite\controller;

use Compassite\Model\Person;
use Compassite\Model\Admin;
use Compassite\Model\User;
use Compassite\Model\Validation;

class  UserController
{
    public function loginValidation() 
    {
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            if (empty($nameErr) && 
                empty($emailErr) && 
                empty($contactErr) && 
                empty($passwordErr) && 
                empty($confirmpasswordErr)
               ) {  
                   $adminObj=new User();
                   $result=$adminObj->getUserByName($_POST['name']);
                   
                   if ($result['role_id']==ADMINROLEID) {
                       $error= "You are not user<br>";
                    } else if ($result['password']==md5($_POST['password']) && $result['status']==ACTIVE) {
    	                $_SESSION['username']=$_POST['name'];
                         header("location:".APP_URL."/index.php?page=userdashboard");
                    } else {
    	                $error= "Invalid username or password<br>";
                    }
                  } 
  
        }
        include("/var/www/html/Php-Programs/MVCadminuser2/application/AdminUser/view/UserLoginPage.php");

    }


    public function userChangePassword()
    {
        include("/var/www/html/Php-Programs/MVCadminuser2/application/AdminUser/view/userdashboard.php");
        $userObj = new User();
        $user=$userObj->viewProfile($_SESSION['username']);

        if (isset($_POST['submit'])) {
            if(!empty($_POST['newpassword']) &&
               !empty($_POST['confirmpassword']) &&
               !empty($_POST['oldpassword']) && 
               ($_POST['newpassword']==$_POST['confirmpassword'])
              ) {
                  if($userObj->checkPassword(md5($_POST['oldpassword']))) {
                      $uid=$userObj->getUserIdByname($_SESSION['username']);
                      $userObj->changePassword($uid,md5($_POST['newpassword']));
                      header("location:/var/www/html/Php-Programs/MVCadminuser2/application/AdminUser/view/UserLoginPage.php");
                   } else {
                       echo "provide correct details";
                   }
                } else {
                    echo "empty field or new password and confirm password doesnt match";
                }
           }
        include("/var/www/html/Php-Programs/MVCadminuser2/application/AdminUser/view/userchangepassword.php");
        

    }


    public function registerUser()
    {
        if (isset($_POST['submit']) && 
            empty($nameErr) && 
            empty($emailErr) && 
            empty($contactErr) && 
            empty($passwordErr) && 
            empty($confirmpasswordErr)
           ) {
               $person = new Person($name,$pwd,$email,$contact,2);
               if($person->insert($person)) {
                   header("location:/var/www/html/Php-Programs/MVCadminuser2/application/AdminUser/view/UserLoginPage.php");
                }
        }
        include("/var/www/html/Php-Programs/MVCadminuser2/application/AdminUser/view/registrationForm.php");
    }

    public function viewProfile()
    {
            include("/var/www/html/Php-Programs/MVCadminuser2/application/AdminUser/view/userdashboard.php");

            echo "<h3 style=\"color:#4CAF50\";>Your Details:</h3>";
            $userObj = new Person();
            $user=$userObj->viewProfile($_SESSION['username']);

            echo "Name:".$user['username'];
            echo "<br>Email:".$user['email'];
            echo "<br>Contact:".$user['contact'];
         
    }


    public function editUser()
    {
            
            $userObj = new User();
            $user=$userObj->viewProfile($_SESSION['username']);
            $uid=$userObj->getUserIdByname($_SESSION['username']);
            //var_dump($_POST);
            //exit();
            if (isset($_POST['submit']) && 
                empty($nameErr) && 
                empty($emailErr) && 
                empty($conatctErr)
               ) {
                   if ($userObj->editProfile($uid,$_POST['name'],$_POST['email'],$_POST['contact'])) {
                       $_SESSION['username']=$_POST['name'];
                       echo "succesffuly updated";
                    }
            }
            include("/var/www/html/Php-Programs/MVCadminuser2/application/AdminUser/view/userdashboard.php");

            include("/var/www/html/Php-Programs/MVCadminuser2/application/AdminUser/view/edituserform.php");
    }

}
