<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="./include/styles.css"/>
    <link rel="icon" href="./include/images/artichaude.jpg"/>
    <title>Inscription</title>
</head>
<body>
    <?php session_start(); ?>
    <?php include("./include/header.php"); 

    if(isset($_SESSION['utilisateur'])) {

        header('Location: ./index.php');
        exit;

    } else {

        echo('<form method="post" id="formInscription" action="traitInscription.php">');

            echo('<div id="titleFrame"><h1 id="formTitle">S\'inscrire :</h1></div>');

            if(isset($_GET['msgErreur'])){
                echo("<h3 class='errorDatabase'>".$_GET['msgErreur']."</h3>");
            }

            echo('<label class="formLabels">Choisissez votre langue :</label>');
            echo("<select name='langues' id='selectLangues'>");
                echo("<option class='optionLangues' value='FR'>Français</option>");
                echo("<option class='optionLangues' value='EN'>English</option>");
            echo("</select>");
            echo('<br/>');

            echo('<label class="formLabels">Entrez votre prénom :</label>');
            echo("<input type='text' class='inscChamps' name='prenom' required/>");
            echo('<br/><br/>');

            echo('<label class="formLabels">Entrez votre nom :</label>');
            echo("<input type='text' class='inscChamps' name='nom' required/>");
            echo('<br/><br/>');

            echo('<label class="formLabels">Entrez votre adresse :</label>');
            echo("<input type='text' class='inscChamps' name='adresse' required/>");
            echo('<br/><br/>');

            echo('<label class="formLabels">Entrez votre mail :</label>');
            echo("<input type='email' class='inscChamps' name='adresseMail' required/>");
            echo('<br/><br/>');

            echo('<label class="formLabels">Entrez votre mot de passe :</label>');
            echo("<input type='password' class='inscChamps' name='motdepasse' required/>");
            echo('<br/><br/>');

            echo('<label id="confirmLabel">Confirmez votre mot de passe :</label>');
            echo("<input type='password' id='confirmChamp' name='confmdp' required/>");
            echo('<br/><br/>');

            echo('<input type="submit" name="Inscription" value="Inscription" id="btnInscription"/>');

        echo('</form>');    

    }

    ?>

    <?php include("./include/footer.php"); ?>
</body>
</html>