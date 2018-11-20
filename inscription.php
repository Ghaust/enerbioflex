<?php
	session_start();
	if (isset($_SESSION['connect'])){
		header('Location: index.php');
  		exit();
	}
	require('includes/fonctions.php');
	require('bdd/Model.php');
	$model = new Model();
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
		
		<section class="inscription">
			<div class="inner">
				<form class="formulaire cadre-transparent" method="post" action="inscription.php">
					<h1>Rejoignez EnergiCulteur</h1>
<?php 
	if(isset($_POST['inscription'])){
		echo 		$model->inscription(
										$_POST['prenom'], $_POST['nom'], $_POST['sexe'], $_POST['email'],
										$_POST['mdp'], $_POST['mdp-2'], $_POST['mot'], $_POST['num_port'], $_POST['num_fixe'],
										$_POST['rue'], $_POST['numMaison'], $_POST['complement'], $_POST['ville'],
										$_POST['postal']);
	}
?>
					<input class="champ-de-text" type="text" name="prenom" placeholder="Prénom*"/> <br/>
					<input class="champ-de-text" type="text" name="nom" placeholder="Nom*"/> <br/>
					<select class="champ-de-text" name="sexe" placeholder="Civilité">
						<option value="h"> Homme </option>
						<option value="f"> Femme </option>
						<option value="a"> Autre </option>
					</select>
					<input class="champ-de-text" type="text" name="email" placeholder="Email*"/> <br/>
					<input class="champ-de-text" type="password" name="mdp" placeholder="Mot de passe*" /> <br/>
					<input class="champ-de-text" type="password" name="mdp-2" placeholder="Réécrire le mot de passe*" /> <br/>
					<input class="champ-de-text" type="text" name="mot" placeholder="Mot de sécurité (ex : ville de naissance...)*" /> <br/>
					<input class="champ-de-text" type="text" name="num_port" placeholder="Téléphone portable"/> <br/>
					<input class="champ-de-text" type="text" name="num_fixe" placeholder="Téléphone fixe"/> <br/>
					<input class="champ-de-text" type="text" name="rue" placeholder="Rue de résidence*"/> <br/>
					<input class="champ-de-text" type="text" name="numMaison" placeholder="Numéro de maison*"/> <br/>
					<input class="champ-de-text" type="text" name="complement" placeholder="Complément d'adresse"/> <br/>
					<input class="champ-de-text" type="text" name="ville" placeholder="Ville*"/> <br/>
					<input class="champ-de-text" type="text" name="postal" placeholder="Code postal*"/> <br/>
					<input class="btn" type="submit" value="S'inscrire" name="inscription" />
					<p>Vous avez déjà un compte ? <a href="connexion.php">Connectez-vous maintenant.</a> </p>
				</form>
			</div>
		</section>

		<?php
			require("includes/footer.php");
		?>
	</body>
</html>