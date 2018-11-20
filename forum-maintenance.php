<?php
	session_start();
	require('includes/fonctions.php');
	require('bdd/Model.php');

	$model = new Model();

	if (isset($_GET['rep_delete'])){
		if(isset($_GET['id_auteur']) and isset($_GET['id_reponse'])){
			if($_GET['id_auteur'] == $_SESSION['infos']['id'] or $_SESSION['infos']['rang'] >= 1){
				$model->delete_forum_reponse($_GET['id_reponse']);
			}
		}
	}
	else if(isset($_GET['sujet_delete'])){
		if(isset($_GET['id_auteur'])){
			if ($_GET['id_auteur'] == $_SESSION['infos']['id'] or $_SESSION['infos']['rang'] >= 1){
				$model->delete_forum_sujet($_GET['id_m']);	
			}
		}
	}
	else if(isset($_GET['verrouille'])){
		if(isset($_GET['id_m']) and isset($_SESSION['infos'])){
			if ($_GET['id_auteur'] == $_SESSION['infos']['id'] or $_SESSION['infos']['rang'] >= 1){
				$model->verrouiller_forum_sujet($_GET['id_m']);
			}
		} 
	}

	redir('forum-sujet.php?id_c='.$_GET['id_c'].'&id_m='.$_GET['id_m']);