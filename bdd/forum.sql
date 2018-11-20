CREATE DATABASE  IF NOT EXISTS energiculteur;
use energiculteur;


SET NAMES 'utf8';

# UTILISATEUR
CREATE TABLE utilisateur(
	id integer primary key not null AUTO_INCREMENT,
	prenom varchar(51) not null,
	nom varchar(51) not null,
	sexe char not null,
	email varchar(151) not null,
	password varchar(101) not null,
	passwordvernam varchar(101) not null,
	tel_port varchar(21),
	tel_fixe varchar(21),
	rue varchar(101) not null,
	numMaison varchar(76) not null,
	complement varchar(151),
	ville varchar(76) not null,
	postal integer not null,
	deja_achete boolean not null default 0,
	rang integer not null default 0);

CREATE TABLE phrase_commerciale(
	id integer primary key not null AUTO_INCREMENT,
	titre varchar(141) not null,
	phrase varchar(256) not null
);

# BASE DE DONNEES DU FORUM
CREATE TABLE forumCategorie(
	id integer primary key not null AUTO_INCREMENT,
	nom varchar(51) not null default "Catégorie sans nom."
);
CREATE TABLE message(
	id integer primary key not null AUTO_INCREMENT,
	id_categorie integer not null,
	id_auteur integer not null, 
	titre varchar(51) not null,
	corps text not null,
	verrouille boolean not null default 0,
	date_creation datetime not null default now()
);
CREATE TABLE reponse(
	id_reponse integer primary key not null AUTO_INCREMENT,
	id_message integer not null,
	id_auteur integer not null,
	corps text not null,
	date_reponse datetime not null default now()
);

####################################CREATION BOUTIQUE ET PRODUIT####################################

CREATE TABLE IF NOT EXISTS vente(
	id_produit int primary key not null AUTO_INCREMENT,
	region_produit varchar(30) not null,
	categorie_produit varchar(30) not null,
	etat_produit varchar(20) not null,
	nom_produit varchar(50)not null ,
	description_produit text,
	prix_produit int not null,
	pseudo_vendeur varchar(30) not null,
	num_vendeur int not null,
	mail_vendeur varchar(100) not null);

CREATE VIEW nb_annonce AS SELECT count(*) AS nbannonce FROM vente;
CREATE VIEW three_last_articles AS SELECT id, titre, corps FROM message WHERE id_categorie = 1 ORDER BY id DESC LIMIT 3;
CREATE VIEW nb_inscrits AS SELECT count(*) AS inscrits FROM utilisateur;
CREATE VIEW nb_sujets AS SELECT count(*) AS nb_sujets FROM message;
CREATE VIEW nb_reponses AS SELECT count(*) AS nb_reponses FROM reponse;
CREATE VIEW nb_acheteurs AS SELECT count(*) AS nb_acheteurs FROM utilisateur WHERE deja_achete = 1;

ALTER TABLE utilisateur CONVERT TO CHARACTER SET utf8;
ALTER TABLE phrase_commerciale CONVERT TO CHARACTER SET utf8;
ALTER TABLE forumCategorie CONVERT TO CHARACTER SET utf8;
ALTER TABLE message CONVERT TO CHARACTER SET utf8;
ALTER TABLE reponse CONVERT TO CHARACTER SET utf8;

INSERT INTO phrase_commerciale(titre, phrase) VALUES('Envie de faire des économies énergétiques ?', 'Nos capteurs seront capables de vous dire quand il est vraiment utile de dépenser via notre plateforme.');

INSERT INTO forumCategorie(id, nom) VALUES (1, 'Articles');
INSERT INTO forumCategorie(nom) VALUES ('Discutions Générales');
INSERT INTO forumCategorie(nom) VALUES ('Centre d \'Aide');

