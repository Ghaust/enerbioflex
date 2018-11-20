<?php
	session_start();
	require('includes/fonctions.php');
	require('bdd/Model.php');
	$model = new Model();
	
	$annonce = $model->get_derniere_annonce();
	
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
		<section class="encadrement">
		<div class="center">
			<?php
						echo "<a>Nombre d'anonces en ligne a ce jours et de: ".$model->nombre_dannonce_poste()." </abs(number)>";
			?>
			<h1> Que recherchez-vous ?</h1>
				<FORM action="boutiqueRecherch.php" method="post">
					<input style="width: 980px; border-radius: 200px;" type="search" name="search"/>
					<input style="border-radius: 200px;" type="submit" name="rechercher" value="Rechercher" />
				<br></br>
				<FORM><LABEL><I>CATEGORIE&nbsp;</I></LABEL><SELECT style="border-radius: 200px;" name="categorie" size="1">
					<OPTION>Vehicule</OPTION>
					<OPTION>Materiel Agricole</OPTION>
					<OPTION>Soin(Animaux)</OPTION>
					<OPTION>Soin(Arbres/Plantes)</OPTION>
					<OPTION>Produit Alimentaire</OPTION>
					<OPTION>Animaux</OPTION>
					<OPTION>Service</OPTION>
					</SELECT>

				<FORM><LABEL><I>REGION&nbsp;</I></LABEL><SELECT style="border-radius: 200px;" name="region" size="1">
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
					</SELECT>

				<FORM><LABEL><I>ETAT&nbsp;</I></LABEL><SELECT style="border-radius: 200px;" name="etat" size="1">
					<OPTION>Neuf</OPTION>
					<OPTION>Occasion</OPTION>
					<OPTION>Hors-Service</OPTION>
					</SELECT>

				<LABEL><I>Prix Min&nbsp; </I></LABEL><input style="border-radius: 200px;" type="text" name="prixmin" size="3">
				<LABEL><I>Prix Max&nbsp;</I></LABEL><input style="border-radius: 200px;" type="text" name="prixmax" size="3">
				
				</FORM>
				</FORM>
				</FORM>
				</FORM>
				<br></br>
				<h1>Que proposez-vous ?</h1>
				<p>Mettez en vente des produits, qui serons accesible par toutes la communauté Enerbioflex.</p>
				<FORM action="boutiqueVente.php" method="POST">
				<input style="width: 420px; border-radius: 200px;" type="submit" name="vendre" value="Vendre ?">
				</FORM>
				</div>
		</section>
		
		<hr class="separateur"></hr>
				<br></br>
		<section class="listings">
				<div class="wrapper">
				<ul class="annonce_list">
			
			<?php
						
				foreach($annonce as $key=>$value){
		echo '
			<li>
				
				<a href="boutique-annonce.php?produit='.$value['nom_produit'] . '">
						<img src="pics/'.$value['nom_produit'].'.jpg" alt="" title="" class="annonce__img"/>
					</a>
				<span clasŝ="prix">'.$value['prix_produit'].'€
				<div class="annonce_details"><h1>
							<a href="boutique-annonce.php?produit='.$value['nom_produit'] . '"> '. $value['nom_produit'] .' </a>
						</h1>
						<h2>'. $value['etat_produit'] .' <span class="annonce_taille">('. $value['region_produit'] .')</span></h2>
				</div>
			</li>

		';
	}

	

	
?> </ul>
	</div></section>
	
		<?php
			require("includes/footer.php");
		?>
	</body>
</html>