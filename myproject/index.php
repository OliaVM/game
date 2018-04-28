<?php 
ini_set('session.cookie_lifetime', 900); //session closed from 10 minutes
session_start();
$cookielifetime = ini_get("session.cookie_lifetime");

//Connection with database
$user = 'vagrant';
$password = 'vagrant';
$dns = 'mysql:host=localhost; dbname=myproject';

$сonnection_db = new PDO($dns, $user, $password);
$сonnection_db->exec("set names utf8");

//router (add template)
//path from template.php to our page
if (isset($_GET['page_name'])) {
	$page_name = $_GET['page_name'];
	switch ($_GET['page_name']) {
		case 'authorization_page':
		$path = "/../../pages/";
		break;
		case 'duel_page':
		$path = "/../../pages/";
		break;
	}
}
else {
	$page_name = "content";
	$path = "/";
}


//Add Model, View, Controller of AUTHORIZATION
require_once __DIR__ .'/../src/models/authorization/authorization.php'; 
require_once __DIR__ .'/../src/views/authorizationView.php'; 
require_once __DIR__ .'/../src/controllers/AuthorizationController.php';
require_once __DIR__ . '/../src/models/authorization/cookies.php';

//exit
require_once __DIR__ . '/../src/models/authorization/exit.php';

//duel
require_once __DIR__ .'/../src/models/duelModel.php'; 
require_once __DIR__ .'/../src/views/duelView.php'; 
require_once __DIR__ .'/../src/controllers/duelController.php';

//main - show template
require_once __DIR__ .'/../src/views/mainPageView.php'; 
require_once __DIR__ .'/../src/controllers/mainPageController.php';

$controller = new MainPageController();
$controller->actionMainPage($сonnection_db, $page_name, $path);




	

