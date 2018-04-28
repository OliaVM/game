<?php
class DuelView {
	public $model;
	public function __construct() {
		$this->model = new DuelModel();
	}
	public function generateView($сonnection_db, $enemy_id_or_exception, $rowEnemy, $rowAttacker, $page_name, $path, $loss_of_enemy_log, $loss_of_attaker_log, $winner, $loss_of_attaker, $loss_of_enemy) {
		require_once __DIR__ . '/html_pattern/duel_page_html.php';
	}
}
