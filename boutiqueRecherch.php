<?php
	session_start();		
	require('includes/fonctions.php');
	require('bdd/Model.php');
	$model = new Model();
	$word_find = $model->trouver_annonce($_POST['searchBar']);	


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

		<section class="container-fluid derniers-articles">
		<h1>La Boutique</h1>
		<div class="center">
			<?php
						echo "<a>Nombre d'anonces en ligne a ce jours et de: ".$model->nombre_dannonce_poste()." </abs(number)>";
			?>
			</div>
					<hr class="separateur" />
		</section>
		
		<section class="encadrement">
			<div class="center">
				<FORM action="boutique.php" method="POST">
					<input style="border-radius: 200px;" type="submit" value="Effectué une nouvelle recherche?" />
				</FORM>
				
			</div>
		</section>
		<section class="listings">
				<div class="wrapper">
				<ul class="annonce_list">
			
				<?php
					
						echo $word_find;

				?>	
				</ul>
				</div>
		</section>
		



		<?php
			require("includes/footer.php");
		?>
	</body>
</html>
