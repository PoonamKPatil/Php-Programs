<!DOCTYPE html>
<html>
<head>
<title>change password</title>
</head>
<body>
<form method="POST" action="index.php?page=changepwd">
<br>
Old password:<input type="password" name="oldpassword" value=""><br><br>
New password:<input type="password" name="newpassword" value=""><br><br>
Confirm password:<input type="password" name="confirmpassword" value=""><br><br>
<input type="submit" value="change" name="submit" class="submit">
<?= $error;?>
</form>
</body>
</html>