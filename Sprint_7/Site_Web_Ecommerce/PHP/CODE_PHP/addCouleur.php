<!DOCTYPE html>
<html>
<head>
  <meta charset="UTF-8">
  <link rel="stylesheet" href="./include/styles.css"/>
  <link rel="icon" href="./include/images/artichaude.jpg"/>
  <title>Ajout d'un produit</title>
</head>
<body>
  <?php session_start(); ?>
  <?php include("./include/header.php"); ?>
  <?php include('connect.inc.php');

  if(isset($_SESSION['langue']) && $_SESSION['langue'] == 'EN') {

    if(!isset($_SESSION['utilisateur'])) {

      header('Location: ./index.php');
      exit;
  
    } else if($_SESSION['utilisateur'] != 'Artiste') {
  
      header('Location: ./index.php');
      exit;
  
    } else { 
  
      echo('<form action="traitAddCouleur.php" id="formInscription" method="post">');
  
        echo("<div id='titleFrame'><h1 id='formTitle'>Add a color</h1></div>");
  
        if(isset($_GET['msgErreur'])){
          echo("<h3 class='errorDatabase'>".$_GET['msgErreur']."</h3>");
        } else {
          echo("<h3 class='errorDatabase'>Please complete these informations</h3>");
        }

        echo('<label class="formLabels">Your product :</label>');
        echo("<select name='nomArticles' id='selectThemes'>");
  
          $req = "SELECT IDARTICLE, NOMARTICLE FROM ARTICLE";
          $articlesRecup = oci_parse($connect, $req);
          $result = oci_execute($articlesRecup);
  
          if (!$result) {
              $e = oci_error($articlesRecup);  // on récupère l'exception liée au pb d'execution de la requete (violation PK par exemple)
              $errorSQL = print htmlentities($e['message'].' pour cette requete : '.$e['sqltext']);
              header("Location: ./updateProduit.php=?msgErreur=$errorSQL");
              exit;
          } else {
              while(($nomArticles = oci_fetch_assoc($articlesRecup)) != false) {
                  echo("<option class='optionArticles' value='".$nomArticles['IDARTICLE']."'>".$nomArticles['NOMARTICLE']."</option>");
              }
          }
  
        echo('</select>');
  
        echo("<p class='errorDatabase'></p>");
        echo('<label class="formLabels">Color :</label>');
        echo('<input type="text" class="modifChamps" name="couleur"/>');
        echo('<br/><br/>');
  
        echo('<input type="submit" name="Ajouter" value="Add" id="btnInscription"/>');
  
      echo('</form>');
  
    }

  } else {

    if(!isset($_SESSION['utilisateur'])) {

      header('Location: ./index.php');
      exit;
  
    } else if($_SESSION['utilisateur'] != 'Artiste') {
  
      header('Location: ./index.php');
      exit;
  
    } else { 
  
      echo('<form action="traitAddCouleur.php" id="formInscription" method="post">');
  
        echo("<div id='titleFrame'><h1 id='formTitle'>Ajouter une couleur</h1></div>");
  
        if(isset($_GET['msgErreur'])){
          echo("<h3 class='errorDatabase'>".$_GET['msgErreur']."</h3>");
        } else {
          echo("<h3 class='errorDatabase'>Veuillez compléter ces informations</h3>");
        }

        echo('<label class="formLabels">Votre produit :</label>');
        echo("<select name='nomArticles' id='selectThemes'>");
  
          $req = "SELECT IDARTICLE, NOMARTICLE FROM ARTICLE";
          $articlesRecup = oci_parse($connect, $req);
          $result = oci_execute($articlesRecup);
  
          if (!$result) {
              $e = oci_error($articlesRecup);  // on récupère l'exception liée au pb d'execution de la requete (violation PK par exemple)
              $errorSQL = print htmlentities($e['message'].' pour cette requete : '.$e['sqltext']);
              header("Location: ./updateProduit.php=?msgErreur=$errorSQL");
              exit;
          } else {
              while(($nomArticles = oci_fetch_assoc($articlesRecup)) != false) {
                  echo("<option class='optionArticles' value='".$nomArticles['IDARTICLE']."'>".$nomArticles['NOMARTICLE']."</option>");
              }
          }
  
        echo('</select>');
  
        echo("<p class='errorDatabase'></p>");
        echo('<label class="formLabels">Couleur :</label>');
        echo('<input type="text" class="modifChamps" name="couleur"/>');
        echo('<br/><br/>');
  
        echo('<input type="submit" name="Ajouter" value="Ajouter" id="btnInscription"/>');
  
      echo('</form>');
  
    } 

  }

  ?>

  <?php include("./include/footer.php"); ?>

</body>
</html>