
<?php


require_once("connect.inc.php");

//récupere la note du produit
$recherche = $_GET['nom'];
$requete = "SELECT AVG(AVIS.NOTE) AS NOTE FROM AVIS,ARTICLE WHERE  AVIS.IDARTICLE = ARTICLE.IDARTICLE  AND ARTICLE.NOMARTICLE = :nom" ;
$req1 = oci_parse($connect, $requete);
oci_bind_by_name($req1,':nom',$recherche);//article correspondant
$result= oci_execute($req1);



?>





<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8"/>
    <link rel="stylesheet" href="./include/styles.css"/>
	<title>Produit</title>
</head>
<body>
	<?php include("./include/header.php");
      ?>
    <div class="squarE">


<div>
<p class = "text5">
<?php
  $nom_produit = $_GET['nom'];
  echo $nom_produit;
?>
</p>
</div>
<div class="testt">
<img id ="box5" src="include/images/figurines/article1.jpg"> 
<div class= "text4">
  <p> Note globale :

      <?php   
     
      while (($note = oci_fetch_assoc($req1))!=false) {
          echo $note['NOTE'];
            //calcul à mieux faire pour notation
          echo "test";
		      if(($note['NOTE'])<=2){
            ?>
            <img id ="box10" src="include/images/artichaud-noir.png"> 
            <img id ="box9" src="include/images/artichaud-noir.png"> 
            <img id ="box9" src="include/images/artichaud-noir.png"> 
            <?php
          }else if($note['NOTE']<=4){
            ?>
            <img id ="box10" src="include/images/artichaud.png"> 
            <img id ="box9" src="include/images/artichaud.png"> 
            <img id ="box9" src="include/images/artichaud-noir.png"> 
            <?php
           }else {
            ?>
            <img id ="box10" src="include/images/artichaud.png"> 
            <img id ="box9" src="include/images/artichaud.png"> 
            <img id ="box9" src="include/images/artichaud.png"> 
            <?php  
          
        
	        echo "<br/>";
        }
      }
     
      ?>
        
    </p>
    </br>
  
  <form>
  <label for="quantite">Quantite:</label>
  <select id="quantite" name="quantite">
    <option value="1">1</option>
    <option value="2">2</option>
    <option value="3">3</option>
    <option value="4">4</option>
    <option value="5">5</option>
  </select>
      </form>
      <style>
 
  
</style>
</br>

<p>Description :</br>
  <div class="texttt">  </br>
Le Lorem Ipsum est simplement du faux texte employé dans la composition et la mise en page avant impression. Le Lorem Ipsum est le faux texte standard de l'imprimerie depuis les années 1500, quand un imprimeur anonyme assembla ensemble des morceaux de texte pour réaliser un livre spécimen de polices de texte. Il n'a pas fait que survivre cinq siècles, mais s'est aussi adapté à la bureautique informatique, sans que son contenu n'en soit modifié. Il a été popularisé dans les années 1960 grâce à la vente de feuilles Letraset contenant des passages du Lorem Ipsum, et, plus récemment, par son inclusion dans des applications de mise en page de texte, comme Aldus PageMaker

    </div></br>
    </p>

</div>

</div>



</div>
      <?php include("./include/footer.php"); ?>
  </body>
</html>