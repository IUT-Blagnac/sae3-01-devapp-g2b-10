<?php
// on inclut le fichier de connexion à la base Oracle
require_once("connect.inc.php");
error_reporting(0);

session_start();

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

?>