<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8"/>
    <link rel="stylesheet" href="./include/styles.css"/>
    <link rel="icon" href="./include/images/artichaude.jpg"/>
	<title>Vos commandes</title>
</head>
<body>
    <?php session_start(); ?>
    <?php include("./include/header.php"); ?>
    <?php require_once("connect.inc.php"); ?>
    <?php
    
        if(isset($_SESSION['langue']) && $_SESSION['langue'] == 'EN') {

            echo('<div class="squarE">');
                echo('<div id="titleFrame"><h1 id="formTitle">Your orders :</h1></div>');

                if(!isset($_SESSION['id'])) {

                    echo('<a id="linkToConnexion" href="./connexion.php"><p>Please login to access your order history.</p></a>');
            
                } else if($_SESSION['utilisateur'] == 'Admin') {

                    echo('<a id="linkToConnexion" href="./connexion.php"><p>Please login with a customer or artist account to access your order history.</p></a>');

                } else {
                            
                    $idacteur = $_SESSION['id'];
                    $prefmonnaie = $_SESSION['monnaie'];
                    $requeteCommandes = "SELECT * FROM COMMANDE WHERE IDACTEUR = :id";
                    $req = oci_parse($connect,$requeteCommandes);
                    oci_bind_by_name($req,':id',$idacteur);
                    $result = oci_execute($req);
    
                    echo('<form method="post" id="formCommande">');

                        $lines = 0;

                        while(($test = oci_fetch_assoc($req))!= false){
                            $lines += 1;

                            if($lines == 1){
                                echo("<p>Choose the command to be displayed :</p>");
                                echo('<select name="numberCommande" id="selectCommande">');
                                echo('<option disabled selected>Order no.</option>');
                            }

                            $idcommande=$test['IDCOMMANDE'];
                            echo('<option class="optionArticles" value="'.$idcommande.'">'.$idcommande.'</option>');
                        }
                        echo('</select>');
                        echo('<br/>');

                        if($lines == 0){
                            echo('<div id="titleFrame"><h3 id="formTitle">You have no orders</h3></div>');
                        } else {
                            echo('<input type="submit" name="Rechercher" value="Search" id="btnRecherche">');
                        }

                    echo('</form>');
                    
                    if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['numberCommande'])) {
                    
                    
                        $idcommande1 = $_POST['numberCommande'];

                        $requeteCommandeSelect = "SELECT DATECOMMANDE,ADRLIVRAISON,INSTRUCTIONSCOMMANDE,ETATCOMMANDE FROM COMMANDE WHERE IDCOMMANDE = :id";
                        $reqCommandeSelect = oci_parse($connect, $requeteCommandeSelect);
                        oci_bind_by_name($reqCommandeSelect, ':id', $idcommande1);
                        $erreurCommandeSelect = oci_execute($reqCommandeSelect);

                        $resultCommandeSelect = oci_fetch_assoc($reqCommandeSelect);

                        $date_commande = $resultCommandeSelect['DATECOMMANDE'];
                        $adr_commande = $resultCommandeSelect['ADRLIVRAISON'];
                        $instructions = $resultCommandeSelect['INSTRUCTIONSCOMMANDE'];
                        $etat_commande = $resultCommandeSelect['ETATCOMMANDE'];

                        echo("</br></br>");
                        echo("<p><b>Order : " . $idcommande1 . "</b></p>");
                        echo("<p><i>Date : </i>" . $date_commande . "</p>");
                        echo("<p><i>Delivery address : </i>" . $adr_commande . "</p>");
                        echo("<p><i>Order instruction : </i>" . $instructions . "</p>");
                        echo("<p><i>Order status : </i>" . $etat_commande . "</p>");

                        echo('<hr id="delimiteurArticle">');

                        $commande = "SELECT ARTICLE.IDARTICLE,NOMARTICLE,PRIXARTICLEFIXE,COULEUR,QUANTITEARTICLE FROM ARTICLE,DETAILCOMMANDE WHERE ARTICLE.IDARTICLE = DETAILCOMMANDE.IDARTICLE AND DETAILCOMMANDE.idCOMMANDE= :idc ";
                        $req2 = oci_parse($connect, $commande);
                        oci_bind_by_name($req2, ':idc', $idcommande1);
                        oci_execute($req2);
                        $total = 0;

                        while (($test2 = oci_fetch_assoc($req2)) != false) {
                        $product_id= $test2['IDARTICLE'];
                        $product_nom = $test2['NOMARTICLE'];
                        $product_quantite = $test2['QUANTITEARTICLE'];
                        $product_prix = $test2['PRIXARTICLEFIXE'];
                        
                        $product_couleur = $test2['COULEUR'];

                        $prix_Total_Product = $product_prix * $product_quantite;

                        $total += $prix_Total_Product;

                        echo('<div id="gridCommande">');

                            echo('<div class="headCommande">');
                                echo("<p class='headTexteCommande'>Product name : ".$product_nom."</p>");
                            echo('</div>');

                            echo('<div class="caracCommande">');
                                echo("<img id='imgCommande' src='include/images/imagesArticles/".$product_id.".png'>");
                            echo('</div>');

                            echo('<div class="caracQuantiteCommande">');
                                echo("<p>Quantity : ".$product_quantite."</p></br>");
                            echo('</div>');

                            echo('<div class="caracCommande">');
                                echo("<p>Color : ".$product_couleur."</p></br>");
                            echo('</div>');

                            echo('<div class="caracCommande">');

                            echo("<p>Unit price : " .$product_prix." ".$prefmonnaie."</p></br>");

                            echo('</div>');

                            echo('<div class="headCommande">');
                                echo("<p class='headTexteCommande'>Total product price : ".$prix_Total_Product." ".$prefmonnaie."</p>");
                            echo('</div>');

                        echo('</div>');

                        echo('<hr id="delimiteurArticle">');

                        }

                        echo("<p><b>Total price of the order : ".$total." ".$prefmonnaie."</b></p></br>");

                    }
                }

            echo('</div>');

        } else {

            echo('<div class="squarE">');
                echo('<div id="titleFrame"><h1 id="formTitle">Vos commandes :</h1></div>');

                if(!isset($_SESSION['id'])) {

                    echo('<a id="linkToConnexion" href="./connexion.php"><p>Veuillez vous connecter pour accéder à votre historique des commandes.</p></a>');
            
                } else if($_SESSION['utilisateur'] == 'Admin') {

                    echo('<a id="linkToConnexion" href="./connexion.php"><p>Veuillez vous connecter avec un compte client ou artiste pour accéder à votre historique des commandes.</p></a>');

                } else {
                            
                    $idacteur = $_SESSION['id'];
                    $prefmonnaie = $_SESSION['monnaie'];
                    $requeteCommandes = "SELECT * FROM COMMANDE WHERE IDACTEUR = :id";
                    $req = oci_parse($connect,$requeteCommandes);
                    oci_bind_by_name($req,':id',$idacteur);
                    $result = oci_execute($req);
    
                    echo('<form method="post" id="formCommande">');

                        $lines = 0;

                        while(($test = oci_fetch_assoc($req))!= false){
                            $lines += 1;

                            if($lines == 1){
                                echo("<p>Choisissez la commande à afficher :</p>");
                                echo('<select name="numberCommande" id="selectCommande">');
                                echo('<option disabled selected>N°Commande</option>');
                            }

                            $idcommande=$test['IDCOMMANDE'];
                            echo('<option class="optionArticles" value="'.$idcommande.'">'.$idcommande.'</option>');
                        }
                        echo('</select>');
                        echo('<br/>');

                        if($lines == 0){
                            echo('<div id="titleFrame"><h3 id="formTitle">Vous n\'avez aucune commande</h3></div>');
                        } else {
                            echo('<input type="submit" name="Rechercher" value="Rechercher" id="btnRecherche">');
                        }

                    echo('</form>');
                    
                    if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['numberCommande'])) {
                    
                    
                        $idcommande1 = $_POST['numberCommande'];

                        $requeteCommandeSelect = "SELECT DATECOMMANDE,ADRLIVRAISON,INSTRUCTIONSCOMMANDE,ETATCOMMANDE FROM COMMANDE WHERE IDCOMMANDE = :id";
                        $reqCommandeSelect = oci_parse($connect, $requeteCommandeSelect);
                        oci_bind_by_name($reqCommandeSelect, ':id', $idcommande1);
                        $erreurCommandeSelect = oci_execute($reqCommandeSelect);

                        $resultCommandeSelect = oci_fetch_assoc($reqCommandeSelect);

                        $date_commande = $resultCommandeSelect['DATECOMMANDE'];
                        $adr_commande = $resultCommandeSelect['ADRLIVRAISON'];
                        $instructions = $resultCommandeSelect['INSTRUCTIONSCOMMANDE'];
                        $etat_commande = $resultCommandeSelect['ETATCOMMANDE'];

                        echo("</br></br>");
                        echo("<p><b>Commande : " . $idcommande1 . "</b></p>");
                        echo("<p><i>Date : </i>" . $date_commande . "</p>");
                        echo("<p><i>Adresse de livraison : </i>" . $adr_commande . "</p>");
                        echo("<p><i>Instruction de la commande : </i>" . $instructions . "</p>");
                        echo("<p><i>Etat de la commande : </i>" . $etat_commande . "</p>");

                        echo('<hr id="delimiteurArticle">');

                        $commande = "SELECT ARTICLE.IDARTICLE,NOMARTICLE,PRIXARTICLEFIXE,COULEUR,QUANTITEARTICLE FROM ARTICLE,DETAILCOMMANDE WHERE ARTICLE.IDARTICLE = DETAILCOMMANDE.IDARTICLE AND DETAILCOMMANDE.idCOMMANDE= :idc ";
                        $req2 = oci_parse($connect, $commande);
                        oci_bind_by_name($req2, ':idc', $idcommande1);
                        oci_execute($req2);
                        $total = 0;

                        while (($test2 = oci_fetch_assoc($req2)) != false) {
                        $product_id= $test2['IDARTICLE'];
                        $product_nom = $test2['NOMARTICLE'];
                        $product_quantite = $test2['QUANTITEARTICLE'];
                        $product_prix = $test2['PRIXARTICLEFIXE'];
                        
                        $product_couleur = $test2['COULEUR'];
                        
                        $prix_Total_Product = $product_prix * $product_quantite;

                        $total += $prix_Total_Product;

                        echo('<div id="gridCommande">');

                            echo('<div class="headCommande">');
                                echo("<p class='headTexteCommande'>Nom produit : ".$product_nom."</p>");
                            echo('</div>');

                            echo('<div class="caracCommande">');
                                echo("<img id='imgCommande' src='include/images/imagesArticles/".$product_id.".png'>");
                            echo('</div>');

                            echo('<div class="caracQuantiteCommande">');
                                echo("<p>Quantité : ".$product_quantite."</p></br>");
                            echo('</div>');

                            echo('<div class="caracCommande">');
                                echo("<p>Coloris : ".$product_couleur."</p></br>");
                            echo('</div>');

                            echo('<div class="caracCommande">');

                            echo("<p>Prix unitaire : " .$product_prix." ".$prefmonnaie."</p></br>");

                            echo('</div>');

                            echo('<div class="headCommande">');
                                echo("<p class='headTexteCommande'>Prix total du produit : ".$prix_Total_Product." ".$prefmonnaie."</p>");
                            echo('</div>');

                        echo('</div>');

                        echo('<hr id="delimiteurArticle">');

                        }

                        echo("<p><b>Prix total de la commande  : ".$total." ".$prefmonnaie."</b></p></br>");

                    }
                }

            echo('</div>');

        }
                
    ?>

    <?php include("./include/footer.php"); ?>

</body>
</html>
  