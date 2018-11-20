<?php
require('fonctions.php');
/*Fonction pour le mot de passe oublié à ajouter dans Model.php 
Deux nouvelles pages créées : mdpoublie.php et sendmdp.php
mdpoublie contient le formulaire avec le mail et le mot de sécurité
si le mail existe alors le mdp crypté en vernam est décrypté et envoyé à l'adresse mail du client
sinon Erreur mdp non existant
*/
	function mdp_oublie($mail, $mot){
		$mail = htmlspecialchars($mail, ENT_QUOTES);
		$mot = htmlspecialchars($mot, ENT_QUOTES);
		try{
			$req = $this->bdd->prepare('SELECT count(*) as pseudo from energiculteur.utilisateur where email=:mail');
			$req->bindValue(':mail', $mail);
			$req->execute();
			$mail_libre = ($req->fetchColumn()==0)?1:0;
			$req->CloseCursor();

			
			if(!mail_libre){
				$req2 = $this->bdd->prepare('SELECT passwordvernam FROM energiculteur.utilisateur where email=:mail');
				$req2->bindValue(':mail', $mail);
				$req2->execute();
				$tab = $req2->fetch(PDO::FETCH_NUM);
				$mdp_crypt = cryptagevernam($tab[0], $mot); //pas sûr si tab[0] ne fonctionne pas, essayer tab[1]
				if (!preg_match("#^[a-z0-9._-]+@(hotmail|live|msn).[a-z]{2,4}$#", $mail)){ // On filtre les serveurs qui rencontrent des bugs
					$passage_ligne = "\r\n";
				}
				else{
					$passage_ligne = "\n";
				}
				//on déclare le msg au format txt
				$message_txt = 'Madame, Monsieur,'. "\r\n" .'Vous avez récemment fait une demande car vous avez oublié votre mot de passe. Votre mot de passe est le suivant :'.$mdp_crypt.' '."\r\n". 'Bien à vous,'. "\r\n". 'Energiculteur.' ;
			
				//création de la boundary
				$boundary = "-----=".md5(rand());
		
				//on définit le sujet
				$sujet = "Mot de passe oublié";

				//header de l'email
				$header = "From: \"Energiculteur\"<energiculteur@mail.fr>".$passage_ligne;
				$header.= "Reply-to: \"Energiculteur\" <energiculteur@mail.fr>".$passage_ligne;
				$header.= "MIME-Version: 1.0".$passage_ligne;
				$header.= "Content-Type: multipart/alternative;".$passage_ligne." boundary=\"$boundary\"".$passage_ligne;

 
				//on crée le message
				$message = $passage_ligne."--".$boundary.$passage_ligne;

				//ajout du message au format texte
				$message.= "Content-Type: text/plain; charset=\"ISO-8859-1\"".$passage_ligne;
				$message.= "Content-Transfer-Encoding: 8bit".$passage_ligne;
				$message.= $passage_ligne.$message_txt.$passage_ligne;

				$message.= $passage_ligne."--".$boundary.$passage_ligne;
 
				//on envoie l'email
				mail($mail,$sujet,$message,$header);

				return 1;
			}
			else{
				//adresse mail non existante
				return 0;
			}

		}
		catch(PDOException $e){
			die('<p> La connexion a échoué. Erreur['.$e->getCode().'] : '. $e->getMessage().'</p>');	
		}
	}

?>