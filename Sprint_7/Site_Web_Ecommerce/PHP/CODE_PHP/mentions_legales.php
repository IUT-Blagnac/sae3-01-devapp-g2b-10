<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="./include/styles.css"/>
    <link rel="icon" href="./include/images/artichaude.jpg"/>
    <title>Mentions légales</title>
</head>
<body>
    <?php session_start(); ?>
    <?php include("./include/header.php"); ?>

    <?php

    echo('<div class="infosContainer">');

        if(isset($_SESSION['langue']) && $_SESSION['langue'] == 'EN') {

            echo('<h2 class="infosTitle">Terms of use</h2>');

            echo('<hr>');

            echo('<p>These terms and conditions set forth the terms and conditions for the use of the <a class="linkInfos" href="http://193.54.227.164/~SAESYS10/index.php">Art\'i\'Chaude</a> web service.</p>
            <p>The user acknowledges that he/she has read this document and accepts all of this information, whether the use is made on a personal or professional basis. <br/>
            If this use is made in a professional capacity, the user guarantees to have the necessary powers to accept these general conditions within his organization.</p>');

            echo('<h2>Editors and Publication Managers</h2>');

            echo('<p>This website is not declared to the CNIL and is edited by all the members of Art\'i\'Chaude.</p>');

            echo('<h2>Hosting</h2>');

            echo('<p>This site is hosted on an SSH server (probably built on OpenSSH).</p>');

            echo('<h2>Advertising and affiliation</h2>');

            echo('<p>Some of the articles on the site have been customized but have been greatly inspired by articles that can be found on the net.</p>');

        } else {

            echo('<h2 class="infosTitle">Mentions légales</h2>');

            echo('<hr>');

            echo('<p>Les présentes conditions générales fixent les modalités d\'utilisateur du service web d\'<a class="linkInfos" href="http://193.54.227.164/~SAESYS10/index.php">Art\'i\'Chaude</a>.</p>
            <p>L\'utilisateur reconnaît avoir pris connaissance de ce document et accepté l\'ensemble de ces informations, que cet usage soit fait à titre personnel ou professionnel. <br/>
            Si cet usage est fait à titre professionnel, l\'utilisateur garantit détenir les pouvoirs nécessaires pour accepter ces conditions générales au sein de son organisation.</p>');

            echo('<h2>Éditeur·rice·s et responsables de publication</h2>');

            echo('<p>Ce site web non déclaré à la CNIL est édité par l\'ensemble des membres d\'Art\'i\'Chaude.</p>');

            echo('<h2>Hébergement</h2>');

            echo('<p>Ce site est hébergé sur un serveur SSH (probablement réalisé sur OpenSSH).</p>');

            echo('<h2>Publicité et affiliation</h2>');

            echo('<p>Certains articles du site ont été personnalisés mais été grandement inspirés des articles possiblement trouvables sur le net.</p>');

        }

    echo('</div>');

    ?>

    <?php include("./include/footer.php"); ?>
</body>
</html>