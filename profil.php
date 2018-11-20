<?php
	session_start();
	if (!isset($_SESSION['infos'])){
		header('Location: index.php');
  		exit();
	}
	require('includes/fonctions.php');
	require('bdd/Model.php');

	$model = new Model();
	$data = $model->get_utilisateur($_SESSION['infos']['id']);
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

		<section class="container user-profil">
			<h1>Profil</h1>
			<hr class="separateur" />
			<div class="row">
				<img class="photo col-md-12 col-lg-6 col-xs-12 col-sm-12" src="img/PhotoProfil/sans-photo.jpg" alt="Photo de profil" />
				<form class="col-md-12 col-lg-6 col-xs-12 col-sm-12" method="post" action="profil.php"> 
					<input class="champ-de-text" type="text" name="email" placeholder=<?php echo '"'.$data['email'].'"'; ?>/> <br/>
					<input class="champ-de-text" type="password" name="mdp" placeholder="Nouvau mot de passe ?" /> <br/>
					<input class="champ-de-text" type="password" name="mdp-2" placeholder="Réécrire le mot de passe" /> <br/>
					<input class="champ-de-text" type="text" name="adresse" placeholder=<?php echo '"Portable '.$data['tel_port'].'"'; ?>/> <br/>
					<input class="champ-de-text" type="text" name="adresse" placeholder=<?php echo '"Fixe '.$data['tel_fixe'].'"'; ?>/> <br/>
					<input class ="btn" type="submit" value="Modifier ses informations" />
				</form>
			</div>
		</section>

		
		<?php
			require("includes/footer.php");
		?>
	</body>
</html>