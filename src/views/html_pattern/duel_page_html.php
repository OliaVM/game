<?php if (isset($_SESSION['login']) && isset($rowEnemy['user_id'])): ?>
	<?php if ($page_name == "duel_page"): ?>
		<script>
			function bomb(num) {
				console.log(num);
				
				if (num === 0) {
					console.log('Бой начался!!!');
					clearTimeout(bombId);
					return;
				}
				bombId = setTimeout(bomb, 2000, --num);
			}

			bomb(10);
			
			function stop() {
				console.log('Бой начался!!!');
				clearTimeout(bombId);
				return;
			}
		</script>
		<?php if (gettype($enemy_id_or_exception) !== "integer"): ?>
			<h3><?php echo $enemy_id_or_exception; ?></h3>
		<?php else: ?>
			<!-- enemy -->
			<div class="row">
			    <div class="col-xs-3 col-sm-2">
			    	<h3>Противник</h3>
				    <?php echo "id противника " . $rowEnemy['user_id']; ?><br>
					<?php echo "логин " . $rowEnemy['login']; ?><br>
					<?php echo "рейтинг " . $rowEnemy['rating']; ?><br>
					<?php echo "урон " . $rowEnemy['loss']; ?><br>
					<?php echo "жизнь " . $rowEnemy['life']; ?><br>
				</div>
				<div class="col-xs-3 col-sm-2">
					<img src="<?php echo "/".$rowEnemy['image']."" ?>">
				</div>
			</div>
					

			<?php if ($_SESSION['id'] == $rowEnemy['user_id']): ?>
				<form method="post"> 
					<button type="submit" name="attack_from_enemy">Атаковать</button>
				</form>
			<?php endif; ?>
			<br>	
			

			<?php if ($_SESSION['id'] == $rowAttacker['user_id']): ?>	
				<form method="post"> 
					<!--<button type="submit" name="attack_from_attaker">Атаковать</button>-->
					<button  name="attack_from_attaker" value="Атаковать" type="submit" style="border: none; margin: 0; padding: 0; border-radius: 0px"><img src="/images/3.jpg"></button>
				</form>
			<?php endif; ?>
			
			<!-- Вы -->
			<div class="row">
			    <div class="col-xs-3 col-sm-2">
			    	<h3>Вы</h3>
				    <?php echo "id " . $rowAttacker['user_id']; ?><br>
					<?php echo "логин " . $rowAttacker['login']; ?><br>
					<?php echo "рейтинг " . $rowAttacker['rating']; ?><br>
					<?php echo "урон " . $rowAttacker['loss']; ?><br>
					<?php echo "жизнь " . $rowAttacker['life']; ?><br>
				</div>
				<div class="col-xs-6 col-sm-4">
					<img src="<?php echo "/".$rowAttacker['image']."" ?>">
				</div>
				<div class="col-xs-6 col-sm-4">
					<?php if (isset($loss_of_enemy_log)): ?>
						<h2 style="color:red"><?php echo $loss_of_enemy_log; ?></h2>
					<?php endif; ?>
					<?php if (isset($loss_of_attaker_log)): ?>
						<h2 style="color:red"><?php echo $loss_of_attaker_log; ?></h2>
					<?php endif; ?>
					<?php if (isset($winner) && isset($loss_of_attaker) && isset($loss_of_enemy)): ?>
						<h2 style="color:red"><?php echo "Game over!"; ?></h2>
						<h2 style="color:red"><?php echo "Победил " . $winner; ?></h2>
						<h2 style="color:red"><?php echo "Общий урон " . $rowEnemy['login'] . " = " . $loss_of_enemy; ?></h2>
						<h2 style="color:red"><?php echo "Общий урон " . $rowAttacker['login'] . " = " . $loss_of_attaker; ?></h2>
					<?php endif; ?>
				</div>
			</div>
		<?php endif; ?>
	<?php endif; ?>
<?php else:	?>
	<?php echo "авторизуйтесь"; ?>
<?php endif; ?>
