<?php
//verify of existence of COOKIEs
if (empty($_SESSION['auth']) or $_SESSION['auth'] == false) {
	//Проверяем, не пустые ли куки - If a cookies is not empty
	if (!empty($_COOKIE['login']) and !empty($_COOKIE['key']) ) {
		//Save the login and key from the COOKIE to the variables
		$login = $_COOKIE['login']; 
		$key = $_COOKIE['key']; //ключ из кук (аналог пароля в базе данных)
		$sql = 'SELECT * FROM users WHERE login="'.$login.'" AND cookie="'.$key.'"';
		$sth = $сonnection_db->query($sql);
		$rowUser = $sth->fetch(PDO::FETCH_ASSOC); // array with data table 	
		//Если база данных вернула не пустой ответ - значит пара логин-ключ к кукам подошла
		//If the database returned not empty response - login and key from cookies no true
		if (!empty($rowUser)) {
			//Сохраняем в сессию информацию о том, что мы авторизовались
			$_SESSION['auth'] = true; 
			$_SESSION['id'] = $rowUser['id']; 
			$_SESSION['login'] = $rowUser['login']; 
			$_SESSION['role'] = $rowUser['role']; 
		}
	}
}