<?php
	session_start();
	if (isset($_SESSION['infos'])){
		header('Location: index.php');
  		exit();
	}
	require('includes/fonctions.php');
	require('bdd/Model.php');

	$model = new Model();

	if(isset($_POST['connexion'])){
		$model->test_connexion($_POST['email'], $_POST['mdp']);
	}
	if(isset($_SESSION['infos'])){
		redir("index.php");
		die();
	}

?>

<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8" />
		<title>EnergiCulteur</title>
		<link rel="shortcut icon" type="image/x-icon" href="img/logo.png"/>
		<link rel="stylesheet" href="css/bootstrap.min.css" />
		<link rel="stylesheet" href="css/style.css" />

		<script src="js/jquery-3.2.1.min.js"></script>
		<script src="js/menu.js"></script>
	</head>
	</head>
	<body>
		<?php
			require("includes/nav-bar.php");
		?>
		<section class="connexion">
			<div class="inner">
				<form class="formulaire cadre-transparent" method="post" action="sendmdp.php" >
					<h1>Saisissez votre adresse mail </h1>
					<input class="champ-de-text" type="text" name="email" placeholder="Email"/> <br/>
					<input class="champ-de-text" type="text" name="mot" placeholder="Votre mot de sécurité"/> <br/>
					<input class ="btn" type="submit" value="Recherche" name="recherche" />
				</form>
			</div>
		</section>

		<?php
			require("includes/footer.php");
		?>
	</body>
</html>