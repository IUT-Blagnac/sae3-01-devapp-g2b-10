<?php
  session_start();
  require_once("connect.inc.php");

  if(isset($_SESSION['langue']) && $_SESSION['langue'] == 'EN') {

    if(!isset($_POST['Modifier']) || !isset($_POST['quantity'])) {
      header('Location: ./panier.php');
      exit;
    }
  
    $idacteur = $_SESSION['id'];
    $couleur = ($_POST['productCouleur']);
    $product_id = ($_POST['productID']);
    $quantite = $_POST['quantity'];
  
    if($quantite == 0) {

      $reqDelete = "DELETE FROM PANIER WHERE idArticle = :product_id AND idActeur = :idacteur AND couleur = :couleur";
      $panierDelete = oci_parse($connect, $reqDelete);
      oci_bind_by_name($panierDelete,':product_id',$product_id);
      oci_bind_by_name($panierDelete,':idacteur',$idacteur);
      oci_bind_by_name($panierDelete,':couleur',$couleur);
      $resultDelete = oci_execute($panierDelete);
  
      if (!$resultDelete) {
        $e = oci_error($reqDelete);  // on récupère l'exception liée au pb d'execution de la requete (violation PK par exemple)
        $SQLerror = htmlentities($e['message'] . ' pour cette requete : ' . $e['sqltext']);
      }
  
      echo('<script language="JavaScript" type="text/javascript"> 
              alert("Product removed from cart."); 
              location.href = "./panier.php";
            </script>');

    } else {

      $requeteUpdate = "UPDATE PANIER SET quantiteArticle = :quantite WHERE idArticle = :product_id AND idActeur = :idacteur AND couleur = :couleur";
      $reqUpdate = oci_parse($connect, $requeteUpdate);
  
      oci_bind_by_name($reqUpdate, ':product_id', $product_id);
      oci_bind_by_name($reqUpdate, ':quantite', $quantite);
      oci_bind_by_name($reqUpdate, ':idacteur', $idacteur);
      oci_bind_by_name($reqUpdate, ':couleur', $couleur);
  
      $resultUpdate = oci_execute($reqUpdate);
  
      if (!$resultUpdate) {
        $e = oci_error($reqUpdate);  // on récupère l'exception liée au pb d'execution de la requete (violation PK par exemple)
        $SQLerror = htmlentities($e['message'] . ' pour cette requete : ' . $e['sqltext']);
      }
  
      echo('<script language="JavaScript" type="text/javascript"> 
              alert("Modified quantity.");
              location.href = "./panier.php";
            </script>');
    }

  } else {

    if(!isset($_POST['Modifier']) || !isset($_POST['quantity'])) {
      header('Location: ./panier.php');
      exit;
    }
  
    $idacteur = $_SESSION['id'];
    $couleur = ($_POST['productCouleur']);
    $product_id = ($_POST['productID']);
    $quantite = $_POST['quantity'];
  
    if($quantite == 0) {

      $reqDelete = "DELETE FROM PANIER WHERE idArticle = :product_id AND idActeur = :idacteur AND couleur = :couleur";
      $panierDelete = oci_parse($connect, $reqDelete);
      oci_bind_by_name($panierDelete,':product_id',$product_id);
      oci_bind_by_name($panierDelete,':idacteur',$idacteur);
      oci_bind_by_name($panierDelete,':couleur',$couleur);
      $resultDelete = oci_execute($panierDelete);
  
      if (!$resultDelete) {
        $e = oci_error($reqDelete);  // on récupère l'exception liée au pb d'execution de la requete (violation PK par exemple)
        $SQLerror = htmlentities($e['message'] . ' pour cette requete : ' . $e['sqltext']);
      }
  
      echo('<script language="JavaScript" type="text/javascript"> 
              alert("Produit retiré du panier."); 
              location.href = "./panier.php";
            </script>');

    } else {

      $requeteUpdate = "UPDATE PANIER SET quantiteArticle = :quantite WHERE idArticle = :product_id AND idActeur = :idacteur AND couleur = :couleur";
      $reqUpdate = oci_parse($connect, $requeteUpdate);
  
      oci_bind_by_name($reqUpdate, ':product_id', $product_id);
      oci_bind_by_name($reqUpdate, ':quantite', $quantite);
      oci_bind_by_name($reqUpdate, ':idacteur', $idacteur);
      oci_bind_by_name($reqUpdate, ':couleur', $couleur);
  
      $resultUpdate = oci_execute($reqUpdate);
  
      if (!$resultUpdate) {
        $e = oci_error($reqUpdate);  // on récupère l'exception liée au pb d'execution de la requete (violation PK par exemple)
        $SQLerror = htmlentities($e['message'] . ' pour cette requete : ' . $e['sqltext']);
      }
  
      echo('<script language="JavaScript" type="text/javascript"> 
              alert("Quantité modifiée.");
              location.href = "./panier.php";
            </script>');
    }

  }

?>