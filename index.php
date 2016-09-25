<?php

	require_once("pdo.php"); // on dit que l'on à besoin du contenu du fichier pdo.php. Toutes les fonctions définies dedans sont donc accessibles maintenant.


	// cette fonction prend la connexion en entrée et execute la requete qu'elle contient.
	// J'utilise une fonction car je lance ça deux fois
	function displayProducts(PDO $pdo){
		echo "Contenu de la table Products<br/><hr/>";
		$sql = "SELECT name, imagePath FROM products";

		$response = $pdo->query($sql); // on execute la requete et on met tout le résultat dans $response
		while($row = $response->fetch()){ // on parcours le résultat ligne par ligne
			echo "Produit : ".$row['name']." / Image : ".$row['imagePath']."<br/>"; // au lieu de mettre les noms, on peut mettre le numéro de la position de la valeur dans la requete. Ici name = 0 et imagePath = 1
  		}
  		echo "<hr/><br/><br/>";
	}
	
	
	
	/*
	 * Le petit programme suivant va se connecter à la base de donnée, faire un select dans une table et afficher le résultat, puis ajoutera un nouveau produit à la liste.
	 */
	
	$pdo = connect();
	if($pdo == null){
		echo "Error while trying to connect to the database<br/>";
	}
	else{
		displayProducts($pdo);


  		$productNameToInsert = "toto";
  		$productImagePath = "./images/monImage.jpg";
  		$insert = "INSERT INTO products(name, imagePath) VALUES (:name,:image)"; // bien sur, tu peux concatener directement les valeurs, mais mettre des placeholder (les trucs avec ':' devant) c'est plus propre

  		$statement = $pdo->prepare($insert);
  		$statement->bindParam(":name",$productNameToInsert); //ici on dit de remplacer :name par la valeur de la variable
  		$statement->bindParam(":image",$productImagePath);
  		$statement->execute(); // ici on lance la requete.

  		displayProducts($pdo);

  		deconnect($pdo);

  		displayProducts($pdo); // lance une erreur car PDO est détruit
	}