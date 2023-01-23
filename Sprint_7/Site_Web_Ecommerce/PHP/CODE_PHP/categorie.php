<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8"/>
  <link rel="stylesheet" href="./include/styles.css"/>
  <link rel="icon" href="./include/images/artichaude.jpg"/>
  <title>Figurines</title>
</head>
<body>

  <?php session_start(); ?>
  <?php require_once("connect.inc.php"); ?>
  <?php include("./include/header.php"); ?>

  <?php

  $recherche = $_GET['categorie'];
  $requete = "SELECT * FROM ARTICLE WHERE NOMCATEGORIE LIKE '%' || :categorie || '%'";
  $req1 = oci_parse($connect, $requete);
  oci_bind_by_name($req1,':categorie',$recherche);
  $result= oci_execute($req1);

    if(isset($_SESSION['langue']) && $_SESSION['langue'] == 'EN') {

      if($recherche == 'PELUCHES') {
        $recherche = 'PLUSHIES';
      }

      echo("<div class='squarE'>");
        echo("<h1 class='titleArticles'>Here are the ".strtolower($recherche)."</h1>");
        echo("<div id='gridArticles'>");

        while (($article = oci_fetch_assoc($req1))!= false) {
          echo('<div class="containerArticle" style="cursor: pointer;" onclick="location.href=\'produit.php?id='.$article['IDARTICLE'].'\'">');

            echo("<img class='imageArticle' src='./include/images/imagesArticles/".$article['IDARTICLE'].".png'>");
            echo("<br/>");
            echo('<p class="articleText">'.$article['NOMARTICLE'].'</p>');

          echo("</div>");
        }
        echo("</div>");
      echo("</div>");

    } else {

      echo("<div class='squarE'>");
        echo("<h1 class='titleArticles'>Voici les ".strtolower($recherche)."</h1>");
        echo("<div id='gridArticles'>");

        while (($article = oci_fetch_assoc($req1))!= false) {
          echo('<div class="containerArticle" style="cursor: pointer;" onclick="location.href=\'produit.php?id='.$article['IDARTICLE'].'\'">');

            echo("<img class='imageArticle' src='./include/images/imagesArticles/".$article['IDARTICLE'].".png'>");
            echo("<br/>");
            echo('<p class="articleText">'.$article['NOMARTICLE'].'</p>');

          echo("</div>");
        }
        echo("</div>");
      echo("</div>");

    }

  ?>
  
  <?php include("./include/footer.php"); ?>

</body>
</html>