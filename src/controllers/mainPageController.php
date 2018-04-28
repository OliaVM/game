<?
class MainPageController {
	public $view;
	function __construct() {
		$this->view = new MainPageView();
	}
	function actionMainPage($сonnection_db, $page_name, $path) {
		$this->view->generateMainPageView($сonnection_db, $page_name, $path); 
	}
}