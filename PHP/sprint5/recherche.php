<?php 
  require_once("connect.inc.php");
  if(isset($_POST['s']) AND !empty($_POST['s'])){

    $recherche = htmlspecialchars($_POST['s']);
    $requete = "Select * FROM ARTICLE WHERE NOMARTICLE LIKE '%' || :articles || '%'";;
    $req1 = oci_parse($connect, $requete);
    oci_bind_by_name($req1,':articles',$recherche);
    $result= oci_execute($req1);
    
  }
?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8"/>
    <link rel="stylesheet" href="./include/styles.css"/>
	<title>Recherche</title>
</head>

<body>
	<?php include("./include/header.php");?>

    <div class="squarE">

      <p class = "text2">
  
      <?php 

        if (isset($_POST['s']) AND !empty($_POST['s'])){
          if((isset($_POST['s'])) AND ($article = oci_fetch_assoc($req1))!= True) { 
              echo "Aucun produit ne corespond à votre recherche : ".$_POST['s'];
          } else {
              ?>Résultats trouvés pour "<?php echo $_POST['s'] ; ?>" <?php
          }
        } else {
          header("Location: ./index.php");
        }
          
      ?>

      <section class="afficher_article">

        <?php 
        
          if (isset($_POST['s']) AND !empty($_POST['s'])){
             
           //n'affiche pas l'article 1
             
          
            while (($article = oci_fetch_assoc($req1))!= false) {
		        ?><div>
              <a href="produit.php?nom=<?php echo $article['NOMARTICLE']?>">
              <img src="./include/images/figurines/article1.jpg" alt="test">
              </br>
              </a>
              <?php
               echo $article['NOMARTICLE'];
             ?>
            </div>
	          <?php
          }
      
        }
        

        ?>
      </section>      

    </p>
  </div>

  <?php include("./include/footer.php"); ?>

</body>
</html>