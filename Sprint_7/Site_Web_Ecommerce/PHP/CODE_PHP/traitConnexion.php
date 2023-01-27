<?php
	// on inclut le fichier de connexion à la base Oracle
    session_start();
	require_once("connect.inc.php");
    error_reporting(0);

    if(isset($_POST['Connexion'])) {

        if(isset($_POST['adresseMail']) && isset($_POST['motDePasse'])) {

            //On récupère les valeurs renseignées par l'utilisateur dans les champs de texte
            $mailActeur = htmlspecialchars($_POST['adresseMail']);
            $mdpActeur = htmlspecialchars($_POST['motDePasse']);

            if(!preg_match('#^[a-z0-9._-]+@[a-z0-9._-]{2,}\.[a-z]{2,4}$#', $mailActeur)) {
                header('Location: ./connexion.php?msgErreur=Vérifiez la saisie de votre adresse mail');
                exit;
            }

            //On crée une requete paramétrée
            $req = "SELECT * FROM ACTEUR WHERE MAILACTEUR = :pMailActeur";

            //On prépare la requête
            $clientRecup = oci_parse($connect, $req);

            //On lie les valeurs aux paramètres de la requête
            oci_bind_by_name($clientRecup, ":pMailActeur", $mailActeur);

            //On exécute la requête
            $result = oci_execute($clientRecup);

            // si erreur de requete alors affichage...
            if (!$result) {
                $e = oci_error($clientRecup);  // on récupère l'exception liée au pb d'execution de la requete (violation PK par exemple)
                $errorSQL = print htmlentities($e['message'].' pour cette requete : '.$e['sqltext']);
                header("Location: ./connexion.php=?msgErreur=$errorSQL");
                exit;

            } else {

                $clientDatabase = oci_fetch_assoc($clientRecup);

                if(empty($clientDatabase)){

                    header('Location: ./connexion.php?msgErreur=Compte inexistant');
                    exit;
                }

                if(password_verify($mdpActeur, $clientDatabase['MDPACTEUR'])) {

                    $_SESSION['id'] = $clientDatabase['IDACTEUR']; //Auto
                    $_SESSION['nom'] = $clientDatabase['NOMACTEUR']; 
                    $_SESSION['prenom'] = $clientDatabase['PRENOMACTEUR']; 
                    $_SESSION['utilisateur'] = $clientDatabase['ROLEACTEUR']; //Auto
                    $_SESSION['adresse'] = $clientDatabase['ADRACTEUR']; 
                    $_SESSION['mail'] = $clientDatabase['MAILACTEUR']; 
                    $_SESSION['mdp'] = $clientDatabase['MDPACTEUR']; 
                    $_SESSION['langue'] = $clientDatabase['PREFLANGUE']; 
                    $_SESSION['theme'] = $clientDatabase['PREFTHEME'];
                    $_SESSION['ptsfidelite'] = $clientDatabase['PTSFIDELITECLIENT']; //Auto
                    $_SESSION['monnaie'] = $clientDatabase['PREFMONNAIE'];

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