<?php
namespace Compassite\controller;

class HomeController
{
	public function welcome()
	{
		include("/var/www/html/Php-Programs/MVCPDO/application/AdminUser/view/welcome.php");
		//header("location:".APP_URL."/application/AdminUser/view/admindashboard.php");
	}
}