<?php
	session_start();
	if (!isset($_SESSION['connect'])){
		header('Location: index.php');
  		exit();
	}
	require('includes/fonctions.php');
	require('bdd/Model.php');
?>

<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8" />
		<title>EnergiCulteur</title>
		<link rel="stylesheet" href="css/bootstrap.min.css" />
		<link rel="stylesheet" href="css/style.css" />

		<script src="js/jquery-3.2.1.min.js"></script>
		<script src="js/menu.js"></script>
	</head>
	<body>
		<?php
			require("includes/nav-bar.php");
		?>

		<section class="header">
			<div class="inner">EnergiCulteur</div>
		</section>

		
		<?php
			require("includes/footer.php");
		?>
	</body>
</html>