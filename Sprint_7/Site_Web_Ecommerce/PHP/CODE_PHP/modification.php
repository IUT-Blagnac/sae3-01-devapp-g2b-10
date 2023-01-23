<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="./include/styles.css"/>
    <link rel="icon" href="./include/images/artichaude.jpg"/>
    <title>Modification</title>
</head>
<body>
    <?php session_start(); ?>
    <?php include("./include/header.php"); 

    if(isset($_SESSION['langue']) && $_SESSION['langue'] == 'EN') {

        if(!isset($_SESSION['utilisateur'])) {

            header('Location: ./index.php');
            exit;
    
        } else {  
    
            echo("<form method='post' id='formModification' action='traitModification.php'>");
    
                echo("<div id='titleFrame'><h1 id='formTitle'>Modify your information</h1></div>");
    
                if(isset($_GET['msgErreur'])){
                    echo("<h3 class='errorDatabase'>".$_GET['msgErreur']."</h3>");
                } else {
                    echo("<h3 class='errorDatabase'>Please complete these informations</h3>");
                }
    
                $fr = '';
                $en = '';
                $euros = '';
                $dollars = '';
                $light = '';
                $dark = '';

                if($_SESSION['langue'] == 'EN') {
                    $en = 'selected';
                } else {
                    $fr = 'selected';
                }

                if($_SESSION['theme'] == 'CLAIR ') {
                    $light = 'selected';
                } else {
                    $dark = 'selected';
                }

                if($_SESSION['monnaie'] == 'EUR ') {
                    $euros = 'selected';
                } else {
                    $dollars = 'selected';
                }
    
                echo('<label class="formLabels">Choose your language :</label>');
                echo("<select name='langues' id='selectLangues'>");
                    echo("<option class='optionLangues' value='FR' ".$fr.">Français</option>");
                    echo("<option class='optionLangues' value='EN' ".$en.">English</option>");
                echo("</select>");
                echo('<br/>');
    
                echo('<label class="formLabels">Enter your first name :</label>');
                echo("<input type='text' class='modifChamps' name='prenom' value='".$_SESSION['prenom']."' required/>");
                echo('<br/><br/>');
    
                echo('<label class="formLabels">Enter your name :</label>');
                echo("<input type='text' class='modifChamps' name='nom' value='".$_SESSION['nom']."' required/>");
                echo('<br/><br/>');
    
                echo('<label class="formLabels">Enter your address :</label>');
                echo("<input type='text' class='modifChamps' name='adresse' value='".$_SESSION['adresse']."' required/>");
                echo('<br/><br/>');
    
                echo('<label class="formLabels">Enter your email :</label>');
                echo("<input type='email' class='modifChamps' name='adresseMail' value='".$_SESSION['mail']."' required/>");
                echo('<br/><br/>');
    
                echo("<label class='formLabels'>Choose your theme :</label>");
                echo("<select name='theme' id='selectThemes'>");
                    echo("<option class='optionThemes' value='CLAIR' ".$light.">Light</option>");
                    echo("<option class='optionThemes' value='SOMBRE' ".$dark.">Dark</option>");
                echo("</select>");
                echo('<br/>');
    
                echo('<label class="formLabels">Choose your currency :</label>');
                echo("<select name='monnaie' id='selectMonnaies'>");
                    echo("<option class='optionMonnaies' value='EUR' ".$euros.">Euros (€)</option>");
                    echo("<option class='optionMonnaies' value='USD' ".$dollars.">Dollars ($)</option>");
                echo("</select>");
                echo('<br/>');
    
                echo('<hr id="delimiteurForm">');
    
                echo("<div id='littleTitleFrame'><h3 id='formTitle'>Password change</h3></div>");
    
                echo('<label id="blockFormLabel">Your old password :</label>');
                echo("<input type='password' id='unmodifChamp' name='oldmdp' value='".$_SESSION['mdp']."' disabled/>");
                echo('<br/><br/>');
    
                echo('<label class="formLabels">Enter your new password :</label>');
                echo("<input type='password' class='modifChamps' name='motdepasse' required/>");
                echo('<br/><br/>');
    
                echo('<label id="confirmLabel">Confirm your password :</label>');
                echo("<input type='password' id='confirmChamp' name='confmdp' required/>");
                echo('<br/><br/>');
    
                echo('<input type="submit" name="Sauvegarder" value="Save" id="btnModification"/>');
    
            echo("</form>");            
    
        }

    } else {

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
    
                $fr = '';
                $en = '';
                $euros = '';
                $dollars = '';
                $light = '';
                $dark = '';
    
                if(isset($_SESSION['langue']) && $_SESSION['langue'] == 'EN') {
                    $en = 'selected';
                } else {
                    $fr = 'selected';
                }

                if(isset($_SESSION['theme']) && $_SESSION['theme'] == 'CLAIR') {
                    $light = 'selected';
                } else {
                    $dark = 'selected';
                }

                if(isset($_SESSION['monnaie']) && $_SESSION['monnaie'] == 'EUR') {
                    $euros = 'selected';
                } else {
                    $dollars = 'selected';
                }
    
                echo('<label class="formLabels">Choisissez votre langue :</label>');
                echo("<select name='langues' id='selectLangues'>");
                    echo("<option class='optionLangues' value='FR' ".$fr.">Français</option>");
                    echo("<option class='optionLangues' value='EN' ".$en.">English</option>");
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
                    echo("<option class='optionThemes' value='CLAIR' ".$light.">Clair</option>");
                    echo("<option class='optionThemes' value='SOMBRE' ".$dark.">Sombre</option>");
                echo("</select>");
                echo('<br/>');
    
                echo('<label class="formLabels">Choisissez votre monnaie :</label>');
                echo("<select name='monnaie' id='selectMonnaies'>");
                    echo("<option class='optionMonnaies' value='EUR' ".$euros.">Euros (€)</option>");
                    echo("<option class='optionMonnaies' value='USD' ".$dollars.">Dollars ($)</option>");
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

    }

    ?>

    <?php include("./include/footer.php"); ?>
</body>
</html>