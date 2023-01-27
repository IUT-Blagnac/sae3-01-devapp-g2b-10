<?php
      
    session_start();
    require_once("connect.inc.php");

    if(isset($_SESSION['langue']) && $_SESSION['langue'] == 'EN') {

        if(!isset($_POST['Ajouter'])) {
            header('Location: ./addProduit.php?msgErreur=Please fill in the fields');
            exit;
        }
    
        if(empty($_POST['categorie'])) {
            header('Location: ./addProduit.php?msgErreur=Incorrect selection');
            exit;
        }
        
        if (!(isset($_POST['name']) && isset($_POST['prix']) && isset($_POST['comment']) && isset($_POST['couleur']))) {
            header('Location: ./addProduit.php?msgErreur=Please fill in the fields');
            exit;
        }
        
        $nomProduit = htmlspecialchars($_POST['name']);
        $prixProduit = htmlspecialchars($_POST['prix']);
        $descProduit = htmlspecialchars($_POST['comment']);
        $couleurProduit = strtoupper(htmlspecialchars($_POST['couleur']));
    
        if(!preg_match('#^[0-9]{1,8}[,.]?[0-9]{0,2}$#', $prixProduit)) {
            header('Location: ./addProduit.php?msgErreur=Check your price entry');
            exit;
        }
        
        $req = "INSERT INTO ARTICLE (IDARTICLE,NOMARTICLE,NOMCATEGORIE,PRIXARTICLE,PRIXPROMO,DESCRIPTION) VALUES(SEQ_ARTICLE.NEXTVAL,:pNomProduit,:pNomCategorie,:pPrix,0,:pDesc)";
        $articleInsert = oci_parse($connect, $req);
        oci_bind_by_name($articleInsert, ":pNomProduit", $nomProduit);
        oci_bind_by_name($articleInsert, ":pNomCategorie", $_POST['categorie']);
        oci_bind_by_name($articleInsert, ":pPrix", $prixProduit);
        oci_bind_by_name($articleInsert, ":pDesc", $descProduit);
    
        $resultInsert = oci_execute($articleInsert);
        
        if (!$resultInsert) {
            $e = oci_error($articleInsert);
            $SQLerror = htmlentities($e['message'] . ' pour cette requête : ' . $e['sqltext']);
    
            header('Location: ./addProduit.php?msgErreur=' .$SQLerror);
            exit;
        }
    
        $req = "SELECT IDARTICLE FROM ARTICLE WHERE NOMARTICLE = '$nomProduit'";
        $articleSelect = oci_parse($connect, $req);
    
        $resultSelect = oci_execute($articleSelect);
        $clientDatabase = oci_fetch_assoc($articleSelect);
    
        if (!$resultSelect) {
          $e = oci_error($articleSelect);
          $SQLerror = htmlentities($e['message'] . ' pour cette requête : ' . $e['sqltext']);
    
          header('Location: ./addProduit.php?msgErreur=' .$SQLerror);
          exit;
        }
    
        $idProduit = $clientDatabase['IDARTICLE'];
    
        $req = "INSERT INTO COULEUR (IDARTICLE,COULEUR) VALUES(:idProduit, :couleurProduit)";
        $couleurInsert = oci_parse($connect, $req);
        oci_bind_by_name($couleurInsert, ":idProduit", $idProduit);
        oci_bind_by_name($couleurInsert, ":couleurProduit", $couleurProduit);
    
        $resultInsert = oci_execute($couleurInsert);
    
        if (!$resultInsert) {
          $e = oci_error($couleurInsert);
          $SQLerror = htmlentities($e['message'] . ' pour cette requête : ' . $e['sqltext']);
    
          header('Location: ./addProduit.php?msgErreur=' .$SQLerror);
          exit;
        }
    
        oci_commit($connect);
    
        oci_free_statement($couleurInsert);
        oci_free_statement($articleInsert);
        oci_free_statement($articleSelect);
    
        echo('<script language="JavaScript" type="text/javascript"> 
                alert("Successful addition of the product."); 
                location.href = "./connexion.php";
              </script>');

    } else {

        if(!isset($_POST['Ajouter'])) {
            header('Location: ./addProduit.php?msgErreur=Veuillez remplir les champs');
            exit;
        }
    
        if(empty($_POST['categorie'])) {
            header('Location: ./addProduit.php?msgErreur=Sélection incorrecte');
            exit;
        }
        
        if (!(isset($_POST['name']) && isset($_POST['prix']) && isset($_POST['comment']) && isset($_POST['couleur']))) {
            header('Location: ./addProduit.php?msgErreur=Veuillez remplir les champs');
            exit;
        }
        
        $nomProduit = htmlspecialchars($_POST['name']);
        $prixProduit = htmlspecialchars($_POST['prix']);
        $descProduit = htmlspecialchars($_POST['comment']);
        $couleurProduit = strtoupper(htmlspecialchars($_POST['couleur']));
    
        if(!preg_match('#^[0-9]{1,8}[,.]?[0-9]{0,2}$#', $prixProduit)) {
            header('Location: ./addProduit.php?msgErreur=Vérifiez la saisie de votre prix');
            exit;
        }
        
        $req = "INSERT INTO ARTICLE (IDARTICLE,NOMARTICLE,NOMCATEGORIE,PRIXARTICLE,PRIXPROMO,DESCRIPTION) VALUES(SEQ_ARTICLE.NEXTVAL,:pNomProduit,:pNomCategorie,:pPrix,0,:pDesc)";
        $articleInsert = oci_parse($connect, $req);
        oci_bind_by_name($articleInsert, ":pNomProduit", $nomProduit);
        oci_bind_by_name($articleInsert, ":pNomCategorie", $_POST['categorie']);
        oci_bind_by_name($articleInsert, ":pPrix", $prixProduit);
        oci_bind_by_name($articleInsert, ":pDesc", $descProduit);
    
        $resultInsert = oci_execute($articleInsert);
        
        if (!$resultInsert) {
            $e = oci_error($articleInsert);
            $SQLerror = htmlentities($e['message'] . ' pour cette requête : ' . $e['sqltext']);
    
            header('Location: ./addProduit.php?msgErreur=' .$SQLerror);
            exit;
        }
    
        $req = "SELECT IDARTICLE FROM ARTICLE WHERE NOMARTICLE = '$nomProduit'";
        $articleSelect = oci_parse($connect, $req);
    
        $resultSelect = oci_execute($articleSelect);
        $clientDatabase = oci_fetch_assoc($articleSelect);
    
        if (!$resultSelect) {
          $e = oci_error($articleSelect);
          $SQLerror = htmlentities($e['message'] . ' pour cette requête : ' . $e['sqltext']);
    
          header('Location: ./addProduit.php?msgErreur=' .$SQLerror);
          exit;
        }
    
        $idProduit = $clientDatabase['IDARTICLE'];
    
        $req = "INSERT INTO COULEUR (IDARTICLE,COULEUR) VALUES(:idProduit, :couleurProduit)";
        $couleurInsert = oci_parse($connect, $req);
        oci_bind_by_name($couleurInsert, ":idProduit", $idProduit);
        oci_bind_by_name($couleurInsert, ":couleurProduit", $couleurProduit);
    
        $resultInsert = oci_execute($couleurInsert);
    
        if (!$resultInsert) {
          $e = oci_error($couleurInsert);
          $SQLerror = htmlentities($e['message'] . ' pour cette requête : ' . $e['sqltext']);
    
          header('Location: ./addProduit.php?msgErreur=' .$SQLerror);
          exit;
        }
    
        oci_commit($connect);
    
        oci_free_statement($couleurInsert);
        oci_free_statement($articleInsert);
        oci_free_statement($articleSelect);
    
        echo('<script language="JavaScript" type="text/javascript"> 
                alert("Ajout du produit réussi."); 
                location.href = "./connexion.php";
              </script>');

    }    
    
?>