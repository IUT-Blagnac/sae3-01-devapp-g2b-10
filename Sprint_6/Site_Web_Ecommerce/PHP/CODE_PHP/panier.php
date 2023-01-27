<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8"/>
    <link rel="stylesheet" href="./include/styles.css"/>
    <link rel="icon" href="./include/images/artichaude.jpg"/>
	<title>Panier</title>
</head>
<body>
    <?php include("./include/header.php"); ?>
    <?php require_once("connect.inc.php"); ?>
    <?php    
        session_start();

        echo('<div class="squarE">');
            echo('<div id="titleFrame"><h1 id="formTitle">Panier :</h1></div>');

            if(!isset($_SESSION['id'])){

                echo('<a id="linkToConnexion" href="./connexion.php"><p>Veuillez vous connecter pour accéder à votre panier.</p></a>');

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
                } else{
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
                    echo('<div id="titleFrame"><h1 id="formTitle">Votre panier est vide</h1></div>');
                } else {
                    do {
                        $compteur++;
                        $product_id = $panier['IDARTICLE'];
                        $product_nom = $panier['NOMARTICLE'];
                        $product_quantite = $panier['QUANTITEARTICLE'];
                        $product_prix = $panier['PRIXARTICLE'];
                        $product_couleur = $panier['COULEUR'];
                        $totalArticle = $product_prix * $product_quantite;

                        echo('<div id="gridPanier">');
        
                            echo('<div class="headPanier">');
                                echo("<p class='headTextePanier'>Nom produit : ".$product_nom."</p>");    
                            echo('</div>');

                            echo('<div class="caracPanier">');
                                echo("<img id='imgPanier' src='include/images/imagesArticles/". $product_nom.".png'>");
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

                            echo('<div class="caracPanier">');
                                echo("<p>Prix unitaire : ".$product_prix.".00€</p>");
                            echo('</div>');

                            echo('<div class="headPanier">');
                                echo("<p class='headTextePanier'>Prix total : ".$totalArticle.".00€</p>");
                            echo('</div>');
            
                            $totalPanier += $totalArticle;
            
                            $panier = oci_fetch_assoc($req1);

                        echo('</div>');

                        echo('<hr id="delimiteurPanier">');
        
                    } while ($panier);
        
                    echo("<p>Prix du panier : ".$totalPanier.".00€</p>");
                    echo('<input type="submit" id="commanderPanier" name="Commander" value="Commander &#x27A4;">');
                }

            }
        
        echo('</div>');
  
    ?>
    <?php include("./include/footer.php"); ?>
</body>
</html>
  