<?php

class Model{
	private $bdd; 
	private $clef;

	function __construct(){
		try{
			$this->bdd = new PDO('mysql:host=localhost;dbName=energiculteur;charset=utf8', 'root', 'root');
			$this->clef = "vzsf5ebr64nHc";
		}
		catch(PDOException $e){
			die('<p>Connexion à la base de données impossible. Erreur[' . $e->getCode() . '] : ' . $e->getMessage() . '<p>');
		}
	}

/*
	LES METHODES QUI SUIVENT SONT LIEES AUX UTILISATEURS 
	Documentation :
	La méthode 'test_connexion(String $email, String $mdp)' permet de tester si les identifiants saisis sont
	corrects. Si l'email et le mot de passe saisis correspondent à un utilisateur, la methode retourne 1, 
	0 sinon.
*/

	function test_connexion($mail, $mdp){
		try{
			$message = "";
			if(empty($mail) || empty($mdp)){
				$message = "<p style=\"background-color: red; padding: 10px; border-radius: 5px;\">Il faut saisir le pseudo et le mot de passe.</p>";
			}
			else{
				$mdp = sha1($mdp . $this->clef);
				$query = "SELECT id, rang FROM energiculteur.utilisateur WHERE email = :m AND password = :pass";
				$requete = $this->bdd->prepare($query);
				$requete->bindValue(':m', $mail);
				$requete->bindValue(':pass',$mdp);
				$requete->execute();
				$count = $requete->rowCount();
				if($count == 1){
					$data = $requete->fetch();
					$_SESSION['infos'] = $data;
				}
				else{
					$message = "<p style=\"background-color: red; padding: 10px; border-radius: 5px;\">Email ou mot de passe incorrect.</p>";
				}
			}
			return $message;
		}
		catch(PDOException $e){
			die('<p>Connexion impossible. Erreur[' . $e->getCode() . '] : ' . $e->getMessage() . '<p>');
		}
	}

