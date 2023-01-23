<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8"/>
    <link rel="stylesheet" href="./include/styles.css"/>
    <link rel="icon" href="./include/images/artichaude.jpg"/>
	<title>Nous contacter</title>
</head>
<body>
    <?php session_start(); ?>
    <?php include("./include/header.php"); ?>

    <?php

        echo('<form method="post" id="formContact" action="traitContact.php">');

            if(isset($_SESSION['langue']) && $_SESSION['langue'] == 'EN') {

                echo('<h1 id="contactTitle">Your message</h1>');

                if(isset($_GET['msgErreur'])) {
                    echo("<h3 id='errorContact'>".$_GET['msgErreur']."</h3>");
                }

                echo('<div id="gridContact">');
                    echo('<label class="contactLabels">Email address</label>');
                    echo('<input type="email" class="champsContact" name="adresseMail" required minlength="5"/>');

                    echo('<label class="contactLabels">Subject</label>');
                    echo('<input type="text" class="champsContact" name="objet" required minlength="2"/>');

                    echo('<label class="contactLabels">Message</label>');
                    echo('<textarea id="lastChamp" name="Commentaire" required maxlength="400"></textarea>');
                echo('</div>');

                echo('<div id="sendForm">');
                    echo("<img src='./include/images/send.png' alt='send_mail'/>");
                    echo('<input type="submit" name="Envoi" value="Submit" id="btnEnvoi"/>');
                echo('</div>');

            } else {

                echo('<h1 id="contactTitle">Votre message</h1>');

                if(isset($_GET['msgErreur'])) {
                    echo("<h3 id='errorContact'>".$_GET['msgErreur']."</h3>");
                }

                echo('<div id="gridContact">');
                    echo('<label class="contactLabels">Adresse mail</label>');
                    echo('<input type="email" class="champsContact" name="adresseMail" required minlength="5"/>');

                    echo('<label class="contactLabels">Objet</label>');
                    echo('<input type="text" class="champsContact" name="objet" required minlength="2"/>');

                    echo('<label class="contactLabels">Message</label>');
                    echo('<textarea id="lastChamp" name="Commentaire" required maxlength="400"></textarea>');
                echo('</div>');

                echo('<div id="sendForm">');
                    echo("<img src='./include/images/send.png' alt='send_mail'/>");
                    echo('<input type="submit" name="Envoi" value="Envoyer" id="btnEnvoi"/>');
                echo('</div>');

            }

        echo('</form>');

    ?>

    <?php include("./include/footer.php"); ?>
</body>
</html>