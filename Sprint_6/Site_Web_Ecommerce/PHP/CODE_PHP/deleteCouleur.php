<!DOCTYPE html>
<html>
<head>
  <meta charset="UTF-8">
  <link rel="stylesheet" href="./include/styles.css"/>
  <link rel="icon" href="./include/images/artichaude.jpg"/>
  <title>Retrait d'un produit</title>
</head>
<body>
<?php include("./include/header.php"); ?>
<?php include('connect.inc.php');

session_start();

if(!isset($_SESSION['utilisateur'])) {

  header('Location: ./index.php');
  exit;

} else if($_SESSION['utilisateur'] != 'Admin') {

  header('Location: ./index.php');
  exit;

} else {

  echo('<form method="post" id="formModification" action="traitDeleteCouleur.php">');

  echo("<div id='titleFrame'><h1 id='formTitle'>Retrait d'une couleur</h1></div>");

  echo("<h3 class='errorDatabase'>Veuillez choisir une couleur à retirer</h3>");

  echo('<label class="formLabels">Votre produit :</label>');
  echo("<select name='nomArticle' id='selectThemes'>");



  echo("</select>");
  echo('<br/><br/>');

  echo('<input type="submit" name="Retirer" value="Retirer" id="btnModification"/>');

  echo('</form>');

}

?>

<?php include("./include/footer.php"); ?>

</body>
</html>