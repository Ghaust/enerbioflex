<?php
	session_start();
	require('includes/fonctions.php');
	require('bdd/Model.php');
	$model = new Model();
	
	$content = $model->get_description_produit($_GET['id_m']);


	
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
	
	<body>
		<?php
			require("includes/nav-bar.php");
		?>
		<section class="header">
			<div class="inner"> 
				EnergiCulteur Boutique
				
			<div/>
			<hr class="separateur"></hr>
		</section>

		<section class="container-fluid derniers-articles">
		<div class="center">
			<?php
						echo "<a>Nombre d'anonces en ligne a ce jours et de: ".$model->nombre_dannonce_poste()." </abs(number)>";
			?>
			</div>
					<hr class="separateur" />
		</section>



</section>
	
		<?php
			require("includes/footer.php");
		?>
	</body>
</html>