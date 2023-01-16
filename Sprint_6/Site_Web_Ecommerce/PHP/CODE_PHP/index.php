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
    <?php require_once("connect.inc.php"); ?>
	<?php include("./include/header.php"); ?>

    <?php   
        $requete = "SELECT NOMARTICLE,IDARTICLE FROM ARTICLE where IDARTICLE=15 OR IDARTICLE=2 OR IDARTICLE=12 OR IDARTICLE=3";
        $req1 = oci_parse($connect, $requete);
    
        $result= oci_execute($req1);
    
        echo("<div id='indexContainer'>");

            echo("<h2 class='titleArticles'>Les promos du moment !</h2>");
            echo("<div id='gridIndex'>");
               
            while (($produit = oci_fetch_assoc($req1))!= false) { 
                       
                echo('<div class="containerIndex" style="cursor: pointer;" onclick="location.href=\'produit.php?id='.$produit['IDARTICLE'].'\'">');

                    echo("<img class='imageArticle' src='include/images/imagesArticles/".$produit['NOMARTICLE'].".png'>");
                    echo("<br/>");
                    echo('<p class="articleText">'.$produit['NOMARTICLE'].'</p>');

                echo("</div>");
                
            }
            
            echo("</div>");
        echo("</div>");      
    ?>

    <div id="cookieContainer">
        <div id="cookieTitle">
            <i class="bx bx-cookie"></i>
            <h2>Consentement aux cookies</h2>
        </div>

        <div id="dataCookie">
            <p>Ce site web utilise des cookies pour vous aider à avoir une expérience de navigation supérieure et plus pertinente sur le site web.</p>
            <p><a href="cookies.php">En savoir plus...</a></p>
        </div>

        <div id="buttonsContainer">
            <button class="buttonCookie" id="acceptBtn">Accepter</button>
            <button class="buttonCookie" id="declineBtn">Décliner</button>
        </div>
    </div>
    
	<?php include("./include/footer.php"); ?>
</body>
</html>