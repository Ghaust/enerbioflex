<?php
	session_start();
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
		<link rel="stylesheet" href="css/nouveauSujet.css" />

		<script src="js/jquery-3.2.1.min.js"></script>
		<script src="js/menu.js"></script>
	</head>
	<body>
		<?php
			require("includes/nav-bar.php");
		?>
		<section class="header">
			<div class="inner"> 
				EnergiCulteur
				
			<div/>
			
			

			<hr class="separateur"></hr>
		</section>
			<div class="contenu-nouveauSujet">
				<h1>Poster une discussion</h1>
			<form action="forum.php" method= "post">
			<input id="titre-post" type="text" placeholder="Donnez un titre au post" name="titre_du_post"/><br/>
			<textarea id="champ" name="contenu"  placeholder="taper votre message ici "></textarea><br/>
			<input id="btn-poster"type="submit" name="creer" value="Poster" />
			<?php 
			if (isset($_POST['creer']) and trim($_POST['titre_du_post'] != '' and trim($_POST['contenu'] != '' ))) {
				$model->forum_nouveau_message( $_SESSION['infos']['id'],$_GET['categorie'], $_POST['titre_du_post'], $_POST['contenu'])	;
			}

			?>
		</form>
	</div>
		<?php
			require("includes/footer.php");
		?>
	</body>
</html>