	public function inscription($prenom, $nom, $sexe, $mail, $mdp1, $mdp2, $mot, $portable, $fixe, $rue, $numero, $complement, $ville, $postal){
		
		$nbErr = 0;
		$message = "";
		$prenom = htmlspecialchars($prenom, ENT_QUOTES);
		$nom = htmlspecialchars($nom, ENT_QUOTES);
		$sexe = htmlspecialchars($sexe, ENT_QUOTES);
		$mail = htmlspecialchars($mail, ENT_QUOTES);
		$mdp1 = htmlspecialchars($mdp1, ENT_QUOTES);
		$mdp2 = htmlspecialchars($mdp2, ENT_QUOTES);
		$mot = htmlspecialchars($mot, ENT_QUOTES);
		$portable = htmlspecialchars($portable, ENT_QUOTES);
		$fixe = htmlspecialchars($fixe, ENT_QUOTES);
		$rue = htmlspecialchars($rue, ENT_QUOTES);
		$numero = htmlspecialchars($numero, ENT_QUOTES);
		$complement = htmlspecialchars($postal, ENT_QUOTES);
		$ville = htmlspecialchars($ville, ENT_QUOTES);
		$postal = htmlspecialchars($postal, ENT_QUOTES);

		if(non_vide($prenom) and non_vide($nom) and non_vide($sexe) and non_vide($mail) and non_vide($mdp1)and non_vide($mdp2) and non_vide($mot) and non_vide($rue) and non_vide($numero) and non_vide($ville) and non_vide($postal)){
			try{
				//On vérifie si le mail est déjà utilisé
				$req = $this->bdd->prepare('SELECT count(*) as pseudo from energiculteur.utilisateur where email=:mail');
				$req->bindValue(':mail', $mail);
				$req->execute();
				$mail_libre = ($req->fetchColumn()==0)?1:0;
				$req->CloseCursor();
				
				if(!$mail_libre){
					$nbErr++;
					$message = $message . "<p style=\"background-color: red; padding: 10px; border-radius: 5px;\">L'adresse mail saisie est déjà utilisée.</p>";
				}
				else if(!filter_var($mail, FILTER_VALIDATE_EMAIL)){
					//on vérifie si le mail est une adresse mail valable càd avec @...
					$nbErr++;
					$message = $message . "<p style=\"background-color: red; padding: 10px; border-radius: 5px;\">L'adresse mail saisie n'est pas valide.</p>";
				}
				if($mdp1 != $mdp2){
					$nbErr++;
					$message = $message . "<p style=\"background-color: red; padding: 10px; border-radius: 5px;\">Les mots de passe saisis ne sont pas les mêmes.</p>";
				}
				if(strlen($mdp1) < 8 || strlen($mdp1) >= 20){
					$nbErr++;
					$message = $message . "<p style=\"background-color: red; padding: 10px; border-radius: 5px;\">Le mot de passe doit faire entre 8 et 20 caractères. Il doit être composé de lettre majuscules, minuscules et de chiffres.</p>";
				}
				/*if(!preg_match('#^(?=.*[a-z])(?=.*[A-Z])(?=.*[0-9])(?=.*\W)#',$mdp1)){
					$nbErr++;
					$message = $message . "mdp pas de bonne forme ";
				}*/
				if(strlen($numero) > 15){
					$nbErr++;
					$message = $message . "<p style=\"background-color: red; padding: 10px; border-radius: 5px;\">Le numero de maison doit faire au maximum 14 caractères.</p>";
				}
				if($nbErr == 0){
					//on crypte le mdp de deux façons avant de l'insérer dans la bdd
					$mdp_crypt = cryptagevernam($mdp1, $mot);
					$mdp = sha1($mdp1.$this->clef);
					$req2 = $this->bdd->prepare('INSERT INTO energiculteur.utilisateur(prenom, nom, sexe, email, password, passwordvernam, tel_port, tel_fixe, rue, numMaison, complement, ville, postal) VALUES(:prenom, :nom, :sexe, :mail, :mdp, :vernam, :portable, :fixe, :rue, :numero, :complement, :ville, :postal)');

					$req2->bindValue(':prenom', $prenom);
					$req2->bindValue(':nom', $nom);
					$req2->bindValue(':sexe', $sexe);
					$req2->bindValue(':mail', $mail);
					$req2->bindValue(':mdp', $mdp);
					$req2->bindValue(':vernam', $mdp_crypt);
					$req2->bindValue(':portable', $portable);
					$req2->bindValue(':fixe', $fixe);
					$req2->bindValue(':rue', $rue);
					$req2->bindValue(':numero', $numero);
					$req2->bindValue(':complement', $complement);
					$req2->bindValue(':ville', $ville);
					$req2->bindValue(':postal', $postal);
					$req2->execute();

					$req2->CloseCursor();

					return "";
				}
				else{
					return $message;
				}
			}
			catch (PDOException $e){
				//Si la connexion échoue, on termine le script
				die('<p> La connexion a échoué. Erreur['.$e->getCode().'] : '. $e->getMessage().'</p>');
			}
		}
		else {
			return "<p style=\"background-color: red; padding: 10px; border-radius: 5px;\">Tous les champs avec une étoile doivent être complétés.</p>";
		}
	}

	function get_last_phrase_commerciale(){
		try{
			$query = "SELECT titre, phrase FROM energiculteur.phrase_commerciale ORDER BY id DESC";
			$requete = $this->bdd->prepare($query);
			$requete->execute();
			return $requete->fetch();
		}
		catch(PDOException $e){
			die("Impossible de récupérer la dernière phrase commerciale.");
		}
	}