INSERT INTO message(id_categorie, id_auteur, titre, corps) VALUES(1, 1, 'Premier article', 'Le Lorem Ipsum est simplement du faux texte employé dans la composition et la mise en page avant impression. Le Lorem Ipsum est le faux texte standard de 	l\'imprimerie depuis les années 1500, quand un peintre anonyme assembla ensemble des morceaux de texte pour réaliser un livre spécimen de polices de texte. Il n\'a pas fait que survivre cinq siècles, mais s\'est aussi adapté à la bureautique informatique, sans que son contenu n\'en soit modifié. Il a été popularisé dans les années 1960 grâce à la vente de feuilles Letraset contenant des passages du Lorem Ipsum, et, plus récemment, par son inclusion dans des applications de mise en page de texte, comme Aldus PageMaker.');
INSERT INTO message(id_categorie, id_auteur, titre, corps) VALUES(1, 1, 'Second article', 'Le Lorem Ipsum est simplement du faux texte employé dans la composition et la mise en page avant impression. Le Lorem Ipsum est le faux texte standard de 	l\'imprimerie depuis les années 1500, quand un peintre anonyme assembla ensemble des morceaux de texte pour réaliser un livre spécimen de polices de texte. Il n\'a pas fait que survivre cinq siècles, mais s\'est aussi adapté à la bureautique informatique, sans que son contenu n\'en soit modifié. Il a été popularisé dans les années 1960 grâce à la vente de feuilles Letraset contenant des passages du Lorem Ipsum, et, plus récemment, par son inclusion dans des applications de mise en page de texte, comme Aldus PageMaker.');
INSERT INTO message(id_categorie, id_auteur, titre, corps) VALUES(1, 1, 'Troisième article', 'Le Lorem Ipsum est simplement du faux texte employé dans la composition et la mise en page avant impression. Le Lorem Ipsum est le faux texte standard de 	l\'imprimerie depuis les années 1500, quand un peintre anonyme assembla ensemble des morceaux de texte pour réaliser un livre spécimen de polices de texte. Il n\'a pas fait que survivre cinq siècles, mais s\'est aussi adapté à la bureautique informatique, sans que son contenu n\'en soit modifié. Il a été popularisé dans les années 1960 grâce à la vente de feuilles Letraset contenant des passages du Lorem Ipsum, et, plus récemment, par son inclusion dans des applications de mise en page de texte, comme Aldus PageMaker.');
INSERT INTO message(id_categorie, id_auteur, titre, corps) VALUES(3, 1, 'Troisième article', 'Le Lorem Ipsum est simplement du faux texte employé dans la composition et la mise en page avant impression. Le Lorem Ipsum est le faux texte standard de 	l\'imprimerie depuis les années 1500, quand un peintre anonyme assembla ensemble des morceaux de texte pour réaliser un livre spécimen de polices de texte. Il n\'a pas fait que survivre cinq siècles, mais s\'est aussi adapté à la bureautique informatique, sans que son contenu n\'en soit modifié. Il a été popularisé dans les années 1960 grâce à la vente de feuilles Letraset contenant des passages du Lorem Ipsum, et, plus récemment, par son inclusion dans des applications de mise en page de texte, comme Aldus PageMaker.');
INSERT INTO message(id_categorie, id_auteur, titre, corps) VALUES(1, 1, 'Quatrième article', 'Le Lorem Ipsum est simplement du faux texte employé dans la composition et la mise en page avant impression. Le Lorem Ipsum est le faux texte standard de 	l\'imprimerie depuis les années 1500, quand un peintre anonyme assembla ensemble des morceaux de texte pour réaliser un livre spécimen de polices de texte. Il n\'a pas fait que survivre cinq siècles, mais s\'est aussi adapté à la bureautique informatique, sans que son contenu n\'en soit modifié. Il a été popularisé dans les années 1960 grâce à la vente de feuilles Letraset contenant des passages du Lorem Ipsum, et, plus récemment, par son inclusion dans des applications de mise en page de texte, comme Aldus PageMaker.');
INSERT INTO message(id_categorie, id_auteur, titre, corps) VALUES(2, 1, 'Première Discution', 'Le Lorem Ipsum est simplement du faux texte employé dans la composition et la mise en page avant impression. Le Lorem Ipsum est le faux texte standard de 	l\'imprimerie depuis les années 1500, quand un peintre anonyme assembla ensemble des morceaux de texte pour réaliser un livre spécimen de polices de texte. Il n\'a pas fait que survivre cinq siècles, mais s\'est aussi adapté à la bureautique informatique, sans que son contenu n\'en soit modifié. Il a été popularisé dans les années 1960 grâce à la vente de feuilles Letraset contenant des passages du Lorem Ipsum, et, plus récemment, par son inclusion dans des applications de mise en page de texte, comme Aldus PageMaker.');
INSERT INTO message(id_categorie, id_auteur, titre, corps) VALUES(3, 1, 'Première Aide', 'Le Lorem Ipsum est simplement du faux texte employé dans la composition et la mise en page avant impression. Le Lorem Ipsum est le faux texte standard de 	l\'imprimerie depuis les années 1500, quand un peintre anonyme assembla ensemble des morceaux de texte pour réaliser un livre spécimen de polices de texte. Il n\'a pas fait que survivre cinq siècles, mais s\'est aussi adapté à la bureautique informatique, sans que son contenu n\'en soit modifié. Il a été popularisé dans les années 1960 grâce à la vente de feuilles Letraset contenant des passages du Lorem Ipsum, et, plus récemment, par son inclusion dans des applications de mise en page de texte, comme Aldus PageMaker.');

INSERT INTO reponse(id_message, id_auteur, corps) VALUES (1, 1, 'Ceci est une réponse à un message');
INSERT INTO reponse(id_message, id_auteur, corps) VALUES (1, 1, 'Ceci est une réponse à un message');
INSERT INTO reponse(id_message, id_auteur, corps) VALUES (1, 1, 'Ceci est une réponse à un message');

INSERT INTO vente(id_produit,region_produit, categorie_produit, etat_produit,  nom_produit, description_produit, prix_produit, pseudo_vendeur,num_vendeur,mail_vendeur)
	VALUES(1,'Alsace', 'Vehicule', 'Neuf', 'Tracteur XZ','Le tracteur à vapeur et à chenille a été inventé par le Russe Fiodor Blinov en 18811.Tracteur à chenilles Henry Bauchet Rethel (Ardennes, France).', 240000,'Jack Bizot',0606060606,'senpai@japan.com');

INSERT INTO vente(id_produit,region_produit, categorie_produit, etat_produit,  nom_produit, description_produit, prix_produit, pseudo_vendeur,num_vendeur,mail_vendeur)
	VALUES(2,'Limousin', 'Animaux', 'Neuf', 'Chevaux nain','Le tracteur à vapeur et à chenille a été inventé par le Russe Fiodor Blinov en 18811.Tracteur à chenilles Henry Bauchet Rethel (Ardennes, France).', 3000,'Steven Mcfly',0606060606,'senpai@japan.com');

INSERT INTO vente(id_produit,region_produit, categorie_produit, etat_produit,  nom_produit, description_produit, prix_produit, pseudo_vendeur,num_vendeur,mail_vendeur)
	VALUES(3,'Alsace', 'Vehicule', 'Occasion', 'Bus','Le tracteur à vapeur et à chenille a été inventé par le Russe Fiodor Blinov en 18811.Tracteur à chenilles Henry Bauchet Rethel (Ardennes, France).', 1500,'Troye GANAGANE',0606060606,'senpai@japan.com');


