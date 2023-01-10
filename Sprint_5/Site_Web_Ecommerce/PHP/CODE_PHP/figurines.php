<?php 
  require_once("connect.inc.php");

  $recherche = 'FIGURINES';
  $requete = "Select * FROM ARTICLE WHERE NOMCATEGORIE LIKE '%' || :articles || '%'";;
  $req1 = oci_parse($connect, $requete);
  oci_bind_by_name($req1,':articles',$recherche);
  $result= oci_execute($req1);
    
?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8"/>
    <link rel="stylesheet" href="./include/styles.css"/>
	<title>Figurines</title>
</head>

<body>
	<?php include("./include/header.php");
      ?>

      
    <div class="squarE">
  
    <p class = "text2">
    Voici les figurines </p>
    <div id="gridMembers">
      <?php 
       while (($article = oci_fetch_assoc($req1))!= false) {
//grid de deux éléments,alors que nous devons faire un grid de 3 éléments

		    ?><div>
          

          
          <a href="produit.php?nom=<?php echo $article['NOMARTICLE']?>">
          
          <img src="./include/images/figurines/article1.jpg" alt="test">

          </br>
          </a>
          <div class="center">
          <?php
            echo $article['NOMARTICLE'];
          ?>
          </div>
          </div>
	    <?php
      }
      ?>
      </div>
    
    
    </div>
    <?php include("./include/footer.php"); ?>
  </body>
  </html>