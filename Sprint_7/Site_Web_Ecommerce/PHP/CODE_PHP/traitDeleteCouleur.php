<?php
  // on inclut le fichier de connexion à la base Oracle
  session_start();
  require_once("connect.inc.php");
  error_reporting(0);

  if(isset($_SESSION['langue']) && $_SESSION['langue'] == 'EN') {

    if(!isset($_POST['Retirer'])) {
      header('Location: ./deleteCouleur.php?msgErreur=Please select an item');
      exit;
    }

    if(empty($_POST['nomArticle']) || empty($_POST['couleur'])) {
      header('Location: ./deleteCouleur.php?msgErreur=Incorrect selection');
      exit;
    }

    $produit = $_POST['nomArticle'];
    $couleur = strtoupper(htmlspecialchars($_POST['couleur']));

    $reqSelect = "SELECT COULEUR FROM COULEUR WHERE IDARTICLE = :pIdArticle AND COULEUR = :pCouleur";
    $couleurSelect = oci_parse($connect, $reqSelect);
    oci_bind_by_name($couleurSelect, ":pIdArticle", $produit);
    oci_bind_by_name($couleurSelect, ":pCouleur", $couleur);

    $resultSelect = oci_execute($couleurSelect);

    if (!$resultSelect) {
      $e = oci_error($couleurSelect);
      $SQLerror = htmlentities($e['message'] . ' pour cette requête : ' . $e['sqltext']);

      header('Location: ./deleteCouleur.php?msgErreur=' .$SQLerror);
      exit;
    }

    $couleurDatabase = oci_fetch_assoc($couleurSelect);

    if(empty($couleurDatabase)){
      header('Location: ./deleteCouleur.php?msgErreur=This color does not exist for this product');
      exit;
    }

    //On crée une requete paramétrée
    $req = "DELETE FROM COULEUR WHERE IDARTICLE = '$produit' AND COULEUR = '$couleur'";

    //On prépare la requête
    $deleteCouleur = oci_parse($connect, $req);

    $result = oci_execute($deleteCouleur);

    oci_commit($connect);

    oci_free_statement($deleteCouleur);
  
    echo('<script language="JavaScript" type="text/javascript"> 
                alert("Removal successful."); 
                location.href = "./connexion.php";
              </script>');

  } else {

    if(!isset($_POST['Retirer'])) {
      header('Location: ./deleteCouleur.php?msgErreur=Veuillez choisir un article');
      exit;
    }
  
    if(empty($_POST['nomArticle']) || empty($_POST['couleur'])) {
      header('Location: ./deleteCouleur.php?msgErreur=Sélection incorrecte');
      exit;
    }
  
    $produit = $_POST['nomArticle'];
    $couleur = strtoupper(htmlspecialchars($_POST['couleur']));

    $reqSelect = "SELECT COULEUR FROM COULEUR WHERE IDARTICLE = :pIdArticle AND COULEUR = :pCouleur";
    $couleurSelect = oci_parse($connect, $reqSelect);
    oci_bind_by_name($couleurSelect, ":pIdArticle", $produit);
    oci_bind_by_name($couleurSelect, ":pCouleur", $couleur);

    $resultSelect = oci_execute($couleurSelect);

    if (!$resultSelect) {
      $e = oci_error($couleurSelect);
      $SQLerror = htmlentities($e['message'] . ' pour cette requête : ' . $e['sqltext']);

      header('Location: ./deleteCouleur.php?msgErreur=' .$SQLerror);
      exit;
    }

    $couleurDatabase = oci_fetch_assoc($couleurSelect);

    if(empty($couleurDatabase)){
      header('Location: ./deleteCouleur.php?msgErreur=Cette couleur n\'existe pas pour ce produit');
      exit;
    }

    //On crée une requete paramétrée
    $req = "DELETE FROM COULEUR WHERE IDARTICLE = '$produit' AND COULEUR = '$couleur'";
  
    //On prépare la requête
    $deleteCouleur = oci_parse($connect, $req);
  
    $result = oci_execute($deleteCouleur);
  
    oci_commit($connect);
  
    oci_free_statement($deleteCouleur);
  
    echo('<script language="JavaScript" type="text/javascript"> 
                alert("Retrait réussi."); 
                location.href = "./connexion.php";
              </script>');

  }

?>