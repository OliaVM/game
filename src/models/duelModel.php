<?
class DuelModel {
	//search enemy in online users
	public function search_enemy($сonnection_db) {
		//Определяем сколько секунд прошло с момента последней активности до настоящего времени (в секундах) - $after_last_activity_time = (time() - $_SESSION['time']); 
		$sql_select = "SELECT * FROM user_activity WHERE status_already_play_in_game = 0 AND last_activity_time > :last_activity_time AND user_id != :user_id"; //
		$last_activity_time = time() - 5*60;
		$prep = $сonnection_db->prepare($sql_select);
		$prep->bindParam(':user_id', $_SESSION['id'], PDO::PARAM_INT);
		$prep->bindParam(':last_activity_time', $last_activity_time, PDO::PARAM_INT);
		$prep->execute();
		$rowsUsersOnline = $prep->fetchAll(); 
		$count_users_online = count($rowsUsersOnline);
		try {
			if ($count_users_online < 1) {
				throw new Exception('Противников не надено');
			}
			else if ($count_users_online > 1) {
				$number_enemy = rand(0, $count_users_online);
				$enemy = $rowsUsersOnline[$number_enemy];
			} 
			else { //if ($count_users_online == 1)
				$enemy = $rowsUsersOnline[0];
			}
			$enemy_id = $enemy['user_id'];
			$enemy_id = (int) $enemy_id;
			return $enemy_id;
		}
		catch (Exception $exSearch) {
			return $exSearch->getMessage();
		}
	}
	
	//start game
	//show enemy-user
	public function show_enemy($сonnection_db, $enemy_id_or_exception) {
		$sql_select_enemy = "SELECT r.user_id, r.rating, r.loss, r.life, u.image, u.login FROM results r INNER JOIN users u ON r.user_id = u.id WHERE r.user_id = :enemy_id";
		$prep = $сonnection_db->prepare($sql_select_enemy);
		$prep->bindValue(':enemy_id', $enemy_id_or_exception, PDO::PARAM_INT); 
		$prep->execute();
		$rowEnemy = $prep->fetch(PDO::FETCH_ASSOC); 
		return $rowEnemy;
	}

	//show attacker-user 
	public function show_attacker($сonnection_db) {
		//$sql_select_attacker = "SELECT * FROM results WHERE user_id = :user_id";
		$sql_select_attacker = "SELECT r.user_id, r.rating, r.loss, r.life, u.image, u.login FROM results r INNER JOIN users u ON r.user_id = u.id WHERE r.user_id = :user_id";
		$prep = $сonnection_db->prepare($sql_select_attacker); 
		$prep->bindValue(':user_id', $_SESSION['id'], PDO::PARAM_INT);
		$prep->execute();
		$rowAttacker = $prep->fetch(PDO::FETCH_ASSOC);
		return $rowAttacker;
	}


	function start_attack_from_attaker($сonnection_db, $rowEnemy, $rowAttacker) {
		if (isset($_POST['attack_from_attaker'])) {
			$_SESSION['count_attack_from_attaker'] = $_SESSION['count_attack_from_attaker'] + 1;
			$loss_of_enemy_log = $rowAttacker['login'] . " нанес " . $rowEnemy['login'] . " ". $_SESSION['count_attack_from_attaker'] . " урона";
			return $loss_of_enemy_log;
		}
	}

	function start_attack_from_enemy($сonnection_db, $rowEnemy, $rowAttacker) {
		if (isset($_POST['attack_from_enemy'])) {
			$_SESSION['attack_from_enemy'] = $_SESSION['attack_from_enemy'] + 1;
			$loss_of_attaker_log = $rowEnemy['login'] . " нанес " . $rowAttacker['login'] . " ". $_SESSION['count_attack_from_enemy'] . " урона";
			return $loss_of_attaker_log;
		}
	}

