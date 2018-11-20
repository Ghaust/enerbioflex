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
					<h1>Consultez votre boite mail !</h1>
				</form>
			</div>
		</section>

		<?php
			require("includes/footer.php");
		?>
	</body>
</html>