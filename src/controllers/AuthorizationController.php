<?php
class AuthController {
	public $model;
	public $view;
	public function __construct() {
		$this->model = new AuthClassModel();
		$this->view = new AuthClassView();
	}
	public function actionAuthoriz($сonnection_db) {
		//$this->model->formSendingControl($сonnection_db);
		$this->view->generateAuthorizationView($сonnection_db);
	}
}
