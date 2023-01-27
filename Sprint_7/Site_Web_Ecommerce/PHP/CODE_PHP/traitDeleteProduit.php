<?php
    // on inclut le fichier de connexion à la base Oracle
    session_start();
    require_once("connect.inc.php");
    error_reporting(0);

    if(isset($_SESSION['langue']) && $_SESSION['langue'] == 'EN') {

        if(!isset($_POST['Retirer'])) {
            header('Location: ./deleteProduit.php?msgErreur=Please select an item');
            exit;
        }
    
        if(empty($_POST['nomArticle'])) {
            header('Location: ./deleteProduit.php?msgErreur=Incorrect selection');
            exit;
        }
        
        $produitARetirer = $_POST['nomArticle'];
    
        //On crée une requete paramétrée
        $req = "DELETE FROM ARTICLE WHERE IDARTICLE = '$produitARetirer'";
    
        //On prépare la requête
        $deleteProduit = oci_parse($connect, $req);
    
        $result = oci_execute($deleteProduit);
    
        oci_commit($connect);
    
        oci_free_statement($deleteProduit);
    
        echo('<script language="JavaScript" type="text/javascript"> 
                alert("Successful removal."); 
                location.href = "./connexion.php";
              </script>');

    } else {

        if(!isset($_POST['Retirer'])) {
            header('Location: ./deleteProduit.php?msgErreur=Veuillez choisir un article');
            exit;
        }
    
        if(empty($_POST['nomArticle'])) {
            header('Location: ./deleteProduit.php?msgErreur=Sélection incorrecte');
            exit;
        }
        
        $produitARetirer = $_POST['nomArticle'];
    
        //On crée une requete paramétrée
        $req = "DELETE FROM ARTICLE WHERE IDARTICLE = '$produitARetirer'";
    
        //On prépare la requête
        $deleteProduit = oci_parse($connect, $req);
    
        $result = oci_execute($deleteProduit);
    
        oci_commit($connect);
    
        oci_free_statement($deleteProduit);
    
        echo('<script language="JavaScript" type="text/javascript"> 
                alert("Retrait réussi."); 
                location.href = "./connexion.php";
              </script>');

    }

?>