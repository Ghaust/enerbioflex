<?php
	if (!$_SESSION['infos']) {
?>
		<img class="logo" src="img/logo.png" alt="Logo" />
		<nav class="nav-bar">
			<a href="index.php">Accueil</a>
			<a href="boutique.php">Boutique</a>
			<a href="forum.php">Forum</a>
			<a href="inscription.php">Inscription</a>
			<a href="connexion.php">Connexion</a>
		</nav>
<?php
	}
	else {
?>
		<img class="logo" src="img/logo.png" alt="Logo" />
		<nav class="nav-bar">
			<a href="index.php">Accueil</a>
			<a href="boutique.php">Boutique</a>
			<a href="#">Supervision</a>
			<a href="forum.php">Forum</a>
			<a href="profil.php">Profil</a>
			<a href="deconnexion.php">Déconnexion</a>
		</nav>
<?php
	}
?>