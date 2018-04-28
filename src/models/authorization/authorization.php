<?php
// Authorization
class AuthClassModel {
	public function formSendingControl($сonnection_db) {
		try {
			if (isset($_POST['submit_avtorization'])) {
				//If the fields username and password filled
				if (empty($_REQUEST['password']) || empty($_REQUEST['login'])) {
					throw new Exception('Запоните все поля!');
				}
				$login = $_REQUEST['login']; 
				$password = $_REQUEST['password']; 
				$sql = 'SELECT * FROM users WHERE login="'.$login.'"';
				$sth = $сonnection_db->query($sql);
				$rowUser = $sth->fetch(PDO::FETCH_ASSOC); 
				$this->loginExistenceControl($rowUser, $password, $login, $сonnection_db);
			}
		}
		catch (Exception $ex) {
			$exAvtoriz = $ex->getMessage();
			return $exAvtoriz;
		}
	}

	public function loginExistenceControl($rowUser, $password, $login, $connection_db) {
		//If the database returned a non-empty answer, it means this login exist
		if (!isset($rowUser['login'])) {
			throw new Exception('Пользователь с таким именем не зарегистрирован');
		}
		//Salt the password from the form
		$salt = $rowUser['salt'];
		$saltedPassword = md5($password.$salt);
		$this->userPasswordControl($rowUser, $saltedPassword, $login, $connection_db);
	}	

	public function userPasswordControl($rowUser, $saltedPassword, $login, $connection_db) {
		if ($rowUser['password'] !== $saltedPassword) {		
		    throw new Exception('Не верно введен логин или пароль');
		}
		//If salt password from the database matches with the salted password from the form
		// Write to the session information about avtorization
		$_SESSION['auth'] = true; 
		$_SESSION['id'] = $rowUser['id']; 
		$_SESSION['login'] = $rowUser['login']; 
		$_SESSION['password'] = $rowUser['password']; 
		$_SESSION['role'] = $rowUser['role']; 
		$_SESSION['count_attack_from_attaker'] = 0;
		$_SESSION['attack_from_enemy'] = 0; 
		$this->setUserCookie($rowUser, $login, $connection_db);
		$this->getSessionCount();
		//echo "вы авторизованы";

		//get time of user activity
		//Определяем время последней активности пользователя (сколько времени прошло в сеундах с 1 января 1970 года до момента последней активности пользовател). 
		if (isset($_POST['time'])) {
			$_SESSION['time'] = time(); //enter time 
			$sql_select = "SELECT * FROM user_activity where user_id=:user_id";
			$sth = $connection_db->prepare($sql_select);
			$sth->bindParam(':user_id', $_SESSION['id']);
			$sth->execute();
			$row = $sth->fetch(PDO::FETCH_ASSOC);

			if (!empty($row)) {
				$sql_update = 'UPDATE user_activity SET last_activity_time=:last_activity_time WHERE user_id=:user_id';
				$prep = $connection_db->prepare($sql_update);
				$prep->bindValue(':user_id', $_SESSION['id'], PDO::PARAM_INT);
				$prep->bindValue(':last_activity_time', $_SESSION['time'], PDO::PARAM_INT);
				$prep->execute(); 
			}
			else {
				$sql ="INSERT INTO user_activity (user_id, last_activity_time) VALUES (:user_id, :last_activity_time)"; 
				$prep = $connection_db->prepare($sql);
				$prep->bindValue(':user_id', $_SESSION['id'], PDO::PARAM_INT);
				$prep->bindValue(':last_activity_time', $_SESSION['time'], PDO::PARAM_INT);
				$prep->execute(); 
			}
		}
		header("Location: /index.php");
	}

	public function setUserCookie($rowUser, $login, $connection_db) {
		//Verify whether the checkbox 'Remember me' is clicked 
		if (!empty($_REQUEST['remember']) and $_REQUEST['remember'] == 1 ) {
			$key = $this->generateSalt(); 
			setcookie('login', $rowUser['login'], time()+60*60*24*30); 
			setcookie('key', $key, time()+60*60*24*30); 
			$sql = 'UPDATE users SET cookie="'.$key.'" WHERE login="'.$login.'"';
			$сonnection_db->query($sql);
		}
	}

	public function getSessionCount() {
		//Counter sessions
		if (!isset($_SESSION['count'])) {
			$_SESSION['count'] = 0;
		}	
		else {
			$_SESSION['count']++;  
		}	
	}
	

	public function generateSalt() {
			$salt = '';
			$saltLength = 8; 
			for($i=0; $i<$saltLength; $i++) {
				$salt .= chr(mt_rand(33,126)); 
				return $salt;
			}
	}
}