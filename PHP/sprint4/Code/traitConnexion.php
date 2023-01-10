<?php
	// on inclut le fichier de connexion à la base Oracle
	require_once("connect.inc.php");
	
	session_start();

    if(isset($_POST['Connexion'])) {

        if(isset($_POST['adresseMail']) && isset($_POST['motDePasse'])) {

			if(isset($_POST['memoAdmin'])) {

				$req = "SELECT * FROM ADMINISTRATEUR WHERE MAILADMIN = :pMailAdmin";

				//On prépare la requête
				$adminRecup = oci_parse($connect, $req);

				//On récupère les valeurs renseignées par l'utilisateur dans les champs de texte
				$mailAdmin = $_POST['adresseMail'];
				$mdpAdmin = $_POST['motDePasse'];

				//On lie les valeurs aux paramètres de la requête
				oci_bind_by_name($adminRecup, ":pMailAdmin", $mailAdmin);

				//On exécute la requête
				$result = oci_execute($adminRecup);

				// si erreur de requete alors affichage...
				if (!$result) {

					$e = oci_error($adminRecup);  // on récupère l'exception liée au pb d'execution de la requete (violation PK par exemple)
					print htmlentities($e['message'].' pour cette requete : '.$e['sqltext']);	

				} else {

					$adminDatabase = oci_fetch_assoc($adminRecup);

					if(empty($adminDatabase)){

						header('Location: ./connexion.php?msgErreur=Compte inexistant');
						exit;
					}

					if(password_verify($mdpAdmin, $adminDatabase['MDPADMIN'])) {

						$_SESSION['utilisateur'] = "admin";
						$_SESSION['prenom'] = $adminDatabase['PRENOMADMIN'];
						$_SESSION['nom'] = $adminDatabase['NOMADMIN'];

						if(isset($_POST['memo'])) {
							setcookie('cookIdentifiant', $_POST['adresseMail'], time()+60);
						} else {
							setcookie('cookIdentifiant', false, -1);
						}

						// Libère toutes les ressources réservées par un résultat Oracle
						oci_free_statement($adminRecup);

						header('Location: ./index.php');
						exit;

					} else {

						header('Location: ./connexion.php?msgErreur=Mot de passe invalide');
						exit;

					}
				}
			} else {

				//On crée une requete paramétrée
				$req = "SELECT * FROM ACTEUR WHERE MAILACTEUR = :pMailActeur";

				//On prépare la requête
				$clientRecup = oci_parse($connect, $req);

				//On récupère les valeurs renseignées par l'utilisateur dans les champs de texte
				$mailActeur = $_POST['adresseMail'];
				$mdpActeur = $_POST['motDePasse'];

				//On lie les valeurs aux paramètres de la requête
				oci_bind_by_name($clientRecup, ":pMailActeur", $mailActeur);

				//On exécute la requête
				$result = oci_execute($clientRecup);

				// si erreur de requete alors affichage...
				if (!$result) {
					$e = oci_error($clientRecup);  // on récupère l'exception liée au pb d'execution de la requete (violation PK par exemple)
					print htmlentities($e['message'].' pour cette requete : '.$e['sqltext']);		
				} else {

					$clientDatabase = oci_fetch_assoc($clientRecup);

					if(empty($clientDatabase)){

						header('Location: ./connexion.php?msgErreur=Compte inexistant');
						exit;
					}

					if(password_verify($mdpActeur, $clientDatabase['MDPACTEUR'])) {

						$_SESSION['utilisateur'] = "client";
						$_SESSION['prenom'] = $adminDatabase['PRENOMACTEUR'];
						$_SESSION['nom'] = $adminDatabase['NOMACTEUR'];

						if(isset($_POST['memo'])) {
							setcookie('cookIdentifiant', $_POST['adresseMail'], time()+60);
						} else {
							setcookie('cookIdentifiant', false, -1);
						}

						// Libère toutes les ressources réservées par un résultat Oracle
						oci_free_statement($clientRecup);

						header('Location: ./index.php');
						exit;

					} else {

						header('Location: ./connexion.php?msgErreur=Mot de passe invalide');
						exit;

					}
				}
			}

        } 

		header('Location: ./connexion.php?msgErreur=Mot de passe incorrect');
		exit;
    }

	header('Location: ./connexion.php?msgErreur=Veuillez remplir les champs');
	exit;

?>