	function get_nb_inscrits(){
		try{
			$query = "SELECT * FROM energiculteur.nb_inscrits";
			$requete = $this->bdd->prepare($query);
			$requete->execute();
			return $requete->fetch()['inscrits'];
		}
		catch(PDOException $e){
			die("Impossible de récupérer le nombre d'inscrits.");
		}
	}
	function get_nb_clients(){
		try{
			$query = "SELECT * FROM energiculteur.nb_acheteurs";
			$requete = $this->bdd->prepare($query);
			$requete->execute();
			return $requete->fetch()['nb_acheteurs'];
		}
		catch(PDOException $e){
			die("Impossible de récupérer le nombre de clients.");
		}
	}
	function get_argent_economise(){
		try{
			return 'X';
		}
		catch(PDOException $e){
			die("Impossible de récupérer l'argent économisé.");
		}
	}
	function get_nb_capteurs(){
		try{
			return 'X';
		}
		catch(PDOException $e){
			die("Impossible de récupérer le nombre de capteurs.");
		}
	}
	function get_nb_connectes(){
		return 'X';
  		/*$dir_name = ini_get("session.save_path");
  		$dir = opendir($dir_name); 
  		$i=0;

  		$max_time = ini_get("session.gc_maxlifetime");

 		while ($file_name = readdir($dir)){
   			$file = $dir_name . "/" . $file_name;
    		$lastvisit = filemtime($file); 
    		$difference = mktime() - $lastvisit; 
    		if (is_file($file) && ($difference < $max_time) && fread(fopen($file,'r'),1) != ''){
    			$i++;
    		}
  		}
  		closedir($dir);
  		return $i;*/
	}
	function get_prix_minimum(){
		try{
			return 'X';
		}
		catch(PDOException $e){
			die("Impossible de récupérer le prix minimum.");
		}
	}

	function get_utilisateur($id){
		$query = "SELECT * FROM energiculteur.utilisateur WHERE id = :ident";
		$requete = $this->bdd->prepare($query);
		$requete->bindValue(':ident', $id);
		$requete->execute();
		return $requete->fetch();
	}