	function end_attack($сonnection_db, $rowEnemy, $rowAttacker) {
		if (($_SESSION['count_attack_from_attaker'] > 4) || ($_SESSION['attack_from_enemy'] > 9)) {
			$loss_of_attaker = $_SESSION['attack_from_enemy'] + 1 + $rowAttacker['loss'];
			$loss_of_enemy = $_SESSION['count_attack_from_attaker'] + 1 + $rowEnemy['loss'];
			
			$life_of_attaker = $rowAttacker['life'];
			$life_of_enemy = $rowEnemy['life'];
			$life_of_attaker = $life_of_attaker + 1;
			$life_of_enemy = $life_of_enemy + 1;
			
			$_SESSION['count_attack_from_attaker'] = 0;
			$_SESSION['attack_from_enemy'] = 0; 
			
			//who is win
			$rating_of_attaker = $rowAttacker['rating'];
			$rating_of_enemy = $rowEnemy['rating'];
			if ($loss_of_attaker < $loss_of_enemy) {
				$winner = $rowAttacker['login'];
				$rating_of_attaker = $rating_of_attaker + 1;
			} else {
				$winner = $rowEnemy['login'];
				$rating_of_enemy = $rating_of_enemy + 1;
			}

			//add attacker-user and enemy-user from log_of_games
			$sql="INSERT INTO log_of_games (attacker_id, enemy_id, loss_of_attaker, loss_of_enemy, life_of_attaker, life_of_enemy, rating_of_attaker, rating_of_enemy) VALUES (:attacker_id, :enemy_id, :loss_of_attaker, :loss_of_enemy, :life_of_attaker, :life_of_enemy, :rating_of_attaker, :rating_of_enemy)"; 
			$prep = $сonnection_db->prepare($sql);
			$prep->bindValue(':attacker_id', $_SESSION['id'], PDO::PARAM_INT);
			$prep->bindValue(':enemy_id', $rowEnemy['user_id'], PDO::PARAM_INT);
			$prep->bindValue(':loss_of_attaker', $loss_of_attaker, PDO::PARAM_INT);
			$prep->bindValue(':loss_of_enemy', $loss_of_enemy, PDO::PARAM_INT);
			$prep->bindValue(':life_of_attaker', $life_of_attaker, PDO::PARAM_INT);		
			$prep->bindValue(':life_of_enemy', $life_of_enemy, PDO::PARAM_INT);
			$prep->bindValue(':rating_of_attaker', $rating_of_attaker, PDO::PARAM_INT);
			$prep->bindValue(':rating_of_enemy', $rating_of_enemy, PDO::PARAM_INT);
			$arr = $prep->execute();

			//add to results table
			$sql="UPDATE results SET loss =:loss, life =:life, rating =:rating WHERE user_id = :user_id"; 
			$prep = $сonnection_db->prepare($sql);
			echo "потери " .$loss_of_enemy;
			$prep->bindValue(':user_id', $rowEnemy['user_id'], PDO::PARAM_INT);
			$prep->bindValue(':loss', $loss_of_enemy, PDO::PARAM_INT);
			$prep->bindValue(':life', $life_of_enemy, PDO::PARAM_INT);
			$prep->bindValue(':rating', $rating_of_enemy, PDO::PARAM_INT);
			$arr = $prep->execute();

			$sql="UPDATE results SET loss =:loss, life =:life, rating =:rating WHERE user_id = :user_id";  
			$prep = $сonnection_db->prepare($sql);
			$prep->bindValue(':user_id', $_SESSION['id'], PDO::PARAM_INT);
			$prep->bindValue(':loss', $loss_of_attaker, PDO::PARAM_INT);
			$prep->bindValue(':life', $life_of_attaker, PDO::PARAM_INT);
			$prep->bindValue(':rating', $rating_of_attaker, PDO::PARAM_INT);
			$arr = $prep->execute();

			return ['winner' => $winner, 'loss_of_attaker' => $loss_of_attaker, 'loss_of_enemy' => $loss_of_enemy];
		}	
	}
}
