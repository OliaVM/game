<!DOCTYPE html>
<html lang="ru">
	<head>
	  <meta charset="UTF-8"> 
	  	<!-- CSS Bootstrap -->
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/css/bootstrap.min.css">
		<!-- theme Bootstrap -->
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/css/bootstrap-theme.min.css">
		<!-- jQuery -->
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
		<!-- js Bootstrap -->
		<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/js/bootstrap.min.js"></script> 
		<!-- style-->
		<link href="my_style.css" rel="stylesheet" type="text/css">
	</head>
	<body>
	<div class="row-fluid" id="header">
		<div class="span12" id="box1">
			<?php require_once __DIR__ . "/header.php"; ?>
		</div>
	</div>

	<div class="container-fluid">
	  <div class="row-fluid">
	    <div class="span2" id="box4" id="menu"> 
			<?php require_once __DIR__ . "/menu.php"; ?>
		</div>

		<div class="span10" id="box8">
			<div>
			    <?php require_once __DIR__ . $path . $page_name.'.php'; ?> 
			</div>
		</div>
	  </div>
  	</div>

	<div class="row-fluid" id="footer">
		<div class="span12" id="box12">
			<?php require_once __DIR__ . "/footer.php"; ?>
		</div>
	</div>
	</body>
</html>
