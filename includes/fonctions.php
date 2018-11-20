<?php

function non_vide($var){
	if(isset($var) && trim($var) !='')
		return 1;
	return 0;
}

function redir($url) {
	echo '
		<script language="JavaScript">
	    	setTimeout("window.location=\''.$url.'\'"); 
	    </script>';
}

/* Méthode de cryptage Vern avec une clef donnée par l'utilisateur à l'inscription */
function cryptagevernam($mdp, $clef){
	$len_clef = strlen($clef);
	$len_mdp = strlen($mdp);

	if($len_clef < $len_mdp){
		//on rallonge la clef jusqu'à la longueur du mdp avec str_pad

		$clef = str_pad($clef, $len_mdp, $clef, STR_PAD_RIGHT);
	}

	elseif($len_clef > $len_mdp){
		//on raccourcit la clef de la différence de len_clef et len_mdp

		$res_diff = $len_clef - $len_mdp;
		$_clef = substr($clef, 0, -$diff);

	}

	// On envoie le texte crypté
	return $mdp ^ $clef;
}
?>