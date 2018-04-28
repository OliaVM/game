<?php
class AuthClassView {
	public $authClassModel;
	public function __construct() {
		$this->authClassModel = new AuthClassModel();
	}
	public function generateAuthorizationView($connection_db) {
		//showExeptionInAuthorization
		$printAuthEx = $this->authClassModel->formSendingControl($connection_db);
		//add authorization form
		if (!isset($printAuthEx )) { 
			require __DIR__ . '/html_pattern/form/avtorization_form.php';
		}
		else {
			require __DIR__ . '/html_pattern/form/avtorization_form_save.php'; 
			
		}
		echo "<h2 class='redcolor'>" . $printAuthEx . "</h2>";
		echo "<p><a href='/index.php'>Перейти на главную страницу</a></p>";	
	}
}



		