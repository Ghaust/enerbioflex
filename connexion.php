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
		<link rel="stylesheet" href="css/bootstrap.min.css" />
		<link rel="stylesheet" href="css/style.css" />
		<link rel="shortcut icon" type="image/x-icon" href="img/logo.png"/>
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
				<form class="formulaire cadre-transparent" method="post" action="connexion.php" >
					<h1>Connectez-vous</h1>
					<?php
						if(isset($_POST['connexion']))
							echo $model->test_connexion($_POST['email'], $_POST['mdp']);
					?>
					<input class="champ-de-text" type="text" name="email" placeholder="Email"/> <br/>
					<input class="champ-de-text" type="password" name="mdp" placeholder="Mot de passe" /> <br/>
					<input type="checkbox" name="actif"/><span>Garder ma session active.</span>
					<span><a href="mdpoublie.php" >Mot de passe oublié ?</a></span><br/>
					<input class ="btn" type="submit" value="Se connecter" name="connexion" />
					<p>Vous n'avez pas de compte ? <a href="inscription.php">Créez-en un maintenant.</a> </p>
				</form>
			</div>
		</section>

		<?php
			require("includes/footer.php");
		?>
	</body>
</html>