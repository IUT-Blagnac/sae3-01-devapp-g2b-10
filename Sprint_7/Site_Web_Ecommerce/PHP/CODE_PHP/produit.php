<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8"/>
  <link rel="stylesheet" href="./include/styles.css"/>
  <link rel="icon" href="./include/images/artichaude.jpg"/>
	<title>Produit</title>
</head>
<body>
  <?php session_start(); ?>
	<?php include("./include/header.php"); ?>
  <?php require_once("connect.inc.php"); ?>
  <?php

    $recherche = $_GET['id'];
    if(isset($_SESSION['id'])) {
      $prefmonnaie = $_SESSION['monnaie'];
    } else {
      $prefmonnaie = 'EUR';
    }

    //Recup la note moyenne, nom, description, catégorie et prix d'un produit
    $requete1 = "SELECT AVG(AVIS.NOTE) AS NOTE, ARTICLE.IDARTICLE, NOMARTICLE, NOMCATEGORIE, DESCRIPTION, PRIXARTICLE FROM AVIS,ARTICLE WHERE AVIS.IDARTICLE (+)= ARTICLE.IDARTICLE AND ARTICLE.IDARTICLE = :idArticle GROUP BY ARTICLE.IDARTICLE, NOMARTICLE, NOMCATEGORIE, DESCRIPTION, PRIXARTICLE";
    $req1 = oci_parse($connect, $requete1);
    oci_bind_by_name($req1,':idArticle',$recherche);//article correspondant
    $result1 = oci_execute($req1);

    //Recup les couleurs du produit
    $requete4 = "SELECT COULEUR FROM COULEUR,ARTICLE WHERE ARTICLE.IDARTICLE = COULEUR.IDARTICLE AND ARTICLE.IDARTICLE =:idArticle";
    $req4 = oci_parse($connect, $requete4);
    oci_bind_by_name($req4,':idArticle', $recherche);
    $result4 = oci_execute($req4);

    //Récup des attributs nécessaires d'un article
    $nom = oci_fetch_assoc($req1);
    $product_id = $nom['IDARTICLE'];
    $product_nom = $nom['NOMARTICLE'];
    $prix = $nom['PRIXARTICLE'];
    $des = $nom['DESCRIPTION'];
    $note = $nom['NOTE'];
    $categorie = $nom['NOMCATEGORIE'];

    //Recup l'ensemble des articles de la catégorie du produit pour réaliser le carrousel
    $requete = "SELECT * FROM ARTICLE WHERE NOMCATEGORIE LIKE '%' || :categorie || '%'";
    $req1 = oci_parse($connect, $requete);
    oci_bind_by_name($req1,':categorie',$categorie);
    $result= oci_execute($req1);

    //Recup les articles en promo
    $requete3 = "SELECT IDARTICLE, PRIXPROMO FROM ARTICLE WHERE IDARTICLE IN (15, 2, 12, 3)";
    $req3 = oci_parse($connect, $requete3);
    $result3 = oci_execute($req3);

    $requete5 = "SELECT D.IDCOMMANDE,D.IDARTICLE
    FROM DETAILCOMMANDE D,COMMANDE C
    WHERE D.IDCOMMANDE = C.IDCOMMANDE
    AND C.IDACTEUR = :idacteur
    AND D.IDARTICLE = :idarticle";
    $req5 = oci_parse($connect, $requete5);
    oci_bind_by_name($req5,':idarticle',$recherche);
    oci_bind_by_name($req5,':idacteur',$_SESSION['id']);
    $result5= oci_execute($req5);

    if(isset($_SESSION['langue']) && $_SESSION['langue'] == 'EN') {

      echo('<div id="containerProduitArticle">');
        echo('<h1 id="titreArticle">'.$product_nom.'</h1>');

        echo('<form method="post" action="panier.php">');
          echo('<input type="hidden" name="product_id" value="'.$recherche.'">');

          echo('<div id="gridProduit">');

            echo('<div class="imageCell">');
              echo("<img id='imageProduit' src='include/images/imagesArticles/". $product_id.".png'>");
            echo('</div>');

            echo('<div class="main-infos">');
            echo('Overall rating');

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

              echo('<label for="quantite">Quantity</label>');
              echo('<input type="number" id="quantity" name="quantite" min="1" max="999" value="1">');

            echo('</div>');

            echo('<div class="descContainer">');
              echo('<p>Description</p>');

              echo('<div id="descProduit">');
                echo('<p id="descChamp">'.$des.'</p>');
              echo('</div>');

            echo('</div>');

            echo('<div class="couleurs">');
              echo('<p>Colors : </p>');

              echo('<select id="selectCouleurs" class="couleur" name="couleur">');
                $couleurs = oci_fetch_assoc($req4);
                while($couleurs){
                  echo('<option value="'.$couleurs['COULEUR'].'">'.$couleurs['COULEUR'].'</option>');
                  $couleurs = oci_fetch_assoc($req4);
                }
              echo('</select>');

            echo('</div>');

            //Affichage ou non du prix promo
            $boolPromo = 0;

            while(($articlePromo = oci_fetch_assoc($req3))!= false) {

              $prixPromo = $articlePromo['PRIXPROMO'];
              $articleConcerne = $articlePromo['IDARTICLE'];

              if($articleConcerne == $recherche) {
                $boolPromo = 1;
                $newPrixPromo = $prix - ($prix*$prixPromo)/100;

                echo('<div id="prixProduit">');
                  echo('<p>Price : <strike><font color="#FF0000">'.$prix.' '.$prefmonnaie.' '.'</strike></font><b><font color="#00FF00">'.$newPrixPromo.' </b></font>'.$prefmonnaie.'</p>'); //$_SESSION['monnaie'].
                echo('</div>');
              }
            }

            if($boolPromo == 0) {
              echo('<div id="prixProduit">');
                echo('<p>Prix : '.$prix.' '.$prefmonnaie.'</p>'); //$_SESSION['monnaie'].
              echo('</div>');
            }

            echo('<div class="payerProduit">');

              if(!isset($_SESSION['utilisateur']) || $_SESSION['utilisateur'] == 'Admin') {

                echo('<button name="ajout" id="btnPanierCategorie" disabled>');
                  echo('<img src="./include/images/panier.png" id="imagePanier" alt="image">');
                echo('</button>');

              } else {

                echo('<button name="ajout" id="btnPanier">');
                  echo('<img src="./include/images/panier.png" id="imagePanier" alt="image">');
                echo('</button>');

              }

            echo('</div>');

        echo('</form>');
            
            echo('<div class="singleCellProduit">');
              echo('<p>Notice :</p>');
            echo('</div>');
            $articleCommande = oci_fetch_assoc($req5);
        
            echo('<div id="avisProduit">');
              //if idarticle est dans une commande d'idacteur qui est actuellement l'utilisateur
              if($articleCommande){
                echo('<div class="containerAvis">');
                    //faire une requete pour afficher nom prenom de l'utilisateur
                  echo("<p class='avisPersonne'> Leave a comment :</p>");
                
                  echo('<form method="post" action="produit.php?id='.$recherche.'">');
                
                    echo('<p class="avisPersonne">Rating : </p>');
                    echo('<input id="noteArticle" type="number" name="noteAvis" min="1" max="5" value="5">');

                    echo('</p>');
                    echo("<br/>");
                    echo('<hr>');
                    
                    echo('<p class="avisPersonne">Your feedback : </p>');
                    echo('<textarea id="zoneAvis" name="instruction" maxlength="200" required/></textarea>');
                    echo('<br/><br/>');
                    echo('<input type="submit" name="AvisPersonne" value="Submit" id="btnAvis"/>');

                  echo('</form>');
                echo('</div>');

                if ($_SERVER['REQUEST_METHOD'] == 'POST'){
                  $noteAvis=$_POST['noteAvis'];
                  $commentaire = htmlspecialchars($_POST['instruction']);
                  $id = $_SESSION['id'];
                  $article = $recherche;

                  $avisExistant = "SELECT IDACTEUR FROM AVIS WHERE IDACTEUR = :idacteur AND IDARTICLE = :idarticle";
                  $reqAvisExistant = oci_parse($connect, $avisExistant);
                  oci_bind_by_name($reqAvisExistant, ":idarticle",$article);
                  oci_bind_by_name($reqAvisExistant, ":idacteur",$id);
                  $resultAvisExistant= oci_execute($reqAvisExistant);
                  $avisExistant = oci_fetch_assoc($reqAvisExistant);

                  if($avisExistant){
                    $avisUpdate = "UPDATE AVIS SET AVIS = :commentaire, NOTE = :noteAvis WHERE IDACTEUR = :acteur AND IDARTICLE = :article";
                    $reqAvisUpdate = oci_parse($connect, $avisUpdate);
                    oci_bind_by_name($reqAvisUpdate, ":noteAvis",$noteAvis);
                    oci_bind_by_name($reqAvisUpdate, ":commentaire",$commentaire);
                    oci_bind_by_name($reqAvisUpdate, ":article",$article);
                    oci_bind_by_name($reqAvisUpdate, ":acteur",$id);
                    $resultAvisUpdate = oci_execute($reqAvisUpdate);
                  } else {
                    $avisInsert = "INSERT INTO AVIS(IDACTEUR,IDARTICLE,AVIS,NOTE) VALUES (:acteur,:article,:commentaire,:noteAvis)";
                    $reqAvisInsert = oci_parse($connect, $avisInsert);
                    oci_bind_by_name($reqAvisInsert, ":noteAvis",$noteAvis);
                    oci_bind_by_name($reqAvisInsert, ":commentaire",$commentaire);
                    oci_bind_by_name($reqAvisInsert, ":article",$article);
                    oci_bind_by_name($reqAvisInsert, ":acteur",$id);
                    $resultAvisInsert = oci_execute($reqAvisInsert);
                  }
                }
            
                echo('<hr id="separateurAvis"/>');
              }

              //Recup le nom et prénom et l'avis et la note de la personne sur un produit
              $requete2 = "SELECT ACTEUR.NOMACTEUR,ACTEUR.PRENOMACTEUR,AVIS.NOTE,AVIS.AVIS FROM ACTEUR,AVIS WHERE ACTEUR.IDACTEUR = AVIS.IDACTEUR AND AVIS.IDARTICLE =:idArticle";
              $req2 = oci_parse($connect, $requete2);
              oci_bind_by_name($req2,':idArticle', $recherche);
              $result2 = oci_execute($req2);

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
        //supression de echo form

      echo('</div>');

      echo('<section id="sliderCategorie">');

        echo('<p id="titleCategorieSlider">In the same category, there are :</p>');
          
        echo('<button class="pre-btn">&#10095;</button>');
        echo('<button class="nxt-btn">&#10095;</button>');

        echo('<div class="sliderContainer">');

          while (($article = oci_fetch_assoc($req1))!= false) {
            echo('<div id="containerCategorieArticle" style="cursor: pointer;" onclick="location.href=\'produit.php?id='.$article['IDARTICLE'].'\'">');

              echo("<img class='imageCategorieArticle' src='./include/images/imagesArticles/".$article['IDARTICLE'].".png'>");
              echo("<br/>");
              echo('<p class="articleCaroussel">'.$article['NOMARTICLE'].'</p>');
    
            echo("</div>");
          }

        echo('</div>');

      echo('</section>');

      echo("<br/>");

    } else {

      echo('<div id="containerProduitArticle">');
        echo('<h1 id="titreArticle">'.$product_nom.'</h1>');

        echo('<form method="post" action="panier.php">');
          echo('<input type="hidden" name="product_id" value="'.$recherche.'">');

          echo('<div id="gridProduit">');

            echo('<div class="imageCell">');
              echo("<img id='imageProduit' src='include/images/imagesArticles/". $product_id.".png'>");
            echo('</div>');

            echo('<div class="main-infos">');
            echo('Note globale');

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
              echo('<input type="number" id="quantity" name="quantite" min="1" max="999" value="1">');

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

            //Affichage ou non du prix promo
            $boolPromo = 0;

            while(($articlePromo = oci_fetch_assoc($req3))!= false) {

              $prixPromo = $articlePromo['PRIXPROMO'];
              $articleConcerne = $articlePromo['IDARTICLE'];

              if($articleConcerne == $recherche) {
                $boolPromo = 1;
                $newPrixPromo = $prix - ($prix*$prixPromo)/100;

                echo('<div id="prixProduit">');
                  echo('<p>Prix : <strike><font color="#FF0000">'.$prix.' '.$prefmonnaie.' '.'</strike></font><b><font color="#00FF00">'.$newPrixPromo.' </b></font>'.$prefmonnaie.'</p>'); //$_SESSION['monnaie'].
                echo('</div>');
              }
            }

            if($boolPromo == 0) {
              echo('<div id="prixProduit">');
                echo('<p>Prix : '.$prix.' '.$prefmonnaie.'</p>'); //$_SESSION['monnaie'].
              echo('</div>');
            }

            echo('<div class="payerProduit">');

              if(!isset($_SESSION['utilisateur']) || $_SESSION['utilisateur'] == 'Admin') {

                echo('<button name="ajout" id="btnPanierCategorie" disabled>');
                  echo('<img src="./include/images/panier.png" id="imagePanier" alt="image">');
                echo('</button>');

              } else {

                echo('<button name="ajout" id="btnPanier">');
                  echo('<img src="./include/images/panier.png" id="imagePanier" alt="image">');
                echo('</button>');

              }

            echo('</div>');

        echo('</form>');
            
            echo('<div class="singleCellProduit">');
              echo('<p>Avis :</p>');
            echo('</div>');
            $articleCommande = oci_fetch_assoc($req5);
        
            echo('<div id="avisProduit">');
              //if idarticle est dans une commande d'idacteur qui est actuellement l'utilisateur
              if($articleCommande){
                echo('<div class="containerAvis">');
                    //faire une requete pour afficher nom prenom de l'utilisateur
                  echo("<p class='avisPersonne'> Laissez un avis :</p>");
                
                  echo('<form method="post" action="produit.php?id='.$recherche.'">');
                
                    echo('<p class="avisPersonne">Note : </p>');
                    echo('<input id="noteArticle" type="number" name="noteAvis" min="1" max="5" value="5">');

                    echo('</p>');
                    echo("<br/>");
                    echo('<hr>');
                    
                    echo('<p class="avisPersonne">Votre avis : </p>');
                    echo('<textarea id="zoneAvis" name="instruction" maxlength="200" required/></textarea>');
                    echo('<br/><br/>');
                    echo('<input type="submit" name="AvisPersonne" value="Envoyer" id="btnAvis"/>');

                  echo('</form>');
                echo('</div>');

                if ($_SERVER['REQUEST_METHOD'] == 'POST'){
                  $noteAvis=$_POST['noteAvis'];
                  $commentaire = htmlspecialchars($_POST['instruction']);
                  $id = $_SESSION['id'];
                  $article = $recherche;

                  $avisExistant = "SELECT IDACTEUR FROM AVIS WHERE IDACTEUR = :idacteur AND IDARTICLE = :idarticle";
                  $reqAvisExistant = oci_parse($connect, $avisExistant);
                  oci_bind_by_name($reqAvisExistant, ":idarticle",$article);
                  oci_bind_by_name($reqAvisExistant, ":idacteur",$id);
                  $resultAvisExistant= oci_execute($reqAvisExistant);
                  $avisExistant = oci_fetch_assoc($reqAvisExistant);

                  if($avisExistant){
                    $avisUpdate = "UPDATE AVIS SET AVIS = :commentaire, NOTE = :noteAvis WHERE IDACTEUR = :acteur AND IDARTICLE = :article";
                    $reqAvisUpdate = oci_parse($connect, $avisUpdate);
                    oci_bind_by_name($reqAvisUpdate, ":noteAvis",$noteAvis);
                    oci_bind_by_name($reqAvisUpdate, ":commentaire",$commentaire);
                    oci_bind_by_name($reqAvisUpdate, ":article",$article);
                    oci_bind_by_name($reqAvisUpdate, ":acteur",$id);
                    $resultAvisUpdate = oci_execute($reqAvisUpdate);
                  } else {
                    $avisInsert = "INSERT INTO AVIS(IDACTEUR,IDARTICLE,AVIS,NOTE) VALUES (:acteur,:article,:commentaire,:noteAvis)";
                    $reqAvisInsert = oci_parse($connect, $avisInsert);
                    oci_bind_by_name($reqAvisInsert, ":noteAvis",$noteAvis);
                    oci_bind_by_name($reqAvisInsert, ":commentaire",$commentaire);
                    oci_bind_by_name($reqAvisInsert, ":article",$article);
                    oci_bind_by_name($reqAvisInsert, ":acteur",$id);
                    $resultAvisInsert = oci_execute($reqAvisInsert);
                  }
                }
            
                echo('<hr id="separateurAvis"/>');
              }

              //Recup le nom et prénom et l'avis et la note de la personne sur un produit
              $requete2 = "SELECT ACTEUR.NOMACTEUR,ACTEUR.PRENOMACTEUR,AVIS.NOTE,AVIS.AVIS FROM ACTEUR,AVIS WHERE ACTEUR.IDACTEUR = AVIS.IDACTEUR AND AVIS.IDARTICLE =:idArticle";
              $req2 = oci_parse($connect, $requete2);
              oci_bind_by_name($req2,':idArticle', $recherche);
              $result2 = oci_execute($req2);

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
        //supression de echo form

      echo('</div>');

      echo('<section id="sliderCategorie">');

        echo('<p id="titleCategorieSlider">Dans la même catégorie, il y a :</p>');
          
        echo('<button class="pre-btn">&#10095;</button>');
        echo('<button class="nxt-btn">&#10095;</button>');

        echo('<div class="sliderContainer">');

          while (($article = oci_fetch_assoc($req1))!= false) {
            echo('<div id="containerCategorieArticle" style="cursor: pointer;" onclick="location.href=\'produit.php?id='.$article['IDARTICLE'].'\'">');

              echo("<img class='imageCategorieArticle' src='./include/images/imagesArticles/".$article['IDARTICLE'].".png'>");
              echo("<br/>");
              echo('<p class="articleCaroussel">'.$article['NOMARTICLE'].'</p>');
    
            echo("</div>");
          }

        echo('</div>');

      echo('</section>');

      echo("<br/>");

    }

  ?>

  <script src="scriptcaroussel.js"></script>

  <?php include("./include/footer.php"); ?>

</body>
</html>