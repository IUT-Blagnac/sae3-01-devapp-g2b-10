<?php
	// on inclut le fichier de connexion à la base Oracle
	require_once("connect.inc.php");
	
	session_start();

    if(isset($_POST['Connexion'])) {

        if(isset($_POST['adresseMail']) && isset($_POST['motDePasse'])) {

            //On crée une requete paramétrée
            $req = "SELECT * FROM ACTEUR WHERE MAILACTEUR = :pMailActeur";

            //On prépare la requête
            $clientRecup = oci_parse($connect, $req);

            //On récupère les valeurs renseignées par l'utilisateur dans les champs de texte
            $mailActeur = htmlspecialchars($_POST['adresseMail']);
            $mdpActeur = htmlspecialchars($_POST['motDePasse']);

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

                    $_SESSION['utilisateur'] = $clientDatabase['ROLEACTEUR'];
                    $_SESSION['prenom'] = $clientDatabase['PRENOMACTEUR'];
                    $_SESSION['nom'] = $clientDatabase['NOMACTEUR'];

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

		header('Location: ./connexion.php?msgErreur=Mot de passe incorrect');
		exit;
    }

	header('Location: ./connexion.php?msgErreur=Veuillez remplir les champs');
	exit;

?>