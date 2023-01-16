<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="./include/styles.css"/>
    <link rel="icon" href="./include/images/artichaude.jpg"/>
    <title>Modification</title>
</head>
<body>
    <?php include("./include/header.php"); 

    session_start();

    if(!isset($_SESSION['utilisateur'])) {

        header('Location: ./index.php');
        exit;

    } else {  

        echo("<form method='post' id='formModification' action='traitModification.php'>");

            echo("<div id='titleFrame'><h1 id='formTitle'>Modifier ses infos</h1></div>");

            if(isset($_GET['msgErreur'])){
                echo("<h3 class='errorDatabase'>".$_GET['msgErreur']."</h3>");
            } else {
                echo("<h3 class='errorDatabase'>Veuillez compléter ces informations</h3>");
            }

            echo('<label class="formLabels">Choisissez votre langue :</label>');
            echo("<select name='langues' id='selectLangues'>");
                echo("<option class='optionLangues' value='FR'>Français</option>");
                echo("<option class='optionLangues' value='EN'>English</option>");
            echo("</select>");
            echo('<br/>');

            echo('<label class="formLabels">Entrez votre prénom :</label>');
            echo("<input type='text' class='modifChamps' name='prenom' value='".$_SESSION['prenom']."' required/>");
            echo('<br/><br/>');

            echo('<label class="formLabels">Entrez votre nom :</label>');
            echo("<input type='text' class='modifChamps' name='nom' value='".$_SESSION['nom']."' required/>");
            echo('<br/><br/>');

            echo('<label class="formLabels">Entrez votre adresse :</label>');
            echo("<input type='text' class='modifChamps' name='adresse' value='".$_SESSION['adresse']."' required/>");
            echo('<br/><br/>');

            echo('<label class="formLabels">Entrez votre mail :</label>');
            echo("<input type='email' class='modifChamps' name='adresseMail' value='".$_SESSION['mail']."' required/>");
            echo('<br/><br/>');

            echo('<label class="formLabels">Choisissez votre thème :</label>');
            echo("<select name='theme' id='selectThemes'>");
                echo("<option class='optionThemes' value='CLAIR'>Clair</option>");
                echo("<option class='optionThemes' value='SOMBRE'>Sombre</option>");
            echo("</select>");
            echo('<br/>');

            echo('<label class="formLabels">Choisissez votre monnaie :</label>');
            echo("<select name='monnaie' id='selectMonnaies'>");
                echo("<option class='optionMonnaies' value='EUR'>Euros (€)</option>");
                echo("<option class='optionMonnaies' value='DOL'>Dollars ($)</option>");
            echo("</select>");
            echo('<br/>');

            echo('<hr id="delimiteurForm">');

            echo("<div id='littleTitleFrame'><h3 id='formTitle'>Changement de mot de passe</h3></div>");

            echo('<label id="blockFormLabel">Votre ancien mot de passe :</label>');
            echo("<input type='password' id='unmodifChamp' name='oldmdp' value='".$_SESSION['mdp']."' disabled/>");
            echo('<br/><br/>');

            echo('<label class="formLabels">Entrez votre nouveau mot de passe :</label>');
            echo("<input type='password' class='modifChamps' name='motdepasse' required/>");
            echo('<br/><br/>');

            echo('<label id="confirmLabel">Confirmez votre mot de passe :</label>');
            echo("<input type='password' id='confirmChamp' name='confmdp' required/>");
            echo('<br/><br/>');

            echo('<input type="submit" name="Sauvegarder" value="Sauvegarder" id="btnModification"/>');

        echo("</form>");            

    }

    ?>

    <?php include("./include/footer.php"); ?>
</body>
</html>