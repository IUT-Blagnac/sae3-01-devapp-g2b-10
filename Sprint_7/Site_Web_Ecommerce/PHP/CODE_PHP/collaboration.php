<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="./include/styles.css"/>
    <link rel="icon" href="./include/images/artichaude.jpg"/>
    <title>Demande de collaboration</title>
</head>
<body> 
    <?php session_start(); ?>
    <?php include("./include/header.php"); ?>
    <?php

        echo('<form method="post" id="formCollaboration" action="traitCollaboration.php">');

            if(isset($_SESSION['langue']) && $_SESSION['langue'] == 'EN') {

                echo('<h2 id="collabTitle">Collaboration request</h2>');

                echo('<hr>');

                if(isset($_GET['msgErreur'])) {
                    echo("<h3 id='errorCollaboration'>".$_GET['msgErreur']."</h3>");
                }

                echo('<div id="gridCollaboration">');
                    echo('<label class="formLabels labelsCollab">First name</label>');
                    echo('<input type="text" class="champsForm champsCollab" name="prenom" required minlength="2"/>');

                    echo('<label class="formLabels labelsCollab">Name</label>');
                    echo('<input type="text" class="champsForm champsCollab" name="nom" required minlength="2"/>');

                    echo('<label class="formLabels labelsCollab">Email address</label>');
                    echo('<input type="email" class="champsForm champsCollab" name="adresseMail" required minlength="5"/>');

                    echo('<label class="formLabels labelsCollab">Phone number</label>');
                    echo('<input type="text" class="champsForm champsCollab" name="telephone" required maxlength="10"/>');

                    echo('<label class="formLabels labelsCollab">Introduction</label>');
                    echo('<textarea class="champsForm" id="zoneCollab" name="Presentation" required maxlength="400"></textarea>');
                echo('</div>');

                echo('<div id="zoneBtnCollab">');
                    echo('<input type="submit" name="Envoyer" value="Submit" id="btnCollaboration"/>');
                echo('</div>');

            } else {

                echo('<h2 id="collabTitle">Demande de collaboration</h2>');

                echo('<hr>');

                if(isset($_GET['msgErreur'])) {
                    echo("<h3 id='errorCollaboration'>".$_GET['msgErreur']."</h3>");
                }

                echo('<div id="gridCollaboration">');
                    echo('<label class="formLabels labelsCollab">Prénom</label>');
                    echo('<input type="text" class="champsForm champsCollab" name="prenom" required minlength="2"/>');

                    echo('<label class="formLabels labelsCollab">Nom</label>');
                    echo('<input type="text" class="champsForm champsCollab" name="nom" required minlength="2"/>');

                    echo('<label class="formLabels labelsCollab">Adresse mail</label>');
                    echo('<input type="email" class="champsForm champsCollab" name="adresseMail" required minlength="5"/>');

                    echo('<label class="formLabels labelsCollab">Numéro de téléphone</label>');
                    echo('<input type="text" class="champsForm champsCollab" name="telephone" required maxlength="10"/>');

                    echo('<label class="formLabels labelsCollab">Présentation</label>');
                    echo('<textarea class="champsForm" id="zoneCollab" name="Presentation" required maxlength="400"></textarea>');
                echo('</div>');

                echo('<div id="zoneBtnCollab">');
                    echo('<input type="submit" name="Envoyer" value="Envoyer" id="btnCollaboration"/>');
                echo('</div>');

            }

        echo('</form>');

    ?>

    <?php include("./include/footer.php"); ?>
</body>
</html>