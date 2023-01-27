<?php
    // on inclut le fichier de connexion à la base Oracle
    require_once("connect.inc.php");
    error_reporting(0);

    session_start();

    if(!isset($_POST['Sauvegarder'])) {
        header('Location: ./updateProduit.php?msgErreur=Veuillez remplir les champs');
        exit;
    }

    if (empty($_POST['categorie']) || empty($_POST['nomArticle'])) {
        header('Location: ./updateProduit.php?msgErreur=Sélection incorrecte');
        exit;
    }

    if (!(isset($_POST['nomProduit']) && isset($_POST['prixProduit']) && isset($_POST['prixPromoProduit']) && isset($_POST['descProduit']))) {
        header('Location: ./updateProduit.php?msgErreur=Veuillez remplir les champs');
        exit;
    }

    $nomProduit = htmlspecialchars($_POST['nomProduit']);
    $prixProduit = htmlspecialchars($_POST['prixProduit']);
    $prixPromoProduit = htmlspecialchars($_POST['prixPromoProduit']);
    $descProduit = htmlspecialchars($_POST['descProduit']);

    $ancienProduit = $_POST['nomArticle'];

    if(!preg_match('#^[0-9]{1,8}[,.][0-9]{2}$#', $prixProduit)) {
        header('Location: ./updateProduit.php?msgErreur=Vérifiez la saisie de votre prix');
        exit;
    }

    if(!preg_match('#^[0-9]{1,2}$#', $prixPromoProduit)) {
        header('Location: ./updateProduit.php?msgErreur=Vérifiez la saisie de votre prix promo');
        exit;
    }

    //On crée une requete paramétrée
    $req = "UPDATE ARTICLE
            SET NOMARTICLE = :pArticle,
            NOMCATEGORIE = :pNomCategorie,
            PRIXARTICLE = :pPrixArticle,
            PRIXPROMO = :pPrixPromo,
            DESCRIPTION = :pDescription
            WHERE IDARTICLE ='$ancienProduit'";

    //On prépare la requête
    $nouveauArticleRecup = oci_parse($connect, $req);

    //On lie les valeurs aux paramètres de la requête
    oci_bind_by_name($nouveauArticleRecup, ":pArticle", $nomProduit);
    oci_bind_by_name($nouveauArticleRecup, ":pNomCategorie", $_POST['categorie']);
    oci_bind_by_name($nouveauArticleRecup, ":pPrixArticle", $prixProduit);
    oci_bind_by_name($nouveauArticleRecup, ":pPrixPromo", $prixPromoProduit);
    oci_bind_by_name($nouveauArticleRecup, ":pDescription", $descProduit);

    $result = oci_execute($nouveauArticleRecup);

    if (!$result) {
        $e = oci_error($nouveauArticleRecup);  // on récupère l'exception liée au pb d'execution de la requete (violation PK par exemple)
        $SQLerror = htmlentities($e['message'] . ' pour cette requete : ' . $e['sqltext']);
        header('Location: ./updateProduit.php?msgErreur=' .$SQLerror);
        exit;
    }

    oci_commit($connect);

    oci_free_statement($nouveauArticleRecup);

    echo('<script language="JavaScript" type="text/javascript"> 
            alert("Modification réussie."); 
            location.href = "./connexion.php";
          </script>');

?>