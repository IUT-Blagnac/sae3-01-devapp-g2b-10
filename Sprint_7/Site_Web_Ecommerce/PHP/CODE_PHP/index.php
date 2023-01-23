<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8"/>
    <link rel="stylesheet" href="./include/styles.css"/>
    <link rel="stylesheet" href="https://unpkg.com/boxicons@2.1.2/css/boxicons.min.css"/>
    <link rel="icon" href="./include/images/artichaude.jpg"/>
	<title>Art'i'Chaude</title>
    <script src="script.js" defer></script>
</head>
<body>
    <?php session_start(); ?>
    <?php require_once("connect.inc.php"); ?>
	<?php include("./include/header.php"); ?>

    <?php

    $requete = "SELECT NOMARTICLE,IDARTICLE,PRIXPROMO FROM ARTICLE WHERE IDARTICLE=15 OR IDARTICLE=2 OR IDARTICLE=12 OR IDARTICLE=3";
    $req1 = oci_parse($connect, $requete);
    $result= oci_execute($req1);
    
        if(isset($_SESSION['langue']) && $_SESSION['langue'] == 'EN') {

            echo("<div id='indexContainer'>");

                echo("<h2 class='titleArticles'>The promotions of the moment !</h2>");
                echo("<div id='gridIndex'>");
                
                while (($produit = oci_fetch_assoc($req1))!= false) { 
                
                    echo('<div class="containerIndex" style="cursor: pointer;" onclick="location.href=\'produit.php?id='.$produit['IDARTICLE'].'\'">');
                        echo('<div class="promo-circle"><b>-'.$produit['PRIXPROMO'].'%</b></div>');   
                        echo("<img class='imageArticle' src='include/images/imagesArticles/".$produit['IDARTICLE'].".png'>");
                        echo("<br/>");
                        echo('<p class="articleText">'.$produit['NOMARTICLE'].'</p>');
                    echo("</div>");
                    
                }
                
                echo("</div>");
            echo("</div>");      
        
            echo('<div id="cookieContainer">');
                echo('<div id="cookieTitle">');
                    echo('<i class="bx bx-cookie"></i>');
                    echo('<h2>Cookie consent</h2>');
                echo('</div>');

                echo('<div id="dataCookie">');
                    echo('<p>This website uses cookies to help you have a superior and more relevant website experience.</p>');
                    echo('<p><a href="cookies.php">Read more...</a></p>');
                echo('</div>');

                echo('<div id="buttonsContainer">');
                    echo('<button class="buttonCookie" id="acceptBtn">Accept</button>');
                    echo('<button class="buttonCookie" id="declineBtn">Decline</button>');
                echo('</div>');
            echo('</div>');

        } else {

            echo("<div id='indexContainer'>");

                echo("<h2 class='titleArticles'>Les promos du moment !</h2>");
                echo("<div id='gridIndex'>");
                
                while (($produit = oci_fetch_assoc($req1))!= false) { 
                
                    echo('<div class="containerIndex" style="cursor: pointer;" onclick="location.href=\'produit.php?id='.$produit['IDARTICLE'].'\'">');
                        echo('<div class="promo-circle"><b>-'.$produit['PRIXPROMO'].'%</b></div>');   
                        echo("<img class='imageArticle' src='include/images/imagesArticles/".$produit['IDARTICLE'].".png'>");
                        echo("<br/>");
                        echo('<p class="articleText">'.$produit['NOMARTICLE'].'</p>');
                    echo("</div>");
                    
                }
                
                echo("</div>");
            echo("</div>");      
        
            echo('<div id="cookieContainer">');
                echo('<div id="cookieTitle">');
                    echo('<i class="bx bx-cookie"></i>');
                    echo('<h2>Consentement aux cookies</h2>');
                echo('</div>');

                echo('<div id="dataCookie">');
                    echo('<p>Ce site web utilise des cookies pour vous aider à avoir une expérience de navigation supérieure et plus pertinente sur le site web.</p>');
                    echo('<p><a href="cookies.php">En savoir plus...</a></p>');
                echo('</div>');

                echo('<div id="buttonsContainer">');
                    echo('<button class="buttonCookie" id="acceptBtn">Accepter</button>');
                    echo('<button class="buttonCookie" id="declineBtn">Décliner</button>');
                echo('</div>');
            echo('</div>');

        }

    ?>
    
	<?php include("./include/footer.php"); ?>
</body>
</html>