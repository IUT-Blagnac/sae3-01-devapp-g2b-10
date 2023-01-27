<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8"/>
  <link rel="stylesheet" href="./include/styles.css"/>
  <link rel="icon" href="./include/images/artichaude.jpg"/>
	<title>Recherche</title>
</head>
<body>
  <?php session_start(); ?>
  <?php require_once("connect.inc.php"); ?>
  <?php include("./include/header.php"); ?>

  <?php 

    if(isset($_POST['s']) AND !empty(trim($_POST['s']))){
      echo $_POST['s'];
      $requete = "SELECT * FROM ARTICLE WHERE UPPER(NOMARTICLE) LIKE UPPER('%'||:s||'%')";
      $req1 = oci_parse($connect, $requete);
      oci_bind_by_name($req1,':s',$_POST['s']);
      $result =oci_execute($req1);
    }

    if(isset($_SESSION['langue']) && $_SESSION['langue'] == 'EN') {

      echo ("<div class='squarE'>"); 

        if (isset($_POST['s']) AND !empty($_POST['s'])){

          if((isset($_POST['s'])) AND ($result != True)) { 
          
            echo("<h1 class='titleArticles'>No products matching your search : ".$_POST['s'])."</h1>";

          } else {
          
            echo("<h1 class='titleArticles'>Found results for '".$_POST['s']."' :</h1>");
            echo("<div id='gridArticles'>");
            
              while (($article = oci_fetch_assoc($req1))!= false) { 
              
                echo('<div class="containerArticle" style="cursor: pointer;" onclick="location.href=\'produit.php?id='.$article['IDARTICLE'].'\'">');

                  echo("<img class='imageArticle' src='include/images/imagesArticles/".$article['NOMARTICLE'].".png'>");
                  echo("<br/>");
                  echo('<p class="articleText">'.$article['NOMARTICLE'].'</p>');

                echo("</div>");

              }

            echo("</div>");

            if((oci_num_rows($req1))<1){
              echo("<h1 class='titleArticles'>No products matching your search : ".$_POST['s'])."</h1>";
            }
            
          }

        } else {
          header("Location: ./index.php");
          exit;
        }
            
      echo("</div>");

    } else {

      echo ("<div class='squarE'>"); 

        if (isset($_POST['s']) AND !empty($_POST['s'])){

          if((isset($_POST['s'])) AND ($result != True)) { 
          
            echo("<h1 class='titleArticles'>Aucun produit ne correspond à votre recherche : ".$_POST['s'])."</h1>";

          } else {
          
            echo("<h1 class='titleArticles'>Résultats trouvés pour '".$_POST['s']."' :</h1>");
            echo("<div id='gridArticles'>");
            
              while (($article = oci_fetch_assoc($req1))!= false) { 
              
                echo('<div class="containerArticle" style="cursor: pointer;" onclick="location.href=\'produit.php?id='.$article['IDARTICLE'].'\'">');

                  echo("<img class='imageArticle' src='include/images/imagesArticles/".$article['NOMARTICLE'].".png'>");
                  echo("<br/>");
                  echo('<p class="articleText">'.$article['NOMARTICLE'].'</p>');

                echo("</div>");

              }

            echo("</div>");

            if((oci_num_rows($req1))<1){
              echo("<h1 class='titleArticles'>Aucun produit ne correspond à votre recherche : ".$_POST['s'])."</h1>";
            }
            
          }

        } else {
          header("Location: ./index.php");
          exit;
        }
            
      echo("</div>");

    }

  ?>

  <?php include("./include/footer.php"); ?>

</body>
</html>