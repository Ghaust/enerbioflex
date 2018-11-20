<?php
	session_start();
	require('includes/fonctions.php');
	require('bdd/Model.php');

	$model = new Model();

	if(isset($_GET['id_auteur']) and isset($_GET['id_reponse'])){
		if($_GET['id_auteur'] == $_SESSION['infos']['id'] or $_SESSION['infos']['rang'] >= 1){
			$model->delete_forum_reponse($_GET['id_reponse']);
			echo "bebe";
		}
		//redir('forum-sujet.php?id_c='.$_GET['id_c'].'&id_m='.$_GET['id_m']);
	}