<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <link rel="stylesheet" href="./include/styles.css"/>
    <link rel="icon" href="./include/images/artichaude.jpg"/>
    <title>Cookies</title>
</head>
<body>
    <?php session_start(); ?>
    <?php include("./include/header.php"); ?>

    <?php 

        echo('<div class="infosContainer">');

            if(isset($_SESSION['langue']) && $_SESSION['langue'] == 'EN') {

                echo('<h2 class="infosTitle">Cookie policy for Art\'i\'Chaude</h2>');

                echo('<hr>');

                echo('<h1>Cookie policy</h1>');

                echo("<p>This cookie policy explains what cookies are and how we use them. 
                You should read this policy so that you can understand what type of cookies we use, or the information we collect using cookies and how that information is used.</p>
                <p>Cookies generally do not contain personally identifiable information about a user, but the personal information we store about you may be linked to information stored in and obtained from cookies.</p> 
                <p>For more information about how we use, store and secure your personal data, see our Privacy Policy.</p>
                <p>We do not store sensitive personal information, such as mailing addresses, account passwords, etc. in the cookies we use.</p>");

                echo("<h1>Interpretation and definitions</h1>");

                echo("<h2>Interpretation</h2>");

                echo("<p>Words with initial letters capitalized have meanings defined under the following conditions.
                The following definitions have the same meaning whether they appear in the singular or plural.</p>");

                echo("<h2>Definitions</h2>");

                echo("<p>For the purposes of this cookie policy :</p>");

                echo('<ul>
                        <li><p><b>The company</b> (referred to as "the Company", "we", "us" or "our" in this Cookie Policy) refers to Art\'i\'Chaude.</p></li>
                        <li><p><b>Cookies</b> are small files that are placed on your computer, mobile device or other device by a website, containing details of your browsing history on that website among its many uses.</p></li>
                        <li><p><b>Website</b> refers to Art\'i\'Chaude, accessible from <a class="linkInfos" href="http://193.54.227.164/~SAESYS10/index.php">http://193.54.227.164/~SAESYS10/index.php</a>.</p></li>
                        <li><p><b>You</b> means the natural person accessing or using the website, or a company, or any legal entity on whose behalf that natural person accesses or uses the website, as applicable.</p></li>
                    </ul>');

                echo("<h1>Use of cookies</h1>");

                echo("<h2>Type of cookies used :</h2>");

                echo('<p>Cookies can be "persistent" cookies or "session" cookies. 
                        Persistent cookies remain on your personal computer or mobile device when you log out, while session cookies are deleted as soon as you close your web browser.</p>
                    <p>We use both session and persistent cookies for the purposes stated below :</p>');

                echo("<ul>
                    <li><p><b>Necessary / essential cookies</b></p>
                        <p>Type: Session cookies</p>
                        <p>Administered by : us</p>
                        <p>Purpose : These cookies are essential to provide you with the services available through the website and to allow you to use some of its features.
                        They help authenticate users and prevent fraudulent use of user accounts. 
                        Without these cookies, the services you have requested cannot be provided, and we use these cookies only to provide those services to you.</p>
                    </li>
                    <li><p><b>Functionality cookies</b></p>
                        <p>Type : Persistent cookies</p>
                        <p>Administered by : us</p>
                        <p>Purpose: These cookies allow us to remember choices you make when using the website, such as remembering your login information or language preferences. 
                        The purpose of these cookies is to provide you with a more personal experience and to avoid having to re-enter your preferences each time you use the website.</p>
                    </li>
                </ul>");

                echo("<h1>Your choices regarding cookies</h1>");
                
                echo("<p>If you prefer to avoid the use of cookies on the website, you should first disable the use of cookies in your browser, and then delete the cookies stored in your browser associated with this website.
                You can use this option to prevent the use of cookies at any time.</p>
                <p>If you do not accept our cookies, you may experience inconvenience in your use of the website and some features may not function properly.</p>
                <p>If you wish to delete cookies or have your web browser delete or refuse cookies, please consult your web browser's help pages.</p>");

                echo('<ul>
                    <li><p>For the Chrome web browser, please visit this page from Google : <a class="linkInfos" href="https://support.google.com/accounts/answer/32050">https://support.google.com/accounts/answer/32050</a></p></li>
                    <li><p>For the Internet Explorer web browser, please visit this Microsoft page : <a class="linkInfos" href="https://support.mozilla.org/en-US/kb/delete-cookies-remove-info-websites-stored">https://support.mozilla.org/en-US/kb/delete-cookies-remove-info-websites-stored</a></p></li>
                    <li><p>For the Firefox web browser, please visit this Mozilla page : <a class="linkInfos" href="https://support.mozilla.org/en-US/kb/delete-cookies-remove-info-websites-stored">https://support.mozilla.org/en-US/kb/delete-cookies-remove-info-websites-stored</a></p></li>
                    <li><p>For the Safari web browser, please visit this Apple page : <a class="linkInfos" href="https://support.apple.com/guide/safari/manage-cookies-and-website-data-sfri11471/mac">https://support.apple.com/guide/safari/manage-cookies-and-website-data-sfri11471/mac</a></p></li>
                </ul>');

                echo("<p>For any other web browser, please visit the official web pages of your web browser.</p>");

            } else {

                echo('<h2 class="infosTitle">Politique de cookies pour Art\'i\'Chaude</h2>');

                echo('<hr>');

                echo('<h1>Politique de cookies</h1>');

                echo("<p>Cette politique de cookies explique ce que sont les cookies et comment nous les utilisons. 
                Vous devriez lire cette politique afin de pouvoir comprendre quel type de cookies nous utilisons, ou les informations que nous collectons à l'aide des cookies et comment ces informations sont utilisées.</p>
                <p>Les cookies ne contiennent généralement pas d'informations permettant d'identifier personnellement un utilisateur, mais les informations personnelles que nous stockons à votre sujet peuvent être liées aux informations stockées dans les cookies et obtenues à partir de ceux-ci.</p> 
                <p>Pour plus d'informations sur la manière dont nous utilisons, stockons et sécurisons vos données personnelles, consultez notre politique de confidentialité.</p>
                <p>Nous ne stockons pas d'informations personnelles sensibles, telles que des adresses postales, des mots de passe de comptes, etc. dans les cookies que nous utilisons.</p>");

                echo("<h1>Interprétation et définitions</h1>");

                echo("<h2>Interprétation</h2>");

                echo("<p>Les mots dont la lettre initiale est en majuscule ont des significations définies dans les conditions suivantes.
                Les définitions suivantes ont le même sens, qu'elles apparaissent au singulier ou au pluriel.</p>");

                echo("<h2>Définitions</h2>");

                echo("<p>Aux fins de la présente politique relative aux cookies :</p>");

                echo('<ul>
                        <li><p><b>La société</b> (désignée soit par "la société", "nous", "notre" ou "nos" dans la présente politique relative aux cookies) fait référence à Art\'i\'Chaude.</p></li>
                        <li><p><b>Les cookies</b> désignent les petits fichiers qui sont placés sur votre ordinateur, votre appareil mobile ou tout autre appareil par un site web, contenant les détails de votre historique de navigation sur ce site web parmi ses nombreuses utilisations.</p></li>
                        <li><p><b>Le site web</b> désigne Art\'i\'Chaude, accessible à partir de <a class="linkInfos" href="http://193.54.227.164/~SAESYS10/index.php">http://193.54.227.164/~SAESYS10/index.php</a>.</p></li>
                        <li><p><b>Vous</b> désignez la personne physique accédant ou utilisant le site web, ou une société, ou toute entité juridique au nom de laquelle cette personne physique accède ou utilise le site web, selon le cas.</p></li>
                    </ul>');

                echo("<h1>L'utilisation des cookies</h1>");

                echo("<h2>Type de cookies utilisés :</h2>");

                echo('<p>Les cookies peuvent être des cookies "persistants" ou des cookies "de session". 
                        Les cookies persistants restent sur votre ordinateur personnel ou votre appareil mobile lorsque vous vous déconnectez, tandis que les cookies de session sont supprimés dès que vous fermez votre navigateur web.</p>
                    <p>Nous utilisons des cookies de session et des cookies persistants aux fins énoncées ci-dessous :</p>');

                echo("<ul>
                    <li><p><b>Cookies nécessaires / essentiels</b></p>
                        <p>Type : Cookies de session</p>
                        <p>Administrés par : nous</p>
                        <p>Objectif : Ces cookies sont essentiels pour vous fournir les services disponibles par le biais du site internet et pour vous permettre d'utiliser certaines de ses fonctionnalités.
                        Ils aident à authentifier les utilisateurs et à prévenir l'utilisation frauduleuse des comptes d'utilisateurs. 
                        Sans ces cookies, les services que vous avez demandés ne peuvent pas être fournis, et nous utilisons ces cookies uniquement pour vous fournir ces services.</p>
                    </li>
                    <li><p><b>Cookies de fonctionnalité</b></p>
                        <p>Type : Cookies persistants</p>
                        <p>Administrés par : nous</p>
                        <p>Objectif : Ces cookies nous permettent de nous souvenir des choix que vous faites lorsque vous utilisez le site web, comme la mémorisation de vos données de connexion ou de vos préférences linguistiques. 
                        L'objectif de ces cookies est de vous offrir une expérience plus personnelle et de vous éviter de devoir saisir à nouveau vos préférences chaque fois que vous utilisez le site web.</p>
                    </li>
                </ul>");

                echo("<h1>Vos choix concernant les cookies</h1>");
                
                echo("<p>Si vous préférez éviter l'utilisation de cookies sur le site web, vous devez d'abord désactiver l'utilisation de cookies dans votre navigateur, puis supprimer les cookies enregistrés dans votre navigateur associé à ce site web.
                Vous pouvez utiliser cette option pour empêcher l'utilisation de cookies à tout moment.</p>
                <p>Si vous n'acceptez pas nos cookies, vous pouvez rencontrer des inconvénients dans votre utilisation du site web et certaines fonctionnalités peuvent ne pas fonctionner correctement.</p>
                <p>Si vous souhaitez supprimer les cookies ou demander à votre navigateur web de supprimer ou de refuser les cookies, veuillez consulter les pages d'aide de votre navigateur web.</p>");

                echo('<ul>
                    <li><p>Pour le navigateur web Chrome, veuillez visiter cette page de Google : <a class="linkInfos" href="https://support.google.com/accounts/answer/32050">https://support.google.com/accounts/answer/32050</a></p></li>
                    <li><p>Pour le navigateur web Internet Explorer, veuillez visiter cette page de Microsoft : <a class="linkInfos" href="https://support.mozilla.org/en-US/kb/delete-cookies-remove-info-websites-stored">https://support.mozilla.org/en-US/kb/delete-cookies-remove-info-websites-stored</a></p></li>
                    <li><p>Pour le navigateur web Firefox, veuillez visiter cette page de Mozilla : <a class="linkInfos" href="https://support.mozilla.org/en-US/kb/delete-cookies-remove-info-websites-stored">https://support.mozilla.org/en-US/kb/delete-cookies-remove-info-websites-stored</a></p></li>
                    <li><p>Pour le navigateur web Safari, veuillez visiter cette page d\'Apple : <a class="linkInfos" href="https://support.apple.com/guide/safari/manage-cookies-and-website-data-sfri11471/mac">https://support.apple.com/guide/safari/manage-cookies-and-website-data-sfri11471/mac</a></p></li>
                </ul>');

                echo("<p>Pour tout autre navigateur web, veuillez visiter les pages web officielles de votre navigateur web.</p>");

            }
        
        echo('</div>');

    ?>

    <?php include("./include/footer.php"); ?>
</body>
</html>