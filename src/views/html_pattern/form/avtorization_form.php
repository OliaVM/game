<?php if (!isset($_SESSION['login'])): ?>
	<div align="center"><h2>Для авторизации на сайте введите данные:</h2>
		<form  method="post">
			<input type="hidden" name="time" value="0">
			Логин: <input type="text" name="login"><br>
			Пароль: <input type="password" name="password"><br>
			Запомнить меня: <input name='remember' type='checkbox' value='1'><br>
			<input type="submit" name="submit_avtorization" value='Отправить'><br>
		</form>
	</div>
<?php endif; ?> 





