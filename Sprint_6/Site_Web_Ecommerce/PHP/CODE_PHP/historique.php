<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8"/>
    <link rel="stylesheet" href="./include/styles.css"/>
	<title>Historique des commandes</title>
</head>
<link rel="icon" href="./include/images/artichaude.jpg"/>
<body>
    <?php include("./include/header.php"); ?>
    <?php require_once("connect.inc.php"); ?>
    <?php    
        session_start();

        echo('<div class="squarE">');
            echo('<div id="titleFrame"><h1 id="formTitle">Historique de vos commandes :</h1></div>');
                
                $idacteur = htmlspecialchars($_SESSION['id']);
               
                $requeteCommandes = "SELECT * FROM Commande where Commande.idacteur=:id";
                $req = oci_parse($connect,$requeteCommandes);
                oci_bind_by_name($req,':id',$idacteur);
                $result = oci_execute($req);
                $numRows = oci_num_rows($req);
               
                if (!$result) {
                    echo('<div id="titleFrame"><h1 id="formTitle">Vous n\'avez aucune commandes</h1></div>');
                }else{
                
                    while(($test = oci_fetch_assoc($req))!= false ){
                        echo "test ".$test['IDCOMMANDE'];
                        $idcommande=$test['IDCOMMANDE'];
                    
                    
                    $commande = "SELECT NOMARTICLE,PRIXARTICLE,COULEUR,QUANTITEARTICLE FROM ARTICLE,DETAILCOMMANDE WHERE ARTICLE.IDARTICLE = DETAILCOMMANDE.IDARTICLE AND DETAILCOMMANDE= :idc ";
                    $req2 = oci_parse($connect,$commande);
                    oci_bind_by_name($req2,':idc',$idcommande);
                    oci_execute($req2);
                    while(($test2 = oci_fetch_assoc($req2))!= false ){
                        $product_nom = $test2['NOMARTICLE'];
                        $product_quantite = $test2['QUANTITEARTICLE'];
                        $product_prix = $test2['PRIXARTICLE'];
                        $product_couleur = $test2['COULEUR'];
                        echo $product_nom;
                    }
                }
                
            echo('<hr id="delimiteurPanier">');
            echo('</div>');
                }
        echo('</div>');
                
       ?>
    
<?php include("./include/footer.php"); ?>

</body>
</html>
  