<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="./include/styles.css"/>
    <link rel="icon" href="./include/images/artichaude.jpg"/>
    <title>Ajout d'un produit</title>
</head>
<body>
    <?php include("./include/header.php");
    
    session_start();
    
    if(!isset($_SESSION['utilisateur'])) {

      header('Location: ./index.php');
      exit;

    } else if($_SESSION['utilisateur'] != 'Artiste') {

      header('Location: ./index.php');
      exit;

    } else { ?>

      <form action="traitAddProduit.php" id="formInscription" method="post">

        <div id='titleFrame'><h1 id='formTitle'>Ajouter un produit</h1></div>

        <?php

          if(isset($_GET['msgErreur'])){
            echo("<h3 class='errorDatabase'>".$_GET['msgErreur']."</h3>");
          } else {
            echo("<h3 class='errorDatabase'>Veuillez compléter ces informations</h3>");
          }

        ?>

        <label class="formLabels">Nom du produit :</label>
        <input type="text" class="modifChamps" name="name" required>
        <br/><br/> 

        <label class="formLabels">Prix :</label>
        <input type="number" class="modifChamps" name="prix" step="0.01" min="0.01" required/>
        <br/><br/>  

        <label class="formLabels">Catégorie :</label>
        <select name='categorie' id='selectArticles'>
          <option class='optionArticles' value='POSTERS'>Posters</option>
          <option class='optionArticles' value='FIGURINES'>Figurines</option>
          <option class='optionArticles' value='PELUCHES'>Peluches</option>
        </select>
        <br/>

        <label class="formLabels">Couleur :</label>
        <input type="text" class="modifChamps" name="couleur"/>
        <br/><br/>

        <label class="formLabels">Description :</label>
        <textarea id="zoneCollab" class="champsForm" rows="8" cols="40" name="comment" required></textarea>
        <br/>

        <p class='errorDatabase'>Non fonctionnel</p>
        <label id="blockFormLabel">Image du produit :</label>
        <input type="file" id="unmodifChamp" name="monImage" disabled/>
        <br/><br/>
      
        <input type="submit" name="Ajouter" value="Ajouter" id="btnInscription"/>

      </form>

      <?php
    } ?>
    
    <?php include("./include/footer.php"); ?>

</body>
</html>