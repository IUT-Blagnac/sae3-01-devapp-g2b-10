<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="./include/styles.css"/>
    <link rel="icon" href="./include/images/artichaude.jpg"/>
    <title>Modification d'un produit</title>
</head>
<body>
    <?php include("./include/header.php"); ?>
    <?php include('connect.inc.php'); 

    session_start();

    if(!isset($_SESSION['utilisateur'])) {

        header('Location: ./index.php');
        exit;

    } else if($_SESSION['utilisateur'] != 'Admin') {  

        header('Location: ./index.php');
        exit;

    } else {

        echo('<form method="post" id="formModification" action="traitUpdateProduit.php">');

            echo("<div id='titleFrame'><h1 id='formTitle'>Modifier un produit</h1></div>");

            if(isset($_GET['msgErreur'])){
                echo("<h3 class='errorDatabase'>".$_GET['msgErreur']."</h3>");
            } else {
                echo("<h3 class='errorDatabase'>Veuillez compléter ces informations</h3>");
            }

            echo('<label class="formLabels">Votre produit :</label>');
            echo("<select name='nomArticle' id='selectThemes'>");

                $req = "SELECT IDARTICLE, NOMARTICLE FROM ARTICLE";
                $articlesRecup = oci_parse($connect, $req);
                $result = oci_execute($articlesRecup);

                if (!$result) {
                    $e = oci_error($articlesRecup);  // on récupère l'exception liée au pb d'execution de la requete (violation PK par exemple)
                    $errorSQL = print htmlentities($e['message'].' pour cette requete : '.$e['sqltext']);
                    header("Location: ./updateProduit.php=?msgErreur=$errorSQL");
                    exit;
                } else {
                    while(($nomArticles = oci_fetch_assoc($articlesRecup)) != false) {
                        echo("<option class='optionArticles' value='".$nomArticles['IDARTICLE']."'>".$nomArticles['NOMARTICLE']."</option>");
                    }
                }

            echo("</select>");
            echo('<br/><br/>');

            echo('<label class="formLabels">Nouveau nom de produit :</label>');
            echo("<input type='text' class='modifChamps' name='nomProduit' required/>");
            echo('<br/><br/>');

            echo('<label class="formLabels">Catégorie :</label>');
            echo("<select name='categorie' id='selectArticles'>");
                echo("<option class='optionArticles' value='FIGURINES'>Figurines</option>");
                echo("<option class='optionArticles' value='POSTERS'>Posters</option>");
                echo("<option class='optionArticles' value='PELUCHES'>Peluches</option>");
            echo("</select>");
            echo('<br/><br/>');   

            echo("<label class='formLabels'>Nouveau prix de produit :</label>");
            echo('<input type="number" class="modifChamps" name="prixProduit" step="0.01" min="0.01" maxlength="8" required>');
            echo('<br/><br/>');

            echo("<label class='formLabels'>Nouveau prix promo de produit :</label>");
            echo('<input type="number" class="modifChamps" name="prixPromoProduit" step="1" min="0" maxlength="2" required>');
            echo('<br/>');

            echo("<p class='errorDatabase'>Non fonctionnel</p>");
            echo('<label id="blockFormLabel">Image du produit :</label>');
            echo('<input type="file" id="unmodifChamp" name="monImage" disabled/>');
            echo('<br/><br/>');

            echo('<label class="formLabels">Nouvelle description :</label>');
            echo("<textarea type='text' class='champsForm' id='zoneCollab' name='descProduit' required/>");
            echo('</textarea>');

            echo('<br/><br/>');

            echo('<input type="submit" name="Sauvegarder" value="Sauvegarder" id="btnModification"/>');

        echo('</form>');

    }

    ?>

    <?php include("./include/footer.php"); ?>

</body>
</html>