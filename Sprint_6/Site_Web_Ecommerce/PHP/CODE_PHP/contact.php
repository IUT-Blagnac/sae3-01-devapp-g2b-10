<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8"/>
    <link rel="stylesheet" href="./include/styles.css"/>
    <link rel="icon" href="./include/images/artichaude.jpg"/>
	<title>Nous contacter</title>
</head>
<body>
    <?php include("./include/header.php"); ?>

        <form method="post" id="formContact" action="traitContact.php">

            <h1 id="contactTitle">Votre message</h1>

            <?php

                if(isset($_GET['msgErreur'])) {
                    echo("<h3 id='errorContact'>".$_GET['msgErreur']."</h3>");
                }

            ?>

            <div id="gridContact">
                <label class="contactLabels">Adresse mail</label>
                <input type="email" class="champsContact" name="adresseMail" required minlength="5"/>

                <label class="contactLabels">Objet</label>
                <input type="text" class="champsContact" name="objet" required minlength="2"/>

                <label class="contactLabels">Message</label>
                <textarea id="lastChamp" name="Commentaire" required maxlength="400"></textarea>
            </div>

            <div id="sendForm">
                <img src='./include/images/send.png' alt='send_mail'/>
                <input type="submit" name="Envoi" value="Envoyer" id="btnEnvoi"/>
            </div>

        </form>

    <?php include("./include/footer.php"); ?>
</body>
</html>