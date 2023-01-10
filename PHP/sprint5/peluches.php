<?php 
  require_once("connect.inc.php");

  $recherche = 'PELUCHES';
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
	<title>Peluches</title>
</head>
<body>
	<?php include("./include/header.php");
      ?>
    <div class="squarE">

<p class = "text2">
Voici les peluches

<section class="afficher_article">
      <?php 
       while (($article = oci_fetch_assoc($req1))!= false) {
          
		      echo $article['NOMARTICLE'];
	        echo "<br/>";
        }
      
      ?>
</section>  




</p>
</div>
      <?php include("./include/footer.php"); ?>
  </body>
  </html>