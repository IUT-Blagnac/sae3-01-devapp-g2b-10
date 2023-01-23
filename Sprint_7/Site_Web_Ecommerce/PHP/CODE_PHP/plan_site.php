<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="./include/styles.css"/>
    <link rel="icon" href="./include/images/artichaude.jpg"/>
    <title>Équipe d'Art'i'Chaude</title>
</head>
<body>
    <?php session_start(); ?>
    <?php include("./include/header.php"); ?>

    <?php

        echo('<div class="infosContainer">');

            if(isset($_SESSION['langue']) && $_SESSION['langue'] == 'EN') {
                echo('<h2 class="infosTitle">Site plan</h2>');
            } else {
                echo('<h2 class="infosTitle">Plan du site</h2>');
            }

            echo('<hr>');
            echo('<img src="./include/images/plan_art\'i\'chaude.png" alt="plan-artichaude">');

        echo('</div>');

    ?>

    <?php include("./include/footer.php"); ?>
</body>
</html>