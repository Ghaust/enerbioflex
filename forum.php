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

		<section class="header">
			<div class="inner">EnergiCulteur - Forum</div>
		</section>

		<section class="container-fluid forum">
			<h1>Forum</h1>
			<hr class="separateur" />
<?php
	$categorie = $model->get_all_categorie();
	foreach($categorie as $cle=>$valeur){
			echo '
				<table>
				<tr class="tab-title">
					<th class="col-2-title center">
						<a href="forum-categorie.php?id='. $valeur['id'] .'">'. $valeur['nom'] . '</a>

					</th>
					<th class="col-3-title center">Messages</th>
					<th class="col-4-title center">Dernière réponse</th>
				</tr>
				 ';
		$sujets = $model->get_sujets($valeur['id']);
		foreach($sujets as $key=>$value){
			echo '
				<tr>
					
					<td class="col-2">
						<a href="forum-sujet.php?id_c='.$valeur['id'].'&id_m='. $value['id'] . '">' . $value['titre'] .' </a>
					</td>
					<td class="col-3 center">
						'.$model->get_nb_reponse($value['id'])[0].'
					</td>
					<td class="col-4">
						'.$model->get_derniere_reponse($value['id'])[0]['date_reponse'].'
					</td>
				</tr>
				 ';
		}
		echo "</table>";
	}
?>
			<div class="forum-stats">
				<h1>Statistiques</h1>
				<p>
<?php
	$data = $model->get_titre_auteur_dernier_sujet_poste();
	echo '
				Le nombre de messages total est de : ' . $model->get_nb_sujets() . '<br/>
				Le nombre de réponses total est de : ' . $model->get_nb_reponses() . '<br/>
				Le dernier message posté est : <br/>
				'. $data['titre'] .' de ' . $data['prenom'] . " " . $data['nom'];
		 ;
?>
				</p>
			</div>
		</section>

		
		<?php
			require("includes/footer.php");
		?>
	</body>
</html>