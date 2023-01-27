<!DOCTYPE html>
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="./include/styles.css"/>
    <title>Demande de collaboration</title>
</head>
<body> 
    <?php include("./include/header.php"); ?>

    <form method="post" id="formCollaboration" action="traitCollaboration.php">

        <h2 class="infosTitle">Demande de collaboration</h2>

        <hr>

        <?php

            if(isset($_GET['msgErreur'])) {
                echo("<h3 id='errorCollaboration'>".$_GET['msgErreur']."</h3>");
            }

        ?>

        <div id="gridCollaboration">
            <label class="formLabels labelsCollab">Prénom</label>
            <input type="text" class="champsForm champsCollab" name="prenom" required minlength="2"/>

            <label class="formLabels labelsCollab">Nom</label>
            <input type="text" class="champsForm champsCollab" name="nom" required minlength="2"/>

            <label class="formLabels labelsCollab">Adresse mail</label>
            <input type="mail" class="champsForm champsCollab" name="adresseMail" required minlength="5"/>

            <label class="formLabels labelsCollab">Numéro de téléphone</label>
            <input type="text" class="champsForm champsCollab" name="telephone" required maxlength="10"/>

            <label class="formLabels labelsCollab">Présentation</label>
            <textarea class="champsForm" id="zoneCollab" name="Presentation" required maxlength="400"></textarea>
        </div>

        <div id="zoneBtnCollab">
            <input type="submit" name="Envoyer" value="Envoyer" id="btnCollaboration"/>
        </div>

    </form>

    <?php include("./include/footer.php"); ?>
</body>
</html>