	function modifier_utilisateur($id, $prenom, $nom, $sexe, $mail, $mdp1, $mdp2, $portable, $fixe, $rue, $numero, $complement, $ville, $postal, $rang){

		$message = "";

		if(isset($id)){
			if (isset($prenom)){
				if (strlen($prenom) > 3 and strlen($prenom) < 21){
					$query = "UPDATE energiculteur.utilisateur SET prenom = :prenom WHERE id = :id";
					$requete = $this->bdd->prepare($query);
					$requete->bindValue(':prenom', htmlspecialchars($prenom));
					$requete->bindValue(':id', $id);
					$requete->execute();
				}
				else {
					$message = $message . "<p>Le prenom doit faire entre 4 et 20 caractères</p>";
				}
			}
			if (isset($nom)){
				if (strlen($nom) > 3 and strlen($nom) < 21){
					$query = "UPDATE energiculteur.utilisateur SET nom = :nom WHERE id = :id";
					$requete = $this->bdd->prepare($query);
					$requete->bindValue(':nom', htmlspecialchars($nom));
					$requete->bindValue(':id', $id);
					$requete->execute();
				}
				else {
					$message = $message . "<p>Le nom doit faire entre 4 et 20 caractères</p>";
				}
			}
			if (isset($sexe)){
				if (strlen($sexe) == 1 and ($sexe == 'h' || $sexe == 'f' || $sexe == 'a')){
					$query = "UPDATE energiculteur.utilisateur SET sexe = :sexe WHERE id = :id";
					$requete = $this->bdd->prepare($query);
					$requete->bindValue(':sexe', $sexe);
					$requete->bindValue(':id', $id);
					$requete->execute();
				}
				else {
					$message = $message . "<p>Le sexe doit être soit Homme, soit Femme, soit Autre</p>";
				}
			}
			if (isset($mail)){
				if (filter_var($mail, FILTER_VALIDATE_EMAIL) and strlen($mail) < 71){
					$query = "SELECT count(*) as utilise FROM energiculteur.utilisateur WHERE email = :email";
					$requete = $this->bdd->prepare($query);
					$requete->bindValue(':email', htmlspecialchars($mail));
					$requete->execute();

					if ($requete->fetch()['utilise'] == 1){
						$query = "UPDATE energiculteur.utilisateur SET email = :email WHERE id = :id";
						$requete = $this->bdd->prepare($query);
						$requete->bindValue(':email', $mail);
						$requete->bindValue(':id', $id);
						$requete->execute();
					}
					else {
						$message = $message . "<p>L'email saisi est déjà utilisé</p>";
					}
				}
				else {
					$message = $message . "<p>Vous n'avez pas saisi une adresse mail valide</p>";
				}
			}
			if (isset($mdp1) and isset($mdp2)){
				if ($mdp1 == $mdp2){
					if (strlen($mdp1) > 7 and strlen($mdp1) < 21){
						$query = "UPDATE energiculteur.utilisateur SET password = :mdp WHERE id = :id";
						$requete = $this->bdd->prepare($query);
						$requete->bindValue(':mdp', sha1($mdp1 . $this->clef));
						$requete->bindValue(':id', $id);
						$requete->execute();
					}
					else {
						$message = $message . "<p>Le mot de passe doit faire entre 8 et 10 caractères</p>";
					}
				}
				else {
					$message = $message . "<p>Les 2 mots de passe saisis sont différents</p>";
				}
			}
			if (isset($portable)){
				if (strlen($portable) == 10 || strlen($portable) == 12){
					$query = "UPDATE energiculteur.utilisateur SET tel_port = :portable WHERE id = :id";
					$requete = $this->bdd->prepare($query);
					$requete->bindValue(':portable', htmlspecialchars($portable));
					$requete->bindValue(':id', $id);
					$requete->execute();
				}
				else {
					$message = $message . "<p>Le numéro de téléphone ne respecte pas le bon format</p>";
				}
			}
			if (isset($fixe)){
				if (strlen($fixe) == 10 || strlen($fixe) == 12){
					$query = "UPDATE energiculteur.utilisateur SET tel_fixe = :fixe WHERE id = :id";
					$requete = $this->bdd->prepare($query);
					$requete->bindValue(':fixe', htmlspecialchars($fixe));
					$requete->bindValue(':id', $id);
					$requete->execute();
				}
				else {
					$message = $message . "<p>Le numéro de téléphone fixe ne respecte pas le bon format</p>";
				}
			}
			if (isset($numero)){
				if ($numero > 0 and $numero < 1000){
					$query = "UPDATE energiculteur.utilisateur SET numMaison = :numero WHERE id = :id";
					$requete = $this->bdd->prepare($query);
					$requete->bindValue(':numero', $numero);
					$requete->bindValue(':id', $id);
					$requete->execute();
				}
				else {
					$message = $message . "<p>Le numéro de maison saisi est trop grand</p>";
				}
			}
			if (isset($complement)){
				if (strlen($complement) < 101){
					$query = "UPDATE energiculteur.utilisateur SET complement = :complement WHERE id = :id";
					$requete = $this->bdd->prepare($query);
					$requete->bindValue(':complement', htmlspecialchars($complement));
					$requete->bindValue(':id', $id);
					$requete->execute();
				}
				else {
					$message = $message . "<p>Le complément d'adresse ne peut pas faire plus de 100 caractères</p>";
				}
			}
			if (isset($ville)){
				if (strlen($nom) > 2 and strlen($nom) < 51){
					$query = "UPDATE energiculteur.utilisateur SET ville = :ville WHERE id = :id";
					$requete = $this->bdd->prepare($query);
					$requete->bindValue(':ville', htmlspecialchars($ville));
					$requete->bindValue(':id', $id);
					$requete->execute();
				}
				else {
					$message = $message . "<p>La ville doit faire entre 3 et 50 caractères</p>";
				}
			}
			if (isset($postal)){
				if ($postal >= 1000 and $postal <= 97680){
					$query = "UPDATE energiculteur.utilisateur SET postal = :postal WHERE id = :id";
					$requete = $this->bdd->prepare($query);
					$requete->bindValue(':postal', $postal);
					$requete->bindValue(':id', $id);
					$requete->execute();
				}
				else {
					$message = $message . "<p>Le code postal doit être compris entre 1000 et 97680</p>";
				}
			}
			if (isset($rang)){
				if ($rang >= 0 and $rang <= 2){
					$query = "UPDATE energiculteur.utilisateur SET rang = :rang WHERE id = :id";
					$requete = $this->bdd->prepare($query);
					$requete->bindValue(':rang', $rang);
					$requete->bindValue(':id', $id);
					$requete->execute();
				}
				else {
					$message = $message . "<p>Le rang doit être compris entre 0 et 2</p>";
				}
			}
		}
		$message = $message . "<p>Vous n'avez pas entré l'identifiant à modifier.<p>";
		return $message;
	}
/*
	LES METHODES QUI SUIVENT ONT UN USAGE EXCLUSIF AU FORUM.
	Documentation :
	La methode 'forum_nouvelle_categorie(String $titre)' permet d'ajouter une nouvelle catégorie au forum
	et retourne 1 si l'ajout c'est bien passé, 0 sinon.
	La methode 'forum_nouveau_message(int $id_categorie, int $id_auteur, String $titre, String $corps)' permet
	d'ajouter un nouveau message dans une certaine catégorie du forum. Elle retourne 1 si la création s'est
	bien passé, 0 sinon.
	La methode 'forum_nouvelle_reponse(int $id_message, int $id_auteur, String $corps)' permet d'ajouter une
	réponse à un message. Si l'ajout s'est bien passé, la méthode retourne 1, 0 sinon. 
*/

