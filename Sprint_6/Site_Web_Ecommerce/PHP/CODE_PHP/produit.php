<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8"/>
  <link rel="stylesheet" href="./include/styles.css"/>
  <link rel="icon" href="./include/images/artichaude.jpg"/>
	<title>Produit</title>
</head>
<body>
	<?php include("./include/header.php"); ?>
  <?php require_once("connect.inc.php"); ?>
  <?php

    session_start();
    $recherche = $_GET['id'];

    //Recup la note moyenne, nom, description, catégorie et prix d'un produit
    $requete1 = "SELECT AVG(AVIS.NOTE) AS NOTE, NOMARTICLE, DESCRIPTION, PRIXARTICLE FROM AVIS,ARTICLE WHERE AVIS.IDARTICLE = ARTICLE.IDARTICLE AND ARTICLE.IDARTICLE = :idArticle GROUP BY NOMARTICLE, DESCRIPTION, PRIXARTICLE";
    $req1 = oci_parse($connect, $requete1);
    oci_bind_by_name($req1,':idArticle',$recherche);//article correspondant
    $result1 = oci_execute($req1);

    //Recup le nom et prénom et l'avis et la note de la personne sur un produit
    $requete2 = "SELECT ACTEUR.NOMACTEUR,ACTEUR.PRENOMACTEUR,AVIS.NOTE,AVIS.AVIS FROM ACTEUR,AVIS WHERE ACTEUR.IDACTEUR = AVIS.IDACTEUR AND AVIS.IDARTICLE =:idArticle";
    $req2 = oci_parse($connect, $requete2);
    oci_bind_by_name($req2,':idArticle', $recherche);
    $result2 = oci_execute($req2);

    //Recup les couleurs du produit
    $requete4 = "SELECT COULEUR FROM COULEUR,ARTICLE WHERE ARTICLE.IDARTICLE = COULEUR.IDARTICLE AND ARTICLE.IDARTICLE =:idArticle";
    $req4 = oci_parse($connect, $requete4);
    oci_bind_by_name($req4,':idArticle', $recherche);
    $result4 = oci_execute($req4);

    $nom = oci_fetch_assoc($req1);
    $product_nom = $nom['NOMARTICLE'];
    $pri = $nom['PRIXARTICLE'];
    $des = $nom['DESCRIPTION'];
    $note = $nom['NOTE'];

    echo('<div class="squarE">');
      echo('<h1>'.$product_nom.'</h1>');

      echo('<form method="post" action="panier.php">');
        echo('<input type="hidden" name="product_id" value="'.$recherche.'">');

        echo('<div id="gridProduit">');

          echo('<div class="imageCell">');
            echo("<img id='imageProduit' src='include/images/imagesArticles/". $product_nom.".png'>");
          echo('</div>');

          echo('<div class="main-infos">');
          echo('<p>Note globale');

          for($i = 5; $i > 0; $i--){
              if ($note < $i){
                echo('<img class="imagesNote" src="include/images/artichaud-noir.png">');
              } else {
                echo('<img class="imagesNote" src="include/images/artichaud.png">');
              }
          }
          echo('</p>');

          echo('</div>');
          echo('<div class="main-infos">');

            echo('<label for="quantite">Quantité</label>');
            echo('<input type="number" id="quantity" name="quantite" min="1" max="5" value="1">');

          echo('</div>');

          echo('<div class="descContainer">');
            echo('<p>Description</p>');

            echo('<div id="descProduit">');
              echo('<p id="descChamp">'.$des.'</p>');
            echo('</div>');

          echo('</div>');

          echo('<div class="couleurs">');
            echo('<p>Coloris : </p>');

            echo('<select id="selectCouleurs" class="couleur" name="couleur">');
              $couleurs = oci_fetch_assoc($req4);
              while($couleurs){
                echo('<option value="'.$couleurs['COULEUR'].'">'.$couleurs['COULEUR'].'</option>');
                $couleurs = oci_fetch_assoc($req4);
              }
            echo('</select>');

          echo('</div>');

          echo('<div id="prixProduit">');
            echo('<p>Prix : '.$pri.'euro(s) (€)</p>'); //$_SESSION['monnaie'].
          echo('</div>');

          echo('<div class="payerProduit">');
            echo('<button name="ajout" id="btnPanier">');
              echo('<img src="./include/images/panier.png" id="imagePanier" alt="image">');
            echo('</button>');
          echo('</div>');

          echo('<div class="singleCellProduit">');
            echo('<p>Avis :</p>');
          echo('</div>');

          echo('<div id="avisProduit">');

            while (($avis = oci_fetch_assoc($req2))!=false) {

              echo('<div class="containerAvis">');

                echo('<p class="avisPersonne">'.$avis['NOMACTEUR'].' '.$avis['PRENOMACTEUR']);

                for($i = 5; $i > 0; $i--){
                  if ($avis['NOTE'] < $i){
                    echo('<img class="imagesNote" src="include/images/artichaud-noir.png">');
                  } else {
                    echo('<img class="imagesNote" src="include/images/artichaud.png">');
                  }
                }

                echo("</p>");
                echo("<br/>");
                echo('<hr>');
                echo('<p class="avisPersonne">'.$avis['AVIS'].'</p>');

              echo('</div>');

              echo('<hr id="separateurAvis"/>');
            }
            
          echo('</div>');
        echo('</div>');
      echo('</form>');
    echo('</div>');
  
  ?>

  <?php include("./include/footer.php"); ?>

</body>
</html>