<?php
    // on inclut le fichier de connexion à la base Oracle
    require_once("connect.inc.php");
    error_reporting(0);

    session_start();

    if(!isset($_POST['Sauvegarder'])) {
        header('Location: ./modification.php?msgErreur=Veuillez remplir les champs');
        exit;
    }

    if (empty($_POST['langues']) || empty($_POST['theme']) || empty($_POST['monnaie'])) {
        header('Location: ./modification.php?msgErreur=Sélection incorrecte');
        exit;
    }

    if (!(isset($_POST['prenom']) && isset($_POST['nom']) && isset($_POST['adresse']) && isset($_POST['adresseMail']) && isset($_POST['motdepasse']) && isset($_POST['confmdp']))) {
        header('Location: ./modification.php?msgErreur=Veuillez remplir les champs');
        exit;
    }

    $prenomActeur = htmlspecialchars($_POST['prenom']);
    $nomActeur = htmlspecialchars($_POST['nom']);
    $adresseActeur = htmlspecialchars($_POST['adresse']);
    $mailActeur = htmlspecialchars($_POST['adresseMail']);
    $mdpActeur = htmlspecialchars($_POST['motdepasse']);
    $confmdpActeur = htmlspecialchars($_POST['confmdp']);

    $hashedMDP = password_hash($mdpActeur, PASSWORD_DEFAULT);

    if($mdpActeur != $confmdpActeur){
        header('Location: ./modification.php?msgErreur=Mots de passe différents');
        exit;
    }

    if (!preg_match('#^[a-z0-9._-]+@[a-z0-9._-]{2,}\.[a-z]{2,4}$#', $mailActeur)) {
        header('Location: ./modification.php?msgErreur=Vérifiez la saisie de votre adresse mail');
        exit;
    }

    $id = $_SESSION['id'];

    //On crée une requete paramétrée
    $req = "UPDATE ACTEUR
            SET NOMACTEUR = :pNom,
            PRENOMACTEUR = :pPrenom, 
            ADRACTEUR = :pAdresse, 
            MAILACTEUR = :pMail, 
            MDPACTEUR = :pMDP, 
            PREFLANGUE = :pLangue, 
            PREFTHEME = :pTheme, 
            PREFMONNAIE = :pMonnaie
            WHERE IDACTEUR='$id'";

    //On prépare la requête
    $acteurRecup = oci_parse($connect, $req);

    //On lie les valeurs aux paramètres de la requête
    oci_bind_by_name($acteurRecup, ":pNom", $nomActeur);
    oci_bind_by_name($acteurRecup, ":pPrenom", $prenomActeur);
    oci_bind_by_name($acteurRecup, ":pAdresse", $adresseActeur);
    oci_bind_by_name($acteurRecup, ":pMail", $mailActeur);
    oci_bind_by_name($acteurRecup, ":pMDP", $hashedMDP);
    oci_bind_by_name($acteurRecup, ":pLangue", $_POST['langues']);
    oci_bind_by_name($acteurRecup, ":pTheme", $_POST['theme']);
    oci_bind_by_name($acteurRecup, ":pMonnaie", $_POST['monnaie']);

    $result = oci_execute($acteurRecup);

    if (!$result) {
        $e = oci_error($acteurRecup);  // on récupère l'exception liée au pb d'execution de la requete (violation PK par exemple)
        $SQLerror = htmlentities($e['message'] . ' pour cette requete : ' . $e['sqltext']);

        header('Location: ./inscription.php?msgErreur=' .$SQLerror);
        exit;
    }

    oci_commit($connect);

    oci_free_statement($acteurRecup);

    session_destroy();

    echo('<script language="JavaScript" type="text/javascript"> 
            alert("Modification réussie. Veuillez-vous reconnecter."); 
            location.href = "./connexion.php";
          </script>');
?>