	function forum_nouvelle_categorie($title){
		try{
			if ($title){
				# AJOUTER LA SECURITE CONTRE LES FAILLES PAR INJECTION DE JAVASCRIPT
				$req = $bd->prepare('INSERT INTO forumCategorie(nom) VALUES(\':titreCategorie\')');
				$req->bindValue(':titreCategorie', $title);
				$res->execute();
				return 1;
			}
			else{
				return 0;
			}
		}
		catch(PDOException $e){
			die('<p>Impossible d\'ajouter une catégorie au forum. Erreur[' . $e->getCode() . '] : ' . $e->getMessage() . '<p>');
		}
	}
	function forum_nouveau_message($id_categorie, $id_auteur, $titre, $corps){
		try{
			if ($title){
				# AJOUTER LA SECURITE CONTRE LES FAILLES PAR INJECTION DE JAVASCRIPT
				$req = $bdd->prepare('INSERT INTO message(id_categorie, id_auteur, titre, corps, date_creation) VALUES (:id_c, :id_a, \':title\', \':content\', \'CURRENT_DATE\')');
				$req->bindValue(':id_c', $id_categorie);
				$req->bindValue(':id_a', $id_auteur);
				$req->bindValue(':title', $titre);
				$req->bindValue(':content', $corps);
				$res->execute();
				return 1;
			}
			else{
				return 0;
			}
		}
		catch(PDOException $e){
			die('<p>Impossible d\'ajouter un message au forum. Erreur[' . $e->getCode() . '] : ' . $e->getMessage() . '<p>');
		}
	}
	function forum_nouvelle_reponse($id_message, $id_auteur, $corps){
		try{
			if ($title){
				# AJOUTER LA SECURITE CONTRE LES FAILLES PAR INJECTION DE JAVASCRIPT
				$req = $bdd->prepare('INSERT INTO message(id_message, id_auteur, corps, date_creation) VALUES (:id_m, :id_a,  \':content\', \'CURRENT_DATE\')');
				$req->bindValue(':id_m', $id_categorie);
				$req->bindValue(':id_a', $id_auteur);
				$req->bindValue(':content', $corps);
				$res->execute();
				return 1;
			}
			else{
				return 0;
			}
		}
		catch(PDOException $e){
			die('<p>Impossible d\'ajouter un message au forum. Erreur[' . $e->getCode() . '] : ' . $e->getMessage() . '<p>');
		}
	}

