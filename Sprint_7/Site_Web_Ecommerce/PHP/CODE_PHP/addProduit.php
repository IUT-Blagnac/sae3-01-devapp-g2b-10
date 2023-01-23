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
  <?php include("./include/header.php");

  if(isset($_SESSION['langue']) && $_SESSION['langue'] == 'EN') {

    if(!isset($_SESSION['utilisateur'])) {

      header('Location: ./index.php');
      exit;
  
    } else if($_SESSION['utilisateur'] != 'Artiste') {
  
      header('Location: ./index.php');
      exit;
  
    } else { 
  
      echo('<form action="traitAddProduit.php" id="formInscription" method="post">');
  
        echo("<div id='titleFrame'><h1 id='formTitle'>Add a new product</h1></div>");
  
          if(isset($_GET['msgErreur'])){
            echo("<h3 class='errorDatabase'>".$_GET['msgErreur']."</h3>");
          } else {
            echo("<h3 class='errorDatabase'>Please complete these informations</h3>");
          }
  
        echo('<label class="formLabels">Product name :</label>');
        echo('<input type="text" class="modifChamps" name="name" required>');
        echo('<br/><br/>'); 
  
        echo('<label class="formLabels">Price :</label>');
        echo('<input type="number" class="modifChamps" name="prix" step="0.01" min="0.01" required/>');
        echo('<br/><br/>');  
  
        echo('<label class="formLabels">Category :</label>');
        echo("<select name='categorie' id='selectArticles'>");
          echo("<option class='optionArticles' value='POSTERS'>Posters</option>");
          echo("<option class='optionArticles' value='FIGURINES'>Figurines</option>");
          echo("<option class='optionArticles' value='PELUCHES'>Plushies</option>");
        echo('</select>');
        echo('<br/>');
  
        echo('<label class="formLabels">Color :</label>');
        echo('<input type="text" class="modifChamps" name="couleur"/>');
        echo('<br/><br/>');
  
        echo('<label class="formLabels">Description :</label>');
        echo('<textarea id="zoneCollab" class="champsForm" rows="8" cols="40" name="comment" required></textarea>');
        echo('<br/>');
  
        echo("<p class='errorDatabase'>Not working</p>");
        echo('<label id="blockFormLabel">Product image :</label>');
        echo('<input type="file" id="unmodifChamp" name="monImage" disabled/>');
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
  
      echo('<form action="traitAddProduit.php" id="formInscription" method="post">');
  
        echo("<div id='titleFrame'><h1 id='formTitle'>Ajouter un produit</h1></div>");
  
          if(isset($_GET['msgErreur'])){
            echo("<h3 class='errorDatabase'>".$_GET['msgErreur']."</h3>");
          } else {
            echo("<h3 class='errorDatabase'>Veuillez compléter ces informations</h3>");
          }
  
        echo('<label class="formLabels">Nom du produit :</label>');
        echo('<input type="text" class="modifChamps" name="name" required>');
        echo('<br/><br/>'); 
  
        echo('<label class="formLabels">Prix :</label>');
        echo('<input type="number" class="modifChamps" name="prix" step="0.01" min="0.01" required/>');
        echo('<br/><br/>');  
  
        echo('<label class="formLabels">Catégorie :</label>');
        echo("<select name='categorie' id='selectArticles'>");
          echo("<option class='optionArticles' value='POSTERS'>Posters</option>");
          echo("<option class='optionArticles' value='FIGURINES'>Figurines</option>");
          echo("<option class='optionArticles' value='PELUCHES'>Peluches</option>");
        echo('</select>');
        echo('<br/>');
  
        echo('<label class="formLabels">Couleur :</label>');
        echo('<input type="text" class="modifChamps" name="couleur"/>');
        echo('<br/><br/>');
  
        echo('<label class="formLabels">Description :</label>');
        echo('<textarea id="zoneCollab" class="champsForm" rows="8" cols="40" name="comment" required></textarea>');
        echo('<br/>');
  
        echo("<p class='errorDatabase'>Non fonctionnel</p>");
        echo('<label id="blockFormLabel">Image du produit :</label>');
        echo('<input type="file" id="unmodifChamp" name="monImage" disabled/>');
        echo('<br/><br/>');
      
        echo('<input type="submit" name="Ajouter" value="Ajouter" id="btnInscription"/>');
  
      echo('</form>');
  
    } 

  }
  
  ?>
    
  <?php include("./include/footer.php"); ?>

</body>
</html>