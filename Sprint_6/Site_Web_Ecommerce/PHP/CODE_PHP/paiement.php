<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="./include/styles.css"/>
    <link rel="icon" href="./include/images/artichaude.jpg"/>
    <title>Paiement</title>
</head>
<body>
    
    <?php include("./include/header.php"); 

    session_start();

    if(!isset($_SESSION['utilisateur'])) {

        header('Location: ./index.php');
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

                echo('<form method="post" class="formPaiement" action="traitPaiement.php">');

                    echo('<br/>');
                    echo('<div id="littleTitleFrame"><h2 id="formTitle">Carte bancaire</h2></div>');

                    if(isset($_GET['msgErreur'])){
                        echo("<h3 class='errorDatabase'>".$_GET['msgErreur']."</h3>");
                    } else {
                        echo("<h3 class='errorDatabase'>Veuillez compléter ces informations</h3>");
                    }

                    echo('<label class="formLabels">Support de paiement :</label>');
                    echo('<select name="paiementcb" class="selectPaiement">');
                        echo('<option class="optionMonnaies" value="V">Visa</option>');
                        echo('<option class="optionMonnaies" value="M">Mastercard</option>');
                    echo('</select>');
                    echo('<br/>');

                    echo('<label class="formLabels">Numéro de carte bancaire :</label>');
                    echo('<input type="text" class="paiementChamps" name="numCB" maxlength="16" required/>');
                    echo('<br/><br/>');

                    echo('<label class="formLabels">Prénom et nom sur votre carte bancaire :</label>');
                    echo('<input type="text" class="paiementChamps" name="namesCB" required/>');
                    echo('<br/><br/>');

                    echo('<label class="formLabels">Date d\'expiration :</label>');
                    echo('<input type="text" class="paiementChamps" name="expiration" maxlength="4" required/>');
                    echo('<br/><br/>');

                    echo('<label class="formLabels">Cryptogramme :</label>');
                    echo('<input type="text" class="paiementChamps" name="cryptogramme" maxlength="3" required/>');
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
 
            if($_SESSION['moyenPaiement'] == 'cryptomonnaie') {

                echo('<form method="post" class="formPaiement" action="traitPaiement.php">');

                    echo('<br/>');
                    echo('<div id="littleTitleFrame"><h2 id="formTitle">Cryptomonnaie</h2></div>');

                    if(isset($_GET['msgErreur'])){
                        echo("<h3 class='errorDatabase'>".$_GET['msgErreur']."</h3>");
                    } else {
                        echo("<h3 class='errorDatabase'>Veuillez compléter ces informations</h3>");
                    }

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