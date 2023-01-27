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

                echo('<h2 class="infosTitle">Our team</h2>');

                echo('<hr>');

                echo('<div id="gridMembers">');

                    echo('<div class="memberInfo">');
                        echo('<img src="./include/images/member1.png" alt="jessiefaim"/>');
                        echo('<p><b>Name :</b> Jessie Faim <br/>');
                        echo('<b>Role :</b> Responsible for happiness <br/>');
                        echo('<b>Quote :</b> <i>"Life, pasta, all that..."</i></p>');
                    echo('</div>');

                    echo('<div class="memberInfo">');
                        echo('<img id="alignImage" src="./include/images/member2.png" alt="nicolasvion"/>');
                        echo('<p><b>Name :</b> Nicolas Vion <br/>');
                        echo('<b>Role :</b> Community Manager <br/>');
                        echo('<b>Quote :</b> <i>"A people that does not know its past, its origins and its culture is like a conifer without roots."</i></p>');
                    echo('</div>');

                    echo('<div class="memberInfo">');
                        echo('<img src="./include/images/member3.png" alt="jeanbombeur"/>');
                        echo('<p><b>Name :</b> Jean Bombeur <br/>');
                        echo('<b>Role :</b> CEO <br/>');
                        echo('<b>Quote :</b> <i>"Art\'i\'Chaud-e is the art of tomorrow available today."</i></p>');
                    echo('</div>');

                    echo('<div class="memberInfo">');
                        echo('<img src="./include/images/member4.png" alt="renedececendres"/>');
                        echo('<p><b>Name :</b> René De Cécendres <br/>');
                        echo('<b>Role :</b> Responsible for the coffee machine <br/>');
                        echo('<b>Quote :</b> <i>"It is not the man who takes coffee, it is the coffee that takes the man."</i></p>');
                    echo('</div>');

                echo('</div>');

            } else {

                echo('<h2 class="infosTitle">Notre équipe</h2>');

                echo('<hr>');

                echo('<div id="gridMembers">');

                    echo('<div class="memberInfo">');
                        echo('<img src="./include/images/member1.png" alt="jessiefaim"/>');
                        echo('<p><b>Nom :</b> Jessie Faim <br/>');
                        echo('<b>Rôle :</b> Responsable du bonheur <br/>');
                        echo('<b>Citation :</b> <i>"La vie, les pates, tout ça quoi..."</i></p>');
                    echo('</div>');

                    echo('<div class="memberInfo">');
                        echo('<img id="alignImage" src="./include/images/member2.png" alt="nicolasvion"/>');
                        echo('<p><b>Nom :</b> Nicolas Vion <br/>');
                        echo('<b>Rôle :</b> Community Manager <br/>');
                        echo('<b>Citation :</b> <i>"Un peuple qui ne connaît pas son passé, ses origines et sa culture ressemble à un conifère sans racines."</i></p>');
                    echo('</div>');

                    echo('<div class="memberInfo">');
                        echo('<img src="./include/images/member3.png" alt="jeanbombeur"/>');
                        echo('<p><b>Nom :</b> Jean Bombeur <br/>');
                        echo('<b>Rôle :</b> PDG <br/>');
                        echo('<b>Citation :</b> <i>"Art\'i\'Chaud·e c’est l’art de demain disponible aujourd’hui."</i></p>');
                    echo('</div>');

                    echo('<div class="memberInfo">');
                        echo('<img src="./include/images/member4.png" alt="renedececendres"/>');
                        echo('<p><b>Nom :</b> René De Cécendres <br/>');
                        echo('<b>Rôle :</b> Responsable de la machine à café <br/>');
                        echo('<b>Citation :</b> <i>"C’est pas l’homme qui prends du café, c’est le café qui prends l’homme."</i></p>');
                    echo('</div>');

                echo('</div>');

            }

        echo('</div>');

    ?>

    <?php include("./include/footer.php"); ?>
</body>
</html>