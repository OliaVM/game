<!-- Доступно неавторизованным пользователям -->
<ul>
	<br>
	<?php if (!isset($_SESSION['login'])): ?>
		<a href="/index.php?page_name=authorization_page">Авторизоваться</a>
	<?php endif; ?>

	<?php if (isset($_SESSION['login'])): ?>
		<a href="/index.php?page_name=duel_page">Начать дуэль</a>
		<!-- Выводим кнопку выхода из сессии - Display the exit button from the session -->
		<?php require_once __DIR__ . '/../form/exit_button.php' ?>
	<?php endif; ?>
</ul>

					

