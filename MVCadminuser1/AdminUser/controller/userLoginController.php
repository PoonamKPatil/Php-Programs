<?php
    session_start();
    ob_start();
?>
<?php
include("../Model/DbClass.php");
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (empty($_POST["name"])) {
        $nameErr = "Enter username";
    } 
    else {
        $name=$_POST['name'];
    }
    if(empty($_POST["password"])) {
        $passwordErr="Enter password";
    }
    else {
        $password=$_POST['password'];
    } 
 }

$dbClass = new DBcontroller();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if(empty($nameErr) && empty($emailErr) && empty($contactErr) && empty($passwordErr) && empty($confirmpasswordErr)) {   
        $qry="select username,password,role_id,status from usersInformation where username = '".$name."'";
        $userResult= $dbClass->runQry($qry) or die($qry."<br/><br/>".mysqli_error($connect));
        $rows = mysqli_fetch_array($userResult);
  // echo $rows['password']."<br>";
  // echo md5($password);
        if($rows['role_id']==1) {
            $error= "You are not user<br>";
        }
        else if ($rows['password']==md5($password) && $rows['status']==1) {
    	    $_SESSION['username']=$name;
            header("location:../view/userdashboard.php");
        }
        else {
    	    $error= "Invalid username or password<br>";
        }
    } 
   // echo $rows['username'];   
 ob_end_flush();  

}
include("../view/UserLoginPage.php"); 
?>