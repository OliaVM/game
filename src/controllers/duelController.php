<?
class DuelController {
	public $model;
	public $view;
	function __construct() {
		$this->model = new DuelModel();
		$this->view = new DuelView();
	}
	function action($сonnection_db, $page_name, $path) {
		$enemy_id_or_exception = $this->model->search_enemy($сonnection_db);
		$rowEnemy = $this->model->show_enemy($сonnection_db, $enemy_id_or_exception);
		$rowAttacker = $this->model->show_attacker($сonnection_db);
		$loss_of_enemy_log = $this->model->start_attack_from_attaker($сonnection_db, $rowEnemy, $rowAttacker);
		$loss_of_attaker_log = $this->model->start_attack_from_enemy($сonnection_db, $rowEnemy, $rowAttacker);
		$arr_end_game = $this->model->end_attack($сonnection_db, $rowEnemy, $rowAttacker);
		$winner = $arr_end_game['winner'];
		$loss_of_attaker = $arr_end_game['loss_of_attaker'];
		$loss_of_enemy = $arr_end_game['loss_of_enemy'];

		$this->view->generateView($сonnection_db, $enemy_id_or_exception, $rowEnemy, $rowAttacker, $page_name, $path, $loss_of_enemy_log, $loss_of_attaker_log, $winner, $loss_of_attaker, $loss_of_enemy);
	}
}