	function get_three_last_articles(){
		try{
			$query = "SELECT titre, corps FROM energiculteur.three_last_articles";
			$requete = $this->bdd->prepare($query);
			$requete->execute();
			$data = $requete->fetchAll();
			return $data;
		}
		catch(PDOException $e){
			die("Impossible de récupérer les 3 derniers articles");
		}
	}

	function get_sujets($id_categorie){
		try{
			$query = "SELECT id, titre, corps FROM energiculteur.message WHERE id_categorie = :id_c ORDER BY id DESC";
			$requete = $this->bdd->prepare($query);
			$requete->bindValue(':id_c', $id_categorie);
			$requete->execute();
			$data = $requete->fetchAll();
			return $data;
		}
		catch(PDOException $e){
			die("<p>Impossible de récupérer les sujets [". $e->getCode()."]</p>");
		}
	}
	function get_contenu_sujet($id){
		try{
			$query = "SELECT * FROM energiculteur.message WHERE id = :ident";
			$requete = $this->bdd->prepare($query);
			$requete->bindValue(":ident", $id);
			$requete->execute();
			return $requete->fetch();

		}
		catch (PDOException $e){
			die("Impossible de voir le contenu du sujet");
		}
	}


	function get_categorie($ident){
		$query = "SELECT * FROM energiculteur.forumCategorie WHERE id = :identi";
		$requete = $this->bdd->prepare($query);
		$requete->bindValue(':identi', $ident);
		$requete->execute();
		$data = $requete->fetch();
		return $data;
	}

	function get_all_categorie(){
		$query = "SELECT * FROM energiculteur.forumCategorie";
		$requete = $this->bdd->prepare($query);
		$requete->execute();
		$data = $requete->fetchAll();
		return $data;
	}
	function get_nb_reponse($id_message){
		$query = "SELECT count(*) FROM energiculteur.reponse WHERE id_message = :id_m";
		$requete = $this->bdd->prepare($query);
		$requete->bindValue(':id_m', $id_message);
		$requete->execute();
		return $requete->fetch();
	}
	function get_derniere_reponse($id_message){
		$query = "SELECT date_reponse FROM energiculteur.reponse WHERE id_message = :id_m";
		$requete = $this->bdd->prepare($query);
		$requete->bindValue(':id_m', $id_message);
		$requete->execute();
		return $requete->fetchAll();
	}
	function get_all_reponses($id_message){
		$query = "SELECT * FROM energiculteur.reponse WHERE id_message = :id";
		$requete = $this->bdd->prepare($query);
		$requete->bindValue(':id', $id_message);
		$requete->execute();
		return $requete->fetchAll();
	}

	function get_nb_sujets(){
		try{
			$query = "SELECT * FROM energiculteur.nb_sujets";
			$requete = $this->bdd->prepare($query);
			$requete->execute();
			return $requete->fetch()['nb_sujets'];
		}
		catch(PDOException $e){
			die("Erreur");
		}
	}
	function get_nb_reponses(){
		try{
			$query = "SELECT * FROM energiculteur.nb_reponses";
			$requete = $this->bdd->prepare($query);
			$requete->execute();
			return $requete->fetch()['nb_reponses'];
		}
		catch(PDOException $e){
			die("Erreur");
		}
	}
	function get_titre_auteur_dernier_sujet_poste(){
		try{
			$query = "SELECT titre, id_auteur FROM energiculteur.message ORDER BY id DESC LIMIT 1";
			$requete = $this->bdd->prepare($query);
			$requete->execute();
			$resultat = $requete->fetch();

			$query = "SELECT prenom, nom FROM energiculteur.utilisateur WHERE id = :id_a";
			$requete = $this->bdd->prepare($query);
			$requete->bindValue(':id_a', $resultat['id_auteur']);
			$requete->execute();
			$res = $requete->fetch();
			
			$data = array(
				'titre' => $resultat['titre'],
				'prenom' => $res['prenom'],
				'nom' => $res['nom']
			);
			return $data;
		}
		catch(PDOException $e){
			die("Erreur");
		}
	}

