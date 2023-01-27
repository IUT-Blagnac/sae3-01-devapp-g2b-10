<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8"/>
    <link rel="stylesheet" href="./include/styles.css"/>
    <link rel="icon" href="./include/images/artichaude.jpg"/>
	<title>Panier</title>
</head>
<body>
    <?php session_start(); ?>
    <?php include("./include/header.php"); ?>
    <?php require_once("connect.inc.php"); ?>
    <?php
    
        if(isset($_SESSION['langue']) && $_SESSION['langue'] == 'EN') {

            echo('<div class="squarE">');
                echo('<div id="titleFrame"><h1 id="formTitle">Shopping cart :</h1></div>');
            
                if(!isset($_SESSION['id'])){

                    echo('<a id="linkToConnexion" href="./connexion.php"><p>Please login to access your shopping cart.</p></a>');

                } else if($_SESSION['utilisateur'] == 'Admin'){
                    echo('<a id="linkToConnexion" href="./connexion.php"><p>Please login with a customer or artist account to access your cart.</p></a>');

                } else {
                    
                    if (isset($_POST['ajout'])){
                        $product_id = htmlspecialchars($_POST['product_id']);
                        $quantite = htmlspecialchars($_POST['quantite']);
                        $idacteur = htmlspecialchars($_SESSION['id']);
                        $couleur = htmlspecialchars($_POST['couleur']);

                        $reqPanier = "SELECT * FROM PANIER WHERE idArticle = :product_id AND idActeur = :idacteur AND couleur = :couleur";
                        $panierRecup = oci_parse($connect, $reqPanier);
                        oci_bind_by_name($panierRecup,':product_id',$product_id);
                        oci_bind_by_name($panierRecup,':idacteur',$idacteur);
                        oci_bind_by_name($panierRecup,':couleur',$couleur);
                        $resultPanier = oci_execute($panierRecup);

                        if (oci_fetch_assoc($panierRecup)) {
                            $requeteUpdate = "UPDATE PANIER SET quantiteArticle = quantiteArticle + :quantite WHERE idArticle = :product_id AND idActeur = :idacteur AND couleur = :couleur";
                            $reqUpdate = oci_parse($connect,$requeteUpdate);

                            oci_bind_by_name($reqUpdate,':product_id',$product_id);
                            oci_bind_by_name($reqUpdate,':quantite',$quantite);
                            oci_bind_by_name($reqUpdate,':idacteur',$idacteur);
                            oci_bind_by_name($reqUpdate,':couleur',$couleur);

                            $resultUpdate = oci_execute($reqUpdate);

                            if (!$resultUpdate) {
                                $e = oci_error($reqUpdate);  // on récupère l'exception liée au pb d'execution de la requete (violation PK par exemple)
                                $SQLerror = htmlentities($e['message'] . ' pour cette requete : ' . $e['sqltext']);

                                header('Location: ./index.php?msgErreur=' . $SQLerror);
                                exit;
                            }

                        } else {
                            $requeteInsert = "INSERT INTO PANIER (idActeur, idArticle, QuantiteArticle, Couleur) VALUES (:idacteur, :product_id, :quantite, :couleur)";
                            $reqInsert = oci_parse($connect,$requeteInsert);

                            oci_bind_by_name($reqInsert,':product_id',$product_id);
                            oci_bind_by_name($reqInsert,':quantite',$quantite);
                            oci_bind_by_name($reqInsert,':idacteur',$idacteur);
                            oci_bind_by_name($reqInsert,':couleur',$couleur);

                            $result = oci_execute($reqInsert);

                            if (!$result) {
                                $e = oci_error($reqInsert);  // on récupère l'exception liée au pb d'execution de la requete (violation PK par exemple)
                                $SQLerror = htmlentities($e['message'] . ' pour cette requete : ' . $e['sqltext']);

                                header('Location: ./index.php?msgErreur=' . $SQLerror);
                                exit;
                            }
                        }
                    }
            
                    $requete1 = "SELECT PANIER.IDARTICLE, NOMARTICLE, PRIXARTICLE, PRIXPROMO, COULEUR, QUANTITEARTICLE FROM ARTICLE,PANIER WHERE ARTICLE.IDARTICLE=PANIER.IDARTICLE AND PANIER.IDACTEUR=:idacteur";
                    $req1 = oci_parse($connect,$requete1);
                    oci_bind_by_name($req1,':idacteur',$_SESSION['id']);
                    oci_execute($req1);
            
                    $totalPanier = 0;
                    $totalArticle = 0;
                    $compteur = 0;
            
                    $panier = oci_fetch_assoc($req1);
            
                    if (!$panier){
                        echo('<div id="littleTitleFrame"><h3 id="formTitle">Your shopping cart is empty</h3></div>');
                    } else {
                        do {

                            $requete6 = "SELECT PREFMONNAIE FROM ACTEUR WHERE IDACTEUR=:idacteur";
                            $req6 = oci_parse($connect, $requete6);
                            oci_bind_by_name($req6,':idacteur',$_SESSION['id']);
                            $result6 = oci_execute($req6);
                            while(($prefmonnaie1 = oci_fetch_assoc($req6))!= false) {
                                $prefmonnaie = $prefmonnaie1['PREFMONNAIE'];
                            } 

                            $requete3 = "SELECT IDARTICLE, PRIXPROMO FROM ARTICLE WHERE IDARTICLE IN (15, 2, 12, 3)";
                            $req3 = oci_parse($connect, $requete3);
                            $result3 = oci_execute($req3);

                            $compteur++;
                            $product_id = $panier['IDARTICLE'];
                            $product_nom = $panier['NOMARTICLE'];
                            $product_quantite = $panier['QUANTITEARTICLE'];
                            $product_prix = $panier['PRIXARTICLE'];
                            $product_couleur = $panier['COULEUR'];

                            echo('<div id="gridPanier">');
            
                                echo('<div class="headPanier">');
                                    echo("<p class='headTextePanier'>Product name : ".$product_nom."</p>");    
                                echo('</div>');

                                echo('<div class="caracPanier">');
                                    echo("<img id='imgPanier' src='include/images/imagesArticles/". $product_id.".png'>");
                                echo('</div>');

                                echo('<form id="formQuantite" method="post" action="traitModifPanier.php">');
                                    //Faire un formulaire pour prendre en compte les modifs

                                    echo('<input type="hidden" name="productID" value="'.$product_id.'">');
                                    echo('<input type="hidden" name="productCouleur" value="'.$product_couleur.'">');

                                    echo('<div class="caracQuantitePanier">');
                                        echo("<p>Quantity : </p>");
                                        echo('<input type="number" id="quantity" name="quantity" min="0" max="999" value="'.$product_quantite.'">');
                                        echo('<input type="submit" name="Modifier" id="modifPanier" value="Modify">');
                                    echo('</div>');

                                echo('</form>');

                                echo('<div class="caracPanier">');
                                    //Chercher le coloris depuis produit
                                    echo('<p>Color : '.$product_couleur.'</p>');
                                echo('</div>');
                                
                                $boolPromo = 0;
                                while(($articlePromo = oci_fetch_assoc($req3))!= false) {
                                    
                                    $prixPromo = $articlePromo['PRIXPROMO'];
                                    $articleConcerne = $articlePromo['IDARTICLE'];
                                
                                    if($articleConcerne == $product_id) {
                                    $boolPromo = 1;
                                    $newPrixPromo = $product_prix - ($product_prix*$prixPromo)/100;
                                    }
                                }
                                
                                echo('<div class="caracPanier">');
                                if($boolPromo ==0){
                                    echo("<p>Unit price : ".$product_prix." ".$prefmonnaie."</p>");
                                } else {
                                    echo('<p>Unit price : <strike><font color="#FF0000">'.$product_prix." ".$prefmonnaie.'</font></strike><b><font color="#00FF00"> '.$newPrixPromo.' </b></font>'.$prefmonnaie.'</p>');
                                }
                                echo('</div>');

                                if($boolPromo ==0){
                                    $totalArticle = $product_prix * $product_quantite;
                                }else{
                                    $totalArticle = $newPrixPromo * $product_quantite;  
                                }
                            
                                echo('<div class="headPanier">');

                                    if($boolPromo ==0) {
                                        echo("<p class='headTextePanier'>Total price : ".$totalArticle." ".$prefmonnaie."</p>");
                                    } else {
                                        echo("<p class='headTextePanier'>Total price : ".$totalArticle." ".$prefmonnaie."</p>");
                                    }
                                
                                echo('</div>');
                                
                                $totalPanier += $totalArticle;
                                $panier = oci_fetch_assoc($req1);

                            echo('</div>');

                            echo('<hr id="delimiteurPanier">');
            
                        } while ($panier);
            
                        echo("<p><b>Shopping cart price : ".$totalPanier." ".$prefmonnaie."</b></p>");

                        echo('<form method="post" action="paiement.php">');
                            echo('<input type="submit" id="commanderPanier" name="Commander" value="Order &#x27A4;">');
                        echo('</form>');
                    }
                    
                }
        
            echo('</div>');

        } else {

            echo('<div class="squarE">');
                echo('<div id="titleFrame"><h1 id="formTitle">Panier :</h1></div>');
            
                if(!isset($_SESSION['id'])){

                    echo('<a id="linkToConnexion" href="./connexion.php"><p>Veuillez vous connecter pour accéder à votre panier.</p></a>');

                } else if($_SESSION['utilisateur'] == 'Admin'){
                    echo('<a id="linkToConnexion" href="./connexion.php"><p>Veuillez vous connecter avec un compte client ou artiste pour accéder à votre panier.</p></a>');

                } else {
                    
                    if (isset($_POST['ajout'])){
                        $product_id = htmlspecialchars($_POST['product_id']);
                        $quantite = htmlspecialchars($_POST['quantite']);
                        $idacteur = htmlspecialchars($_SESSION['id']);
                        $couleur = htmlspecialchars($_POST['couleur']);

                        $reqPanier = "SELECT * FROM PANIER WHERE idArticle = :product_id AND idActeur = :idacteur AND couleur = :couleur";
                        $panierRecup = oci_parse($connect, $reqPanier);
                        oci_bind_by_name($panierRecup,':product_id',$product_id);
                        oci_bind_by_name($panierRecup,':idacteur',$idacteur);
                        oci_bind_by_name($panierRecup,':couleur',$couleur);
                        $resultPanier = oci_execute($panierRecup);

                        if (oci_fetch_assoc($panierRecup)) {
                            $requeteUpdate = "UPDATE PANIER SET quantiteArticle = quantiteArticle + :quantite WHERE idArticle = :product_id AND idActeur = :idacteur AND couleur = :couleur";
                            $reqUpdate = oci_parse($connect,$requeteUpdate);

                            oci_bind_by_name($reqUpdate,':product_id',$product_id);
                            oci_bind_by_name($reqUpdate,':quantite',$quantite);
                            oci_bind_by_name($reqUpdate,':idacteur',$idacteur);
                            oci_bind_by_name($reqUpdate,':couleur',$couleur);

                            $resultUpdate = oci_execute($reqUpdate);

                            if (!$resultUpdate) {
                                $e = oci_error($reqUpdate);  // on récupère l'exception liée au pb d'execution de la requete (violation PK par exemple)
                                $SQLerror = htmlentities($e['message'] . ' pour cette requete : ' . $e['sqltext']);

                                header('Location: ./index.php?msgErreur=' . $SQLerror);
                                exit;
                            }

                        } else {
                            $requeteInsert = "INSERT INTO PANIER (idActeur, idArticle, QuantiteArticle, Couleur) VALUES (:idacteur, :product_id, :quantite, :couleur)";
                            $reqInsert = oci_parse($connect,$requeteInsert);

                            oci_bind_by_name($reqInsert,':product_id',$product_id);
                            oci_bind_by_name($reqInsert,':quantite',$quantite);
                            oci_bind_by_name($reqInsert,':idacteur',$idacteur);
                            oci_bind_by_name($reqInsert,':couleur',$couleur);

                            $result = oci_execute($reqInsert);

                            if (!$result) {
                                $e = oci_error($reqInsert);  // on récupère l'exception liée au pb d'execution de la requete (violation PK par exemple)
                                $SQLerror = htmlentities($e['message'] . ' pour cette requete : ' . $e['sqltext']);

                                header('Location: ./index.php?msgErreur=' . $SQLerror);
                                exit;
                            }
                        }
                    }
            
                    $requete1 = "SELECT PANIER.IDARTICLE, NOMARTICLE, PRIXARTICLE, PRIXPROMO, COULEUR, QUANTITEARTICLE FROM ARTICLE,PANIER WHERE ARTICLE.IDARTICLE=PANIER.IDARTICLE AND PANIER.IDACTEUR=:idacteur";
                    $req1 = oci_parse($connect,$requete1);
                    oci_bind_by_name($req1,':idacteur',$_SESSION['id']);
                    oci_execute($req1);
            
                    $totalPanier = 0;
                    $totalArticle = 0;
                    $compteur = 0;
            
                    $panier = oci_fetch_assoc($req1);
            
                    if (!$panier){
                        echo('<div id="littleTitleFrame"><h3 id="formTitle">Votre panier est vide</h3></div>');
                    } else {
                        do {

                            $requete6 = "SELECT PREFMONNAIE FROM ACTEUR WHERE IDACTEUR=:idacteur";
                            $req6 = oci_parse($connect, $requete6);
                            oci_bind_by_name($req6,':idacteur',$_SESSION['id']);
                            $result6 = oci_execute($req6);
                            while(($prefmonnaie1 = oci_fetch_assoc($req6))!= false) {
                                $prefmonnaie = $prefmonnaie1['PREFMONNAIE'];
                            } 

                            $requete3 = "SELECT IDARTICLE, PRIXPROMO FROM ARTICLE WHERE IDARTICLE IN (15, 2, 12, 3)";
                            $req3 = oci_parse($connect, $requete3);
                            $result3 = oci_execute($req3);

                            $compteur++;
                            $product_id = $panier['IDARTICLE'];
                            $product_nom = $panier['NOMARTICLE'];
                            $product_quantite = $panier['QUANTITEARTICLE'];
                            $product_prix = $panier['PRIXARTICLE'];
                            $product_couleur = $panier['COULEUR'];

                            echo('<div id="gridPanier">');
            
                                echo('<div class="headPanier">');
                                    echo("<p class='headTextePanier'>Nom produit : ".$product_nom."</p>");    
                                echo('</div>');

                                echo('<div class="caracPanier">');
                                    echo("<img id='imgPanier' src='include/images/imagesArticles/". $product_id.".png'>");
                                echo('</div>');

                                echo('<form id="formQuantite" method="post" action="traitModifPanier.php">');
                                    //Faire un formulaire pour prendre en compte les modifs

                                    echo('<input type="hidden" name="productID" value="'.$product_id.'">');
                                    echo('<input type="hidden" name="productCouleur" value="'.$product_couleur.'">');

                                    echo('<div class="caracQuantitePanier">');
                                        echo("<p>Quantité : </p>");
                                        echo('<input type="number" id="quantity" name="quantity" min="0" max="999" value="'.$product_quantite.'">');
                                        echo('<input type="submit" name="Modifier" id="modifPanier" value="Modifier">');
                                    echo('</div>');

                                echo('</form>');

                                echo('<div class="caracPanier">');
                                    //Chercher le coloris depuis produit
                                    echo('<p>Coloris : '.$product_couleur.'</p>');
                                echo('</div>');
                                
                                $boolPromo = 0;
                                while(($articlePromo = oci_fetch_assoc($req3))!= false) {
                                    
                                    $prixPromo = $articlePromo['PRIXPROMO'];
                                    $articleConcerne = $articlePromo['IDARTICLE'];
                                
                                    if($articleConcerne == $product_id) {
                                    $boolPromo = 1;
                                    $newPrixPromo = $product_prix - ($product_prix*$prixPromo)/100;
                                    }
                                }
                                
                                echo('<div class="caracPanier">');
                                if($boolPromo ==0){
                                    echo("<p>Prix unitaire : ".$product_prix." ".$prefmonnaie."</p>");
                                } else {
                                    echo('<p>Prix unitaire : <strike><font color="#FF0000">'.$product_prix." ".$prefmonnaie.'</font></strike><b><font color="#00FF00"> '.$newPrixPromo.' </b></font>'.$prefmonnaie.'</p>');
                                }
                                echo('</div>');

                                if($boolPromo ==0){
                                    $totalArticle = $product_prix * $product_quantite;
                                }else{
                                    $totalArticle = $newPrixPromo * $product_quantite;  
                                }
                            
                                echo('<div class="headPanier">');

                                    if($boolPromo ==0) {
                                        echo("<p class='headTextePanier'>Prix total : ".$totalArticle." ".$prefmonnaie."</p>");
                                    } else {
                                        echo("<p class='headTextePanier'>Prix total : ".$totalArticle." ".$prefmonnaie."</p>");
                                    }
                                
                                echo('</div>');
                                
                                $totalPanier += $totalArticle;
                                $panier = oci_fetch_assoc($req1);

                            echo('</div>');

                            echo('<hr id="delimiteurPanier">');
            
                        } while ($panier);
            
                        echo("<p><b>Prix du panier : ".$totalPanier." ".$prefmonnaie."</b></p>");

                        echo('<form method="post" action="paiement.php">');
                            echo('<input type="submit" id="commanderPanier" name="Commander" value="Commander &#x27A4;">');
                        echo('</form>');
                    }
                    
                }
        
            echo('</div>');

        }
  
    ?>
    <?php include("./include/footer.php"); ?>
</body>
</html>
  