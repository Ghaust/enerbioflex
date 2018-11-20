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

		<script src="js/jquery-3.2.1.min.js"></script>
		<script src="js/menu.js"></script>
	</head>
	
	<body>
		<?php
			require("includes/nav-bar.php");
		?>

		<section class="inscription">
			<div class="center">
			<h1> Mettre en vente un produit </h1>
			<p>merci de renseigné tous les champs</p>
			<?php
						echo '<a>Le nombre danonce en ligne a ce jours et de: '.$model->nombre_dannonce_poste().' </a>';
			?>
			<br></br>

				<FORM class="formulaire cadre-transparent" action="boutiqueVente.php" method="POST">

				<?php if(isset($_POST['boutiqueVente'])){
			echo  $model->boutiqueVente(	
											$_POST['region'], $_POST['categorie'], $_POST['etat'], $_POST['nom'],
											$_POST['description'], $_POST['prix'], $_POST['pseudo'], $_POST['num'],
											$_POST['mail']);
						}
				?>

					<p>Où vous situez vous ?</p>
					<FORM><SELECT style="border-radius: 200px;" name="region" size="1">
					<OPTION>Toute la France</OPTION>	
					<OPTION>Alsace</OPTION>	
					<OPTION>Aquitaine</OPTION>
					<OPTION>Auvergne</OPTION>
					<OPTION>Basse-Normandie</OPTION>
					<OPTION>Bourgogne</OPTION>
					<OPTION>Bretagne</OPTION>
					<OPTION>Centre</OPTION>
					<OPTION>Champagne-Ardenne</OPTION>
					<OPTION>Corse</OPTION>
					<OPTION>Franche-Comté</OPTION>
					<OPTION>Haute-Normandie</OPTION>
					<OPTION>Ile-de-France</OPTION>
					<OPTION>Languedoc-Roussillon</OPTION>
					<OPTION>Limousin</OPTION>
					<OPTION>Lorraine</OPTION>
					<OPTION>Midi-Pyrénées</OPTION>
					<OPTION>Nord-Pas-de-Calais</OPTION>
					<OPTION>Pays de la Loire</OPTION>
					<OPTION>Picardie</OPTION>
					<OPTION>Poitou-Charentes</OPTION>
					<OPTION>Provence-Alpes-Côte-d'Azur</OPTION>
					<OPTION>Rhône-Alpes</OPTION>
					</SELECT></p>

					<p>Que souhaitez-vous vendre ?</p>
					<FORM><SELECT style="border-radius: 200px;" name="categorie" size="1">
					<OPTION>Véhicules</OPTION>
					<OPTION>Matériel Agricole</OPTION>
					<OPTION>Soin(Animaux)</OPTION>
					<OPTION>Soin(Arbres/Plantes)</OPTION>
					<OPTION>Produit Alimentaire</OPTION>
					<OPTION>Animaux</OPTION>
					<OPTION>Service</OPTION>
					</SELECT></p>

					<p>Dans quel état est votre bien ?</p>
					<FORM><SELECT style="border-radius: 200px;" name="etat" size="1">
					<OPTION>Neuf</OPTION>
					<OPTION>Occasion</OPTION>
					<OPTION>Hors-Service</OPTION>
					</SELECT></p>

					<p>Titre de votre annonce :</p>
					<input style="width: 300px; border-radius: 200px;" type="text" name="nom"/></p>
					
					<p>Description de votre bien :</p>
					 <textarea style=" border-radius: 15px;" name="description" rows="6" cols="150">200 caractère max.</textarea></p>

					<p>Quelle et le prix de l'objet ?</p>
					<input style="width: 80px; border-radius: 200px;" type="text" name="prix"/>€</p>


					<p>Votre pseudo:</p>
					<input style="width: 120px; border-radius: 200px;" type="text" name="pseudo"/></p>

					<p>Votre numero de telephone:</p>
					<input style="width: 120px; border-radius: 200px;" type="text" name="num"/></p>

					<p>votre adresse mail:</p>
					<input style="width: 200px; border-radius: 200px;" type="text" name="mail"/></p>

					<br></br>
					<input style="border-radius: 200px;" type="submit" name="boutiqueVente" value="validé la saisie" />
				</FORM>

			</div>
		
		<br></br>

</section>


		<?php
			require("includes/footer.php");
		?>
	</body>
</html>
