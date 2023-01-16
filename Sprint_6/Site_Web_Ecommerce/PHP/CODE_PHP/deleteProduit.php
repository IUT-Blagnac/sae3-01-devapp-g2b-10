<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="./include/styles.css"/>
    <link rel="icon" href="./include/images/artichaude.jpg"/>
    <title>Retrait d'un produit</title>
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

        echo('<form method="post" id="formModification" action="traitDeleteProduit.php">');

            echo("<div id='titleFrame'><h1 id='formTitle'>Retrait d'un produit</h1></div>");

            echo("<h3 class='errorDatabase'>Veuillez choisir un produit à retirer</h3>");

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

            echo('<input type="submit" name="Retirer" value="Retirer" id="btnModification"/>');

        echo('</form>');

    }

    ?>

    <?php include("./include/footer.php"); ?>
 
</body>
</html>