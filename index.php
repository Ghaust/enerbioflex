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
		<link rel="shortcut icon" type="image/x-icon" href="img/logo.png"/>
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

		<section class="container-fluid derniers-articles">
			<h1>Derniers Articles</h1>
			<hr class="separateur" />
			<div class="row">
<?php
	$articles = $model->get_three_last_articles();
	foreach($articles as $key => $contenu){
		echo '
				<article class="col-md-4 col-lg-4 col-xs-12 col-sm-12">
					<h2 class="title">'. 
						$contenu['titre']
					.'</h2>
					<p>'. 
						$contenu['corps']
					.'</p>
				</article>
			 ';
	}
?>
<!--			<article class="col-md-4 col-lg-4 col-xs-12 col-sm-12">
					<h2 class="title">Article 1</h2>
					<p>
						Le Lorem Ipsum est simplement du faux texte employé dans la composition et la mise 	en page avant impression. Le Lorem Ipsum est le faux texte standard de l'imprimerie depuis les années 1500, quand un peintre anonyme assembla ensemble des morceaux de texte pour réaliser un livre spécimen de polices de texte. Il n'a pas fait que survivre cinq siècles, mais s'est aussi adapté à la bureautique informatique, sans que son contenu n'en soit modifié. Il a été popularisé dans les années 1960 grâce à la vente de feuilles Letraset contenant des passages du Lorem Ipsum, et, plus récemment, par son inclusion dans des applications de mise en page de texte, comme Aldus PageMaker.
					</p>
				</article>
				<article class="col-md-4 col-lg-4 col-xs-12 col-sm-12">
					<h2 class="title">Article 2</h2>
					<p>
						Le Lorem Ipsum est simplement du faux texte employé dans la composition et la mise en page avant impression. Le Lorem Ipsum est le faux texte standard de 	l'imprimerie depuis les années 1500, quand un peintre anonyme assembla ensemble des morceaux de texte pour réaliser un livre spécimen de polices de texte. Il n'a pas fait que survivre cinq siècles, mais s'est aussi adapté à la bureautique informatique, sans que son contenu n'en soit modifié. Il a été popularisé dans les années 1960 grâce à la vente de feuilles Letraset contenant des passages du Lorem Ipsum, et, plus récemment, par son inclusion dans des applications de mise en page de texte, comme Aldus PageMaker.
					</p>
				</article>
				<article class="col-md-4 col-lg-4 col-xs-12 col-sm-12">
					<h2 class="title">Article 3</h2>
					<p>
						Le Lorem Ipsum est simplement du faux texte employé dans la composition et la mise en page avant impression. Le Lorem Ipsum est le faux texte standard de l'imprimerie depuis les années 1500, quand un peintre anonyme assembla ensemble des morceaux de texte pour réaliser un livre spécimen de polices de texte. Il n'a pas fait que survivre cinq siècles, mais s'est aussi adapté à la bureautique informatique, sans que son contenu n'en soit modifié. Il a été popularisé dans les années 1960 grâce à la vente de feuilles Letraset contenant des passages du Lorem Ipsum, et, plus récemment, par son inclusion dans des applications de mise en page de texte, comme Aldus PageMaker.
					</p>
	 			</article>
--> 		</div>
		</section>


		<section class="container-fluid commercial">
			<div class="inner">
<?php
	$phrase = $model->get_last_phrase_commerciale();
	echo 		'<h1>'.$phrase['titre'].'</h1>';
	echo 		'<p>'.$phrase['phrase'].'</h1>';
?>
			</div>
		</section>
		
		<section class="container-fluid a-propos">
			<h1>A propos de nous</h1>
			<hr class="separateur" />
			<div class="row">
				<article class="col-md-4 col-lg-2 col-xs-12 col-sm-6">
					<h2 class="title">Clients</h2>
					<p>
<?php
						echo $model->get_nb_clients();
?>
					</p>
				</article>
				<article class="col-md-4 col-lg-2 col-xs-12 col-sm-6">
					<h2 class="title">Economie</h2>
					<p>
<?php
						echo $model->get_argent_economise() . "€";
?>
					</p>
				</article>
				<article class="col-md-4 col-lg-2 col-xs-12 col-sm-6">
					<h2 class="title">Capteurs</h2>
					<p>
<?php
						echo $model->get_nb_capteurs();
?>
					</p>
				</article>
				<article class="col-md-4 col-lg-2 col-xs-12 col-sm-6">
					<h2 class="title">A partir de</h2>
					<p>
<?php
						echo $model->get_prix_minimum() . "€";
?>
					</p>
				</article>
				<article class="col-md-4 col-lg-2 col-xs-12 col-sm-6">
					<h2 class="title">Inscrits</h2>
					<p>
<?php
						echo $model->get_nb_inscrits();
?>
					</p>
				</article>
				<article class="col-md-4 col-lg-2 col-xs-12 col-sm-6">
					<h2 class="title">Connectés</h2>
					<p>
<?php
						echo $model->get_nb_connectes();
?>
					</p>
				</article>
			</div>
		</section>

		<?php
			require("includes/footer.php");
		?>
	</body>
</html>