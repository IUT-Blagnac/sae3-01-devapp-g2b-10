<?php
  session_start();
  require_once("connect.inc.php");

  if(isset($_SESSION['langue']) && $_SESSION['langue'] == 'EN') {

    if(!isset($_POST['Ajouter'])) {
      header('Location: ./addCouleur.php?msgErreur=Please fill in the fields');
      exit;
    }

    if(empty($_POST['Ajouter'])) {
      header('Location: ./addCouleur.php?msgErreur=Incorrect selection');
      exit;
    }

    if ((empty($_POST['nomArticles']) || empty($_POST['couleur']))) {
      header('Location: ./addCouleur.php?msgErreur=Please fill in the fields');
      exit;
    }

    $nomArticle = htmlspecialchars($_POST['nomArticles']);
    $couleurProduit = strtoupper(htmlspecialchars($_POST['couleur']));

    $reqSelect = "SELECT COULEUR FROM COULEUR WHERE IDARTICLE = :pIdArticle AND COULEUR = :pCouleur";
    $couleurSelect = oci_parse($connect, $reqSelect);
    oci_bind_by_name($couleurSelect, ":pIdArticle", $nomArticle);
    oci_bind_by_name($couleurSelect, ":pCouleur", $couleurProduit);

    $resultSelect = oci_execute($couleurSelect);

    if (!$resultSelect) {
      $e = oci_error($couleurSelect);
      $SQLerror = htmlentities($e['message'] . ' pour cette requête : ' . $e['sqltext']);

      header('Location: ./addCouleur.php?msgErreur=' .$SQLerror);
      exit;
    }

    $couleurDatabase = oci_fetch_assoc($couleurSelect);

    if(!empty($couleurDatabase)){

      header('Location: ./addCouleur.php?msgErreur=This color already exists');
      exit;
    }

    $reqInsert = "INSERT INTO COULEUR (IDARTICLE, COULEUR) VALUES(:pIdArticle,:pCouleur)";
    $couleurInsert = oci_parse($connect, $reqInsert);
    oci_bind_by_name($couleurInsert, ":pIdArticle", $nomArticle);
    oci_bind_by_name($couleurInsert, ":pCouleur", $couleurProduit);

    $resultInsert = oci_execute($couleurInsert);

    if (!$resultInsert) {
      $e = oci_error($couleurInsert);
      $SQLerror = htmlentities($e['message'] . ' pour cette requête : ' . $e['sqltext']);

      header('Location: ./addCouleur.php?msgErreur=' .$SQLerror);
      exit;
    }

    oci_commit($connect);

    oci_free_statement($couleurSelect);
    oci_free_statement($couleurInsert);
  
    echo('<script language="JavaScript" type="text/javascript"> 
                alert("Successful addition of the color."); 
                location.href = "./connexion.php";
              </script>');

  } else {

    if(!isset($_POST['Ajouter'])) {
      header('Location: ./addCouleur.php?msgErreur=Veuillez remplir les champs');
      exit;
    }
  
    if(empty($_POST['Ajouter'])) {
      header('Location: ./addCouleur.php?msgErreur=Sélection incorrecte');
      exit;
    }

    if ((empty($_POST['nomArticles']) || empty($_POST['couleur']))) {
      header('Location: ./addCouleur.php?msgErreur=Veuillez remplir les champs');
      exit;
    }
  
    $nomArticle = htmlspecialchars($_POST['nomArticles']);
    $couleurProduit = strtoupper(htmlspecialchars($_POST['couleur']));

    $reqSelect = "SELECT COULEUR FROM COULEUR WHERE IDARTICLE = :pIdArticle AND COULEUR = :pCouleur";
    $couleurSelect = oci_parse($connect, $reqSelect);
    oci_bind_by_name($couleurSelect, ":pIdArticle", $nomArticle);
    oci_bind_by_name($couleurSelect, ":pCouleur", $couleurProduit);

    $resultSelect = oci_execute($couleurSelect);

    if (!$resultSelect) {
      $e = oci_error($couleurSelect);
      $SQLerror = htmlentities($e['message'] . ' pour cette requête : ' . $e['sqltext']);

      header('Location: ./addCouleur.php?msgErreur=' .$SQLerror);
      exit;
    }

    $couleurDatabase = oci_fetch_assoc($couleurSelect);

    if(!empty($couleurDatabase)){

      header('Location: ./addCouleur.php?msgErreur=Cette couleur existe déjà');
      exit;
    }

    $reqInsert = "INSERT INTO COULEUR (IDARTICLE, COULEUR) VALUES(:pIdArticle,:pCouleur)";
    $couleurInsert = oci_parse($connect, $reqInsert);
    oci_bind_by_name($couleurInsert, ":pIdArticle", $nomArticle);
    oci_bind_by_name($couleurInsert, ":pCouleur", $couleurProduit);
  
    $resultInsert = oci_execute($couleurInsert);
  
    if (!$resultInsert) {
      $e = oci_error($couleurInsert);
      $SQLerror = htmlentities($e['message'] . ' pour cette requête : ' . $e['sqltext']);
  
      header('Location: ./addCouleur.php?msgErreur=' .$SQLerror);
      exit;
    }
  
    oci_commit($connect);

    oci_free_statement($couleurSelect);
    oci_free_statement($couleurInsert);
  
    echo('<script language="JavaScript" type="text/javascript"> 
                alert("Ajout de la couleur réussie."); 
                location.href = "./connexion.php";
              </script>');

  }

?>