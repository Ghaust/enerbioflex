<?php
	session_start();
	require('includes/fonctions.php');
	require('bdd/Model.php');
	$model = new Model();
	$content = $model->get_contenu_sujet($_GET['id_m']);
	$categorie = $model->get_categorie($_GET['id_c']);
	$user = $model->get_utilisateur($content['id_auteur']);
	$reponses = $model->get_all_reponses($content['id']);

	switch ($user['sexe']) {
		case 'h':
			$user['sexe'] = "Homme";
			break;
		case 'f':
			$user['sexe'] = "Femme";
			break;
		default:
			$user['sexe'] = "Autre";
			break;
	}

	if(isset($_POST['repondre'])){
		echo $model->forum_nouvelle_reponse($_GET['id_m'], $_SESSION['infos']['id'], $_POST['reponse']);
		redir('forum-sujet.php?id_c='.$_GET['id_c'].'&id_m='.$_GET['id_m']);
		exit();
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
			<div class="container forum-sujet">
<?php
	echo '	<h1>' . $categorie['nom'] . '</h1>';
?>
			<div class="sujet">
			<ul class="content">
<?php
	echo '		<li>' . $content['titre'] . '</li>';
	echo '		<li>
	<a href="nouveau-sujet.php">Nouveau</a>
	<a href="forum-maintenance.php?id_c='.$_GET['id_c'].'&id_m='.$_GET['id_m'].'&id_auteur='. $content['id_auteur'] .'&verrouille=1">Verrouiller</a>

	<a href="forum-maintenance.php?id_c='.$_GET['id_c'].'&id_m='.$_GET['id_m'].'&id_auteur='. $content['id_auteur'] .'&sujet_delete=1">Supprimer</a></li>';
	echo '		<li>' . $content['corps'] . '</li>';
	echo '		<li class="date">' . $content['date_creation'] . '</li>';
?>
			</ul>
			<ul class="user">
<?php
	echo '		<li>Prenom : ' . $user['prenom'] . '</li>';
	echo '		<li>Nom : ' . $user['nom'] . '</li>';
	echo '		<li>Sexe : ' . $user['sexe'] . '</li>';
	echo '		<li>Ville : ' . $user['ville'] . '</li>';
?>
			</ul>
			</div>

<?php
	foreach($reponses as $key=>$value){
		$user_rep = $model->get_utilisateur($value['id_auteur']);
		echo '
			<div class="reponse">
			<ul class="content">
				<li> <a href="forum-maintenance.php?id_c='.$_GET['id_c'].'&id_m='.$_GET['id_m'].'&id_auteur='. $value['id_auteur'] .'&id_reponse='.$value['id_reponse'].'&rep_delete=1">Supprimer</a></li>
				<li>' . $value['corps'] . '</li>
				<li class="date">' . $value['date_reponse'] . '</li>
			</ul>
			 ';
		switch ($user_rep['sexe']) {
			case 'h':
				$user_rep['sexe'] = "Homme";
				break;
			case 'f':
				$user_rep['sexe'] = "Femme";
				break;
			default:
				$user_rep['sexe'] = "Autre";
				break;
		}
		echo '
			<ul class="user">
				<li>Prenom : ' . $user_rep['prenom'] . '</li>
				<li>Nom : ' . $user_rep['nom'] . '</li>
				<li>Sexe : ' . $user_rep['sexe'] . '</li>
				<li>Ville : ' . $user_rep['ville'] . '</li>
			</ul>
			</div>
			 ';
	}
?>			<form method="post" action=<?php echo '"forum-sujet.php?id_c='.$_GET['id_c'].'&id_m='.$_GET['id_m'].'"'; ?>>
				<textarea name="reponse" placeholder="Ecrivez votre réponse ici..."></textarea><br>
				<input type="submit" name="repondre" value="Répondre">
			</form>
			</div>
		</section>

		
		<?php
			require("includes/footer.php");
		?>
	</body>
</html>