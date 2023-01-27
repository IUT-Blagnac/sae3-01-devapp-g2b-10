<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="./include/styles.css"/>
    <link rel="icon" href="./include/images/artichaude.jpg"/>
    <title>Paiement</title>
</head>
<body>
    <?php session_start(); ?>
    <?php include("./include/header.php"); ?>
    <?php require_once("connect.inc.php"); ?>

    <?php

        if(isset($_SESSION['langue']) && $_SESSION['langue'] == 'EN') {

            $id = $_SESSION['id'];

            if(!isset($_SESSION['utilisateur'])) {

                header('Location: ./index.php');
                exit;

            } else if(!(isset($_POST['Commander']) || isset($_POST['carteBancaire']) || isset($_POST['cryptomonnaie']) || isset($_GET['msgErreur']))) { 

                header('Location: ./panier.php');
                exit;

            } else {

                echo('<form method="post" id="formModePaiement">');

                    echo('<div id="titleFrame"><h1 id="formTitle">Payment</h1></div>');

                    echo('<div id="gridPaiement">');

                        echo('<button name="carteBancaire" class="btnModePaiement">');
                            echo('<img class="imagesPaiement" src="./include/images/cb.png" alt="carte-bancaire"/>');
                            echo('<h3 class="textePaiement">Credit card</h3>');
                        echo('</button>'); 

                        echo('<button name="cryptomonnaie" class="btnModePaiement">');
                            echo('<img class="imagesPaiement" src="./include/images/crypto.png" alt="cryptomonnaie">');
                            echo('<h3 class="textePaiement">Cryptocurrency</h3>');
                        echo('</button>'); 

                    echo('</div>');

                echo('</form>');

                if(isset($_POST['carteBancaire'])) {
                    $_SESSION['moyenPaiement'] = 'carteBancaire';
                }

                if(isset($_POST['cryptomonnaie'])) {
                    $_SESSION['moyenPaiement'] = 'cryptomonnaie';
                }

                if(isset($_SESSION['moyenPaiement'])) {

                    if($_SESSION['moyenPaiement'] == 'carteBancaire') {

                        $req = "SELECT * FROM CARTEBANCAIRE WHERE IDACTEUR = :pIdActeur";
                        $CBRecup = oci_parse($connect, $req);
                        oci_bind_by_name($CBRecup, ":pIdActeur", $id);
                        $result = oci_execute($CBRecup);

                        if (!$result) {

                            $e = oci_error($CBRecup);  // on récupère l'exception liée au pb d'execution de la requete (violation PK par exemple)
                            $errorSQL = print htmlentities($e['message'].' pour cette requete : '.$e['sqltext']);
                            header("Location: ./paiement.php=?msgErreur=$errorSQL");
                            exit;
            
                        } else {

                            $CBClient = oci_fetch_assoc($CBRecup);

                            $numCB = '';
                            $nomCB = '';
                            $dateExpiration = '';
                            $cryptogramme = '';
                            $adresse = $_SESSION['adresse'];
                            $visa = '';
                            $mastercard = '';

                            if(!empty($CBClient)){

                                $numCB = $CBClient['NUMCB'];
                                $nomCB = $CBClient['NOMCB'];
                                $dateExpiration = $CBClient['DATEEXPIRATION'];
                                $cryptogramme = $CBClient['CRYPTOGRAMME'];

                                if($CBClient['SUPPORTPAIEMENT'] == 'M') {
                                    $mastercard = 'selected';
                                } else {
                                    $visa = 'selected';
                                }

                            }

                            echo('<form method="post" class="formPaiement" action="traitPaiement.php">');

                                echo('<br/>');
                                echo('<div id="littleTitleFrame"><h2 id="formTitle">Credit card</h2></div>');

                                if(isset($_GET['msgErreur'])){
                                    echo("<h3 class='errorDatabase'>".$_GET['msgErreur']."</h3>");
                                } else {
                                    echo("<h3 class='errorDatabase'>Please complete these informations</h3>");
                                }

                                echo('<label class="formLabels"> Delivery address :</label>');
                                echo('<input type="text" class="paiementChamps" name="adresse" value="'.$adresse.'" maxlength="20" required/>');
                                echo('<br/><br/>');

                                echo('<label class="formLabels"> Delivery instructions :</label>');
                                echo('<textarea type="text" class="champsForm" id="zoneCollab" name="instruction" maxlength="200"></textarea>');
                                echo('<br/><br/>');

                                echo('<label class="formLabels">Payment method :</label>');
                                echo('<select name="paiementcb" class="selectPaiement">');
                                    echo('<option class="optionMonnaies" value="V" '.$visa.'>Visa</option>');
                                    echo('<option class="optionMonnaies" value="M" '.$mastercard.'>Mastercard</option>');
                                echo('</select>');
                                echo('<br/>');

                                echo('<label class="formLabels">Credit card number :</label>');
                                echo('<input type="text" class="paiementChamps" name="numCB" value="'.$numCB.'" maxlength="16" required/>');
                                echo('<br/><br/>');

                                echo('<label class="formLabels">First and last name on your credit card :</label>');
                                echo('<input type="text" class="paiementChamps" name="namesCB" value="'.$nomCB.'" required/>');
                                echo('<br/><br/>');

                                echo('<label class="formLabels">Expiration date :</label>');
                                echo('<input type="text" class="paiementChamps" name="expiration" value="'.$dateExpiration.'" maxlength="4" required/>');
                                echo('<br/><br/>');

                                echo('<label class="formLabels">Cryptogram :</label>');
                                echo('<input type="text" class="paiementChamps" name="cryptogramme" value="'.$cryptogramme.'" maxlength="3" required/>');
                                echo('<br/><br/>');

                                echo('<label class="formLabels">Remember my credit card ?</label>');
                                echo('<label id="checkboxLabel">');
                                echo('<input type="checkbox" id="checkboxInput" name="memoCB"/>');
                                echo('<svg id="checkboxCheck">');
                                echo('<polyline points="20 6 9 17 4 12"></polyline>');
                                echo('</svg>');
                                echo('</label>');
                                echo('<br/><br/>');

                                echo('<input type="submit" name="PaiementCB" value="Payment" id="btnPaiement"/>');

                            echo('</form>');

                        }

                    }

                }
        
                if($_SESSION['moyenPaiement'] == 'cryptomonnaie') {
                    $adresse = $_SESSION['adresse'];
                    echo('<form method="post" class="formPaiement" action="traitPaiement.php">');

                        echo('<br/>');
                        echo('<div id="littleTitleFrame"><h2 id="formTitle">Cryptocurrency</h2></div>');

                        if(isset($_GET['msgErreur'])){
                            echo("<h3 class='errorDatabase'>".$_GET['msgErreur']."</h3>");
                        } else {
                            echo("<h3 class='errorDatabase'>Please complete these informations</h3>");
                        }

                        echo('<label class="formLabels"> Delivery address :</label>');
                        echo('<input type="text" class="paiementChamps" name="adresse" value="'.$adresse.'" maxlength="20" required/>');
                        echo('<br/><br/>');

                        echo('<label class="formLabels"> Delivery instructions :</label>');
                        echo('<textarea type="text" class="champsForm" id="zoneCollab" name="instruction" maxlength="200"/></textarea>');
                        echo('<br/><br/>');
                        
                        echo('<label class="formLabels">Payment support :</label>');
                        echo('<select name="paiementcrypto" class="selectPaiement">');
                            echo('<option class="optionMonnaies" value="B">Bitcoin</option>');
                            echo('<option class="optionMonnaies" value="E">Ethereum</option>');
                        echo('</select>');
                        echo('<br/>');

                        echo('<label class="formLabels">Reference number :</label>');
                        echo('<input type="text" class="paiementChamps" name="numRef" required/>');
                        echo('<br/><br/>');

                        echo('<input type="submit" name="PaiementCR" value="Payment" id="btnPaiement"/>');

                    echo('</form>');

                }

            }

        } else {

            $id = $_SESSION['id'];

            if(!isset($_SESSION['utilisateur'])) {

                header('Location: ./index.php');
                exit;

            } else if(!(isset($_POST['Commander']) || isset($_POST['carteBancaire']) || isset($_POST['cryptomonnaie']) || isset($_GET['msgErreur']))) { 

                header('Location: ./panier.php');
                exit;

            } else {

                echo('<form method="post" id="formModePaiement">');

                    echo('<div id="titleFrame"><h1 id="formTitle">Paiement</h1></div>');

                    echo('<div id="gridPaiement">');

                        echo('<button name="carteBancaire" class="btnModePaiement">');
                            echo('<img class="imagesPaiement" src="./include/images/cb.png" alt="carte-bancaire"/>');
                            echo('<h3 class="textePaiement">Carte bancaire</h3>');
                        echo('</button>'); 

                        echo('<button name="cryptomonnaie" class="btnModePaiement">');
                            echo('<img class="imagesPaiement" src="./include/images/crypto.png" alt="cryptomonnaie">');
                            echo('<h3 class="textePaiement">Cryptomonnaie</h3>');
                        echo('</button>'); 

                    echo('</div>');

                echo('</form>');

                if(isset($_POST['carteBancaire'])) {
                    $_SESSION['moyenPaiement'] = 'carteBancaire';
                }

                if(isset($_POST['cryptomonnaie'])) {
                    $_SESSION['moyenPaiement'] = 'cryptomonnaie';
                }

                if(isset($_SESSION['moyenPaiement'])) {

                    if($_SESSION['moyenPaiement'] == 'carteBancaire') {

                        $req = "SELECT * FROM CARTEBANCAIRE WHERE IDACTEUR = :pIdActeur";
                        $CBRecup = oci_parse($connect, $req);
                        oci_bind_by_name($CBRecup, ":pIdActeur", $id);
                        $result = oci_execute($CBRecup);

                        if (!$result) {

                            $e = oci_error($CBRecup);  // on récupère l'exception liée au pb d'execution de la requete (violation PK par exemple)
                            $errorSQL = print htmlentities($e['message'].' pour cette requete : '.$e['sqltext']);
                            header("Location: ./paiement.php=?msgErreur=$errorSQL");
                            exit;
            
                        } else {

                            $CBClient = oci_fetch_assoc($CBRecup);

                            $numCB = '';
                            $nomCB = '';
                            $dateExpiration = '';
                            $cryptogramme = '';
                            $adresse = $_SESSION['adresse'];
                            $visa = '';
                            $mastercard = '';

                            if(!empty($CBClient)){

                                $numCB = $CBClient['NUMCB'];
                                $nomCB = $CBClient['NOMCB'];
                                $dateExpiration = $CBClient['DATEEXPIRATION'];
                                $cryptogramme = $CBClient['CRYPTOGRAMME'];

                                if($CBClient['SUPPORTPAIEMENT'] == 'M') {
                                    $mastercard = 'selected';
                                } else {
                                    $visa = 'selected';
                                }

                            }

                            echo('<form method="post" class="formPaiement" action="traitPaiement.php">');

                                echo('<br/>');
                                echo('<div id="littleTitleFrame"><h2 id="formTitle">Carte bancaire</h2></div>');

                                if(isset($_GET['msgErreur'])){
                                    echo("<h3 class='errorDatabase'>".$_GET['msgErreur']."</h3>");
                                } else {
                                    echo("<h3 class='errorDatabase'>Veuillez compléter ces informations</h3>");
                                }

                                echo('<label class="formLabels"> Adresse de livraison :</label>');
                                echo('<input type="text" class="paiementChamps" name="adresse" value="'.$adresse.'" maxlength="20" required/>');
                                echo('<br/><br/>');

                                echo('<label class="formLabels"> Instructions de livraison :</label>');
                                echo('<textarea type="text" class="champsForm" id="zoneCollab" name="instruction" maxlength="200"></textarea>');
                                echo('<br/><br/>');

                                echo('<label class="formLabels">Support de paiement :</label>');
                                echo('<select name="paiementcb" class="selectPaiement">');
                                    echo('<option class="optionMonnaies" value="V" '.$visa.'>Visa</option>');
                                    echo('<option class="optionMonnaies" value="M" '.$mastercard.'>Mastercard</option>');
                                echo('</select>');
                                echo('<br/>');

                                echo('<label class="formLabels">Numéro de carte bancaire :</label>');
                                echo('<input type="text" class="paiementChamps" name="numCB" value="'.$numCB.'" maxlength="16" required/>');
                                echo('<br/><br/>');

                                echo('<label class="formLabels">Prénom et nom sur votre carte bancaire :</label>');
                                echo('<input type="text" class="paiementChamps" name="namesCB" value="'.$nomCB.'" required/>');
                                echo('<br/><br/>');

                                echo('<label class="formLabels">Date d\'expiration :</label>');
                                echo('<input type="text" class="paiementChamps" name="expiration" value="'.$dateExpiration.'" maxlength="4" required/>');
                                echo('<br/><br/>');

                                echo('<label class="formLabels">Cryptogramme :</label>');
                                echo('<input type="text" class="paiementChamps" name="cryptogramme" value="'.$cryptogramme.'" maxlength="3" required/>');
                                echo('<br/><br/>');

                                echo('<label class="formLabels">Se souvenir de ma CB ?</label>');
                                echo('<label id="checkboxLabel">');
                                echo('<input type="checkbox" id="checkboxInput" name="memoCB"/>');
                                echo('<svg id="checkboxCheck">');
                                echo('<polyline points="20 6 9 17 4 12"></polyline>');
                                echo('</svg>');
                                echo('</label>');
                                echo('<br/><br/>');

                                echo('<input type="submit" name="PaiementCB" value="Paiement" id="btnPaiement"/>');

                            echo('</form>');

                        }

                    }

                }
        
                if($_SESSION['moyenPaiement'] == 'cryptomonnaie') {
                    $adresse = $_SESSION['adresse'];
                    echo('<form method="post" class="formPaiement" action="traitPaiement.php">');

                        echo('<br/>');
                        echo('<div id="littleTitleFrame"><h2 id="formTitle">Cryptomonnaie</h2></div>');

                        if(isset($_GET['msgErreur'])){
                            echo("<h3 class='errorDatabase'>".$_GET['msgErreur']."</h3>");
                        } else {
                            echo("<h3 class='errorDatabase'>Veuillez compléter ces informations</h3>");
                        }

                        echo('<label class="formLabels"> Adresse de livraison :</label>');
                        echo('<input type="text" class="paiementChamps" name="adresse" value="'.$adresse.'" maxlength="20" required/>');
                        echo('<br/><br/>');

                        echo('<label class="formLabels"> Instructions de livraison :</label>');
                        echo('<textarea type="text" class="champsForm" id="zoneCollab" name="instruction" maxlength="200"/></textarea>');
                        echo('<br/><br/>');
                        
                        echo('<label class="formLabels">Support de paiement :</label>');
                        echo('<select name="paiementcrypto" class="selectPaiement">');
                            echo('<option class="optionMonnaies" value="B">Bitcoin</option>');
                            echo('<option class="optionMonnaies" value="E">Ethereum</option>');
                        echo('</select>');
                        echo('<br/>');

                        echo('<label class="formLabels">Numéro de référence :</label>');
                        echo('<input type="text" class="paiementChamps" name="numRef" required/>');
                        echo('<br/><br/>');

                        echo('<input type="submit" name="PaiementCR" value="Paiement" id="btnPaiement"/>');

                    echo('</form>');

                }

            }

        }

    ?>

    <?php include("./include/footer.php"); ?>

</body>
</html>