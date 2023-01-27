<?php
    // on inclut le fichier de connexion à la base Oracle
    require_once("connect.inc.php");
    error_reporting(0);

    session_start();

    if(!isset($_POST['Inscription'])) {
        header('Location: ./inscription.php?msgErreur=Veuillez remplir les champs');
        exit;
    }

    if (empty($_POST['langues'])){
        header('Location: ./inscription.php?msgErreur=Sélection incorrecte');
        exit;
    }

    if (!(isset($_POST['prenom']) && isset($_POST['nom']) && isset($_POST['adresse']) && isset($_POST['adresseMail']) && isset($_POST['motdepasse']) && isset($_POST['confmdp']))) {
        header('Location: ./inscription.php?msgErreur=Veuillez remplir les champs');
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
        header('Location: ./inscription.php?msgErreur=Mots de passe différents');
        exit;
    }

    if (!preg_match('#^[a-z0-9._-]+@[a-z0-9._-]{2,}\.[a-z]{2,4}$#', $mailActeur)) {
        header('Location: ./inscription.php?msgErreur=Vérifiez la saisie de votre adresse mail');
        exit;
    }

    $req = "SELECT * FROM ACTEUR WHERE MAILACTEUR = :pMailActeur";
    $acteurRecup = oci_parse($connect, $req);
    oci_bind_by_name($acteurRecup, ":pMailActeur", $mailActeur);
    $result = oci_execute($acteurRecup);

    if (!$result) {
        $e = oci_error($acteurRecup);  // on récupère l'exception liée au pb d'execution de la requete (violation PK par exemple)
        $SQLerror = htmlentities($e['message'] . ' pour cette requete : ' . $e['sqltext']);

        header('Location: ./inscription.php?msgErreur=' . $SQLerror);
        exit;
    }

    if (oci_fetch_assoc($acteurRecup)) {
        header('Location: ./inscription.php?msgErreur=Compte déjà existant');
        exit;
    }

    oci_free_statement($acteurRecup);

    $req = "INSERT INTO ACTEUR (IDACTEUR,NOMACTEUR,PRENOMACTEUR,ADRACTEUR,MAILACTEUR,MDPACTEUR,PREFLANGUE,PREFTHEME,PTSFIDELITECLIENT,PREFMONNAIE,ROLEACTEUR) VALUES(SEQ_ACTEUR.NEXTVAL,:pNom,:pPrenom,:pAdresse,:pMail,:pMDP,:pLangue,'CLAIR',0,'EUR','Client')";
    $acteurInsert = oci_parse($connect, $req);
    oci_bind_by_name($acteurInsert, ":pNom", $nomActeur);
    oci_bind_by_name($acteurInsert, ":pPrenom", $prenomActeur);
    oci_bind_by_name($acteurInsert, ":pAdresse", $adresseActeur);
    oci_bind_by_name($acteurInsert, ":pMail", $mailActeur);
    oci_bind_by_name($acteurInsert, ":pMDP", $hashedMDP);
    oci_bind_by_name($acteurInsert, ":pLangue", $_POST['langues']);

    $result = oci_execute($acteurInsert);

    if (!$result) {
        $e = oci_error($acteurInsert);  // on récupère l'exception liée au pb d'execution de la requete (violation PK par exemple)
        $SQLerror = htmlentities($e['message'] . ' pour cette requete : ' . $e['sqltext']);

        header('Location: ./inscription.php?msgErreur=' .$SQLerror);
        exit;
    }

    oci_commit($connect);

    oci_free_statement($acteurInsert);

    echo('<script language="JavaScript" type="text/javascript"> 
            alert("Inscription réussie."); 
            location.href = "./connexion.php";
          </script>');
?>