	function delete_forum_reponse($id_reponse){
		try{
			$query = "DELETE FROM reponse WHERE id_reponse = :id_r";
			$requete = $this->bdd->prepare($query);
			$requete->bindValue(':id_r', $id_reponse);
			$requete->execute();
			echo "ahah";
		}
		catch(PDOException $e){
			die('Impossible de supprimer la réponse');
		}
	}



#################################FONCTION PROPRE A LA BOUTIQUE#################################

	function nombre_dannonce_poste(){
		try{
			$query = "SELECT * FROM energiculteur.nb_annonce"; #nb_annonce correspond a la vue cree avec le nombre dannonce.
			$requete = $this->bdd->prepare($query);
			$requete->execute();
			return $requete->fetch()['nbannonce'];
		}
		catch(PDOException $e){
			die("Erreur");
		}
	}

	public function boutiqueVente($region, $categorie, $etat, $nom, $description, $prix, $pseudo, $num, $mail){
		if(non_vide($region) and non_vide($categorie) and non_vide($etat) and non_vide($nom) and non_vide($description)and non_vide($prix) and non_vide($pseudo) and non_vide($num) and non_vide($mail)){
			try{
					$req2 = $this->bdd->prepare('INSERT INTO energiculteur.vente(region_produit, categorie_produit, etat_produit, nom_produit, description_produit, prix_produit, pseudo_vendeur, num_vendeur, mail_vendeur) VALUES(:region, :categorie, :etat, :nom, :description, :prix, :pseudo, :num, :mail)');

					$req2->bindValue(':region', $region);
					$req2->bindValue(':categorie', $categorie);
					$req2->bindValue(':etat', $etat);
					$req2->bindValue(':nom', $nom);
					$req2->bindValue(':description', $description);
					$req2->bindValue(':prix', $prix);
					$req2->bindValue(':pseudo', $pseudo);
					$req2->bindValue(':num', $num);
					$req2->bindValue(':mail', $mail);
					$req2->execute();

					return 1;
			}
			catch (PDOException $e){
				//Si la connexion échoue, on termine le script
				die('<p> La connexion a échoué. Erreur['.$e->getCode().'] : '. $e->getMessage().'</p>');
			}
		}
		else {
			echo "<p>Tous les champs doivent être complétés.</p>";
		}
	}

#New
	function get_description_produit($id_produit){
		try{
			$query = "SELECT * FROM energiculteur.vente WHERE id_produit = :ident";
			$requete = $this->bdd->prepare($query);
			$requete->bindValue(":ident", $id_produit);
			$requete->execute();
			return $requete->fetch();

		}
		catch (PDOException $e){
			die("Impossible de voir le contenu du sujet");
		}
	}
	function get_derniere_annonce(){
		
		try{
		$query = "SELECT nom_produit, etat_produit, categorie_produit, region_produit, prix_produit FROM energiculteur.vente order by id_produit desc LIMIT 10";
		$requete = $this->bdd->prepare($query);
		
		$requete->execute();
		return $requete->fetchAll();

		}
			catch(PDOException $e){
				die('<p> La connexion a échoué. Erreur['.$e.getCode().'] : ' . $e->getMessage().'</p>');
			}
	}

	function trouver_annonce($searchBar){

		try {
		
			if(isset($_POST['searchBar']) AND NULL!=($_POST['searchBar'])){
				$searchBar = htmlspecialchars($_POST[searchBar]);		
				$query = "SELECT nom_produit FROM energiculteur.vente WHERE nom_produit LIKE "%'.$searchBar.'%" ORDER BY id_produit DESC";
				$requete = $this->bdd->prepare($query);
				
				$requete->execute();
				return $requete->fetch();
				
			}
		}

		
			catch(PDOException $e){
				die('<p> La connexion a échoué. Erreur['.$e.getCode().'] : ' . $e->getMessage().'</p>');
			}
		
	}
	
}

?>



