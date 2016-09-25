<?php

	/*
	 * La bonne pratique veut que normalement la gestion de la connexion et de la déconnexion soient dans des fonctions en dehors du programme, pour ne pas recoder à chaque fois.
	 */
	
	/**
	 * Manages the database connection
	 */
	function connect(){
		$server_address = 'localhost';
		$db_name = 'my_db';
		$user_name = 'user';
		$user_password = 'password';
		
		/*
		 * PDO fonctionne avec un objet qui, tant qu'il est vivant, maintiens la connexion à la base. Il faut donc construire cet objet.
		 * Cependant, si PDO rencontre une erreur pour se connecter, il ne renvera pas nul ou autre, mais jettera une exception : le seul moyen de l'attraper sans tout casser est d'utiliser la structure try catch.
		 * Il essaye de se connecter dans le try. Si PDO jette une exception, le bloc catch l'intersepte (PDOException) et la traite (ici, l'affiche).
		 */
		
		
		try{
			return new PDO('mysql:host='.$server_address.';dbname='.$db_name, $user_name, $user_password);
		}
		catch (PDOException $e){
			print "Erreur !: " . $e->getMessage() . "<br/>";
			die();
		}
		return null; // seulement retourné si on à rencontré une erreur
	}
	
	function deconnect(&$pdo){
		$pdo = null;
	}


	