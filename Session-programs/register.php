<DOCTYPE html!>
<html>
<head>
<title>
Registration form
</title>
<style type="text/css">
.error {color: #FF0000;}
.submit{
   background-color: #5A5256;/* Green */
    border:none;
    color: white;
    padding: 10px 20px;
    text-align: center;
    text-decoration: none;
    display: inline-block;
    margin: 4px 2px;
    cursor: pointer;
}
</style>
</head>
<body>
<?php
include("validation.php");
include("DB_configuration.php");

if(isset($_POST['submit']) && empty($nameErr) && empty($emailErr) && empty($contactErr) && empty($passwordErr) && empty($confirmpasswordErr))
{

    $insert_users_query = "INSERT INTO usersInformation (username, password, email,contact)
     VALUES ('$name','$pwd','$email','$contact')";
     //echo $insert_users_query;
    if(mysqli_query($connect,$insert_users_query))
    {
        echo "succesfully inserted";

    }
    else
    {
        echo "error while inserting data ";
    }

        
}
?>
<form method="POST" action="">
Name:<input type="text" name="name" value="<?php echo $name?>"><span class=error>*<?php echo $nameErr ?></span><br><br>
Password:<input type="password" name="password" value="<?php echo $password?>"><span class=error>*<?php echo $passwordErr ?></span><br><br>
confirm Password:<input type="password" name="confirmpassword" value="<?php echo $confirmpassword?>">*<span class=error>
<?php echo $confirmpasswordErr ?></span>
<br><br>
Email:<input type="text" name="email" value="<?php echo $email?>"><span class=error>*<?php echo $emailErr ?></span><br><br>
Phone Number:<input type="text" name="contact" value="<?php echo $contact?>"><span class=error>*<?php echo $contactErr ?></span><br><br>
<input type="submit" value="submit" name="submit" class="submit">
</form>
</body>
</html>