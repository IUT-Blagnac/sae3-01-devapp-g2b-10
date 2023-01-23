<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8"/>
    <link rel="stylesheet" href="./include/styles.css"/>
    <link rel="icon" href="./include/images/artichaude.jpg"/>
	<title>Connexion</title>
</head>
<body>
    <?php session_start(); ?>
	<?php include("./include/header.php");

    if(isset($_COOKIE['cookIdentifiant'])) {
        $login = $_COOKIE['cookIdentifiant'];
    } else {
        $login = "";
    }

    if(isset($_SESSION['langue']) && $_SESSION['langue'] == 'EN') {

        if(isset($_SESSION['utilisateur'])) {

            echo('<div id="userConnected">');
                echo('<div id="gridContainer">');
                    
                        echo('<div id="circle">');
    
                            echo('<img id="whiteUser" src="./include/images/user.png" alt="white-user" />');
    
                        echo('</div>');
                    
                    echo('<div>');
    
                        echo('<div id="userTitleFrame"><h1 id="userTitle">Hello '.$_SESSION['prenom'].' !</h1></div>');
                        echo('<p id="statusUser">You are logged in as "'.$_SESSION['utilisateur'].'".</p>');
    
                        echo('<div id="infosUser">');
                            echo('<div id="paddingTexts">');
    
                                echo('<h3>&#10095; &#10095; &#10095; &#8205; &#8205; Your points : <strong>'.$_SESSION['ptsfidelite'].'</strong> </h3>');
                                echo('<hr>');
                                echo('<a class="liensUtilisateur" href="modification.php"><h2>Modify your information &#8205; &#x27A4;</h2></a>');
                                if($_SESSION['utilisateur'] == 'Client') {
                                    echo('<a class="liensUtilisateur" href="commandes.php"><h2>My orders &#8205; &#x27A4;</h2></a>');
                                }
                                if($_SESSION['utilisateur'] == 'Artiste') {
                                    echo('<a class="liensUtilisateur"  href="commandes.php"><h2>My orders &#8205; &#x27A4;</h2></a>');
                                    echo('<a class="liensUtilisateur" href="addProduit.php"><h2>Add a new product &#8205; &#x27A4;</h2></a>');
                                    echo('<a class="liensUtilisateur" href="addCouleur.php"><h2>Add a new color &#8205; &#x27A4;</h2></a>');
                                }
                                if($_SESSION['utilisateur'] == 'Admin') {
                                    echo('<a class="liensUtilisateur" href="updateProduit.php"><h2>Edit a product &#8205; &#x27A4;</h2></a>');
                                    echo('<a class="liensUtilisateur" href="deleteProduit.php"><h2>Remove a product &#8205; &#x27A4;</h2></a>');
                                    echo('<a class="liensUtilisateur" href="deleteCouleur.php"><h2>Remove a color &#8205; &#x27A4;</h2></a>');
                                }
                                echo('<br/>');
    
                                echo('<div id="btnsProfil">');
    
                                    echo('<form method="POST" action="deconnexion.php">');
                                        echo('<input id="deconnexion" type="submit" name="Deconnexion" value="Disconnect"/>');
                                    echo('</form>');
    
                                    echo('<form method="POST" action="suppression.php?pIdActeur='.$_SESSION['id'].'">');
                                        echo('<input onclick="return confirm(\'Are you sure you want to delete this account ?\')" id="suppression" type="submit" name="Supprimer" value="Delete"/>');
                                    echo('</form>');
    
                                echo('</div>');
    
                            echo('</div>');
                        echo('</div>');
                    echo('</div>');               
                echo('</div>');
            echo('</div>');
    
        } else {
    
            echo('<form method="post" id="formConnexion" action="traitConnexion.php">');
        
                echo('<div id="titleFrame"><h1 id="formTitle">Identify yourself :</h1></div>');
    
                if(isset($_GET['msgErreur'])) {
                    echo("<h3 class='errorDatabase'>".$_GET['msgErreur']."</h3>");
                } else {
                    echo("<h3 class='errorDatabase'>Please enter the login details to access the data</h3>");
                }
    
                echo('<label class="formLabels">Enter your email address :</label>');
                echo("<input type='email' class='champsForm' name='adresseMail' value='$login' required/>");
                echo('<br/><br/>');
    
                echo('<label class="formLabels">Enter your password :</label>');
                echo('<input type="password" class="champsForm" name="motDePasse" required/>');
                echo('<br/><br/>');
    
                if(isset($_COOKIE['cookieFrom'])) {
    
                    echo('<label class="formLabels">Remember me ?</label>');
                    echo('<label id="checkboxLabel">');
                    echo('<input type="checkbox" id="checkboxInput" name="memo"/>');
                    echo('<svg id="checkboxCheck">');
                    echo('<polyline points="20 6 9 17 4 12"></polyline>');
                    echo('</svg>');
                    echo('</label>');
                    echo('<br/><br/>');
    
                }
    
                echo('<input type="submit" name="Connexion" value="Login" id="btnConnexion"/>');
    
                echo('<a id="linkToInscription" href="inscription.php"><p>No account? Sign up now !</p></a>');
    
            echo('</form>');
    
        }

    } else {

        if(isset($_SESSION['utilisateur'])) {

            echo('<div id="userConnected">');
                echo('<div id="gridContainer">');
                    
                        echo('<div id="circle">');
    
                            echo('<img id="whiteUser" src="./include/images/user.png" alt="white-user" />');
    
                        echo('</div>');
                    
                    echo('<div>');
    
                        echo('<div id="userTitleFrame"><h1 id="userTitle">Bonjour '.$_SESSION['prenom'].' !</h1></div>');
                        echo('<p id="statusUser">Vous êtes connecté.e en tant que "'.$_SESSION['utilisateur'].'".</p>');
    
                        echo('<div id="infosUser">');
                            echo('<div id="paddingTexts">');
    
                                echo('<h3>&#10095; &#10095; &#10095; &#8205; &#8205; Vos points : <strong>'.$_SESSION['ptsfidelite'].'</strong> </h3>');
                                echo('<hr>');
                                echo('<a class="liensUtilisateur" href="modification.php"><h2>Modifier vos informations &#8205; &#x27A4;</h2></a>');
                                if($_SESSION['utilisateur'] == 'Client') {
                                    echo('<a class="liensUtilisateur" href="commandes.php"><h2>Mes commandes &#8205; &#x27A4;</h2></a>');
                                }
                                if($_SESSION['utilisateur'] == 'Artiste') {
                                    echo('<a class="liensUtilisateur"  href="commandes.php"><h2>Mes commandes &#8205; &#x27A4;</h2></a>');
                                    echo('<a class="liensUtilisateur" href="addProduit.php"><h2>Ajouter un produit &#8205; &#x27A4;</h2></a>');
                                    echo('<a class="liensUtilisateur" href="addCouleur.php"><h2>Ajouter une couleur &#8205; &#x27A4;</h2></a>');
                                }
                                if($_SESSION['utilisateur'] == 'Admin') {
                                    echo('<a class="liensUtilisateur" href="updateProduit.php"><h2>Modifier un produit &#8205; &#x27A4;</h2></a>');
                                    echo('<a class="liensUtilisateur" href="deleteProduit.php"><h2>Retirer un produit &#8205; &#x27A4;</h2></a>');
                                    echo('<a class="liensUtilisateur" href="deleteCouleur.php"><h2>Retirer une couleur &#8205; &#x27A4;</h2></a>');
                                }
                                echo('<br/>');
    
                                echo('<div id="btnsProfil">');
    
                                    echo('<form method="POST" action="deconnexion.php">');
                                        echo('<input id="deconnexion" type="submit" name="Deconnexion" value="Deconnexion"/>');
                                    echo('</form>');
    
                                    echo('<form method="POST" action="suppression.php?pIdActeur='.$_SESSION['id'].'">');
                                        echo('<input onclick="return confirm(\'Êtes-vous sûr de vouloir supprimer ce compte ?\')" id="suppression" type="submit" name="Supprimer" value="Supprimer"/>');
                                    echo('</form>');
    
                                echo('</div>');
    
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
                echo("<input type='email' class='champsForm' name='adresseMail' value='$login' required/>");
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
    
                echo('<a id="linkToInscription" href="inscription.php"><p>Pas de compte ? Inscrivez-vous !</p></a>');
    
            echo('</form>');
    
        }

    }

    ?>

	<?php include("./include/footer.php"); ?>
</body>
</html>