<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8"/>
    <link rel="stylesheet" href="./include/styles.css"/>
    <link rel="stylesheet" href="https://unpkg.com/boxicons@2.1.2/css/boxicons.min.css"/>
	<title>Art'i'Chaude</title>
    <script src="script.js" defer></script>
</head>
<body>
	<?php include("./include/header.php"); ?>
     
    <div class="infosContainer">

        <h2 class="text">Les promos du moments !</h2>

        <div id="gridMembers">

            <div class="promoIndex">
                <img id="alignImage" src="./include/images/figurines/article1.jpg"/>
                
            </div>

            <div class="promoIndex">
                <img id="alignImage" src="./include/images/figurines/article1.jpg" />
            </div>

            <div class="promoIndex">
                <img src="./include/images/figurines/article1.jpg" />
            </div>

            <div class="promoIndex">
                <img src="./include/images/figurines/article1.jpg" />
            </div>

        </div>

    </div>

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