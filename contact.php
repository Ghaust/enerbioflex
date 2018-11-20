<?php
	session_start();
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

		<section class="contact">
			<div class="inner">
				<form class="formulaire cadre-transparent">
					<h1>Contactez-nous</h1>
					<input class="champ-de-text" type="text" name="email" placeholder="Email"/> <br/>
					<input class="champ-de-text" type="text" name="sujet" placeholder="Sujet du message"/> <br/>
					<textarea class="champ-de-text-textarea" name="content" placeholder="Contenu du message"></textarea> <br/>
					<input class ="btn" type="submit" value="Envoyer" />
				</form>
			</div>
		</section>
		
		<?php
			require("includes/footer.php");
		?>
	</body>
</html>