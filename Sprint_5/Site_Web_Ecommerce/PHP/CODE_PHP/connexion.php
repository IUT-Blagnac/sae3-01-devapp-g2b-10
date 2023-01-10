<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8"/>
    <link rel="stylesheet" href="./include/styles.css"/>
	<title>Connexion</title>
</head>
<body>
	<?php include("./include/header.php");

        session_start();

        if(isset($_COOKIE['cookIdentifiant'])) {
            $login = $_COOKIE['cookIdentifiant'];
        } else {
            $login = "";
        }

        if(isset($_SESSION['utilisateur'])) {

            echo('<div id="userConnected">');
                echo('<div id="gridContainer">');
                    echo('<div>');
                        echo('<div id="circle">');

                            echo('<img id="whiteUser" src="./include/images/user.png" alt="white-user" />');

                        echo('</div>');
                    echo('</div>');
                    echo('<div>');

                        echo('<div id="userTitleFrame"><h1 id="userTitle">Bonjour '.$_SESSION['prenom'].' !</h1></div>');
                        echo('<p id="statusUser">Vous êtes connecté.e en tant que "'.$_SESSION['utilisateur'].'".</p>');

                        echo('<div id=""infosUser">');
                            echo('<div id="paddingTexts">');

                                echo('<h3>&#10095; &#10095; &#10095; &#8205; &#8205; Vos points : <strong>0</strong> </h3>');
                                echo('<hr>');
                                echo('<h2>Modifier vos informations &#8205; &#x27A4;</h2>');
                                echo('<h2>Modifier votre mot de passe &#8205; &#x27A4;</h2>');
                                echo('<h2>Historique des commandes &#8205; &#x27A4;</h2>');
                                echo('<br/>');

                                echo('<form method="POST" action="deconnexion.php">');
                                    echo('<input id="deconnexion" type="submit" name="Deconnexion" value="Deconnexion"/>');
                                echo('</form>');

                            echo('</div>');
                        echo('</div>');
                    echo('</div>');               
                echo('</div>');
            echo('</div>');

        } else {

            echo('<form method="post" id="formConnexion" action="traitConnexion.php">');
        
                echo('<div id="titleFrame"><h1 id="formTitle">S\'identifier :</h1></div>');

                if(isset($_GET['msgErreur'])) {
                    echo("<h3 class='errorDatabase'>".$_GET['msgErreur']."</h3>");
                } else {
                    echo("<h3 class='errorDatabase'>Veuillez entrer les identifiants pour accéder aux données</h3>");
                }

                echo('<label class="formLabels">Entrez votre adresse mail :</label>');
                echo("<input type='mail' class='champsForm' name='adresseMail' value='$login' required/>");
                echo('<br/><br/>');

                echo('<label class="formLabels">Entrez votre mot de passe :</label>');
                echo('<input type="password" class="champsForm" name="motDePasse" required/>');
                echo('<br/><br/>');

                if(isset($_COOKIE['cookieFrom'])) {

                    echo('<label class="formLabels">Se souvenir de moi ?</label>');
                    echo('<label id="checkboxLabel">');
                    echo('<input type="checkbox" id="checkboxInput" name="memo"/>');
                    echo('<svg id="checkboxCheck">');
                    echo('<polyline points="20 6 9 17 4 12"></polyline>');
                    echo('</svg>');
                    echo('</label>');
                    echo('<br/><br/>');

                }

                echo('<input type="submit" name="Connexion" value="Connexion" id="btnConnexion"/>');

                echo('<a id="linkToInscription" href="#"><p>Pas de compte ? Inscrivez-vous !</p></a>');

            echo('</form>');

        }

    ?>

	<?php include("./include/footer.php"); ?>
</body>
</html>