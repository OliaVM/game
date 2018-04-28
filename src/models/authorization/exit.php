<?php
function do_exit() {
	if (!empty($_SESSION['id']) and isset($_SESSION['id'])) {
		if (isset($_POST['exit'])) {
			if (!empty($_SESSION['id']) and isset($_SESSION['id'])) {
				// destroy of the session
				unset($_SESSION['count']);
				session_destroy();
				   
			    //Delete the cookies
				setcookie('login', '', time()); 
				setcookie('key', '', time()); 

				header("Location: /index.php"); 
			    exit; 
			}
		}
	}
}
do_exit();


