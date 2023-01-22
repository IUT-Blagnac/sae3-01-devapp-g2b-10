<?php

  echo('<footer>');
    echo('<div class="f-content">');
      echo('<div class="table">');

        if(isset($_SESSION['langue']) && $_SESSION['langue'] == 'EN') {

          echo('<div class="row">');
            echo('<div class="cell"><a class="liensFooter" href="contact.php">Contact</a></div>');
            echo('<div class="cell"><a class="liensFooter" href="members.php">Our team</a></div>');
            echo('<div class="cell"><a class="liensFooter" href="cgv.php">Terms and conditions of sale</a></div>');
          echo('</div>');
          echo('<div class="row">');
            echo('<div class="cell"><a class="liensFooter" href="collaboration.php">Collaboration request</a></div>');
            echo('<div class="cell"><a class="liensFooter" href="plan_site.php">Site plan</a></div>');
          echo('</div>');
          echo('<div class="row">');
            echo('<div class="cell"><a class="liensFooter" href="mentions_legales.php">Terms of use</a></div>');
            echo('<div class="cell"><a class="liensFooter" href="cookies.php">Cookies</a></div>');
            echo('<div class="cell"><a class="liensFooter" href="confidentialite.php">Privacy Policy for Art\'i\'Chaude website</a></div>');
          echo('</div>');

        } else {

          echo('<div class="row">');
            echo('<div class="cell"><a class="liensFooter" href="contact.php">Contact</a></div>');
            echo('<div class="cell"><a class="liensFooter" href="members.php">Notre équipe</a></div>');
            echo('<div class="cell"><a class="liensFooter" href="cgv.php">Conditions générales de vente</a></div>');
          echo('</div>');
          echo('<div class="row">');
            echo('<div class="cell"><a class="liensFooter" href="collaboration.php">Demande de collaboration</a></div>');
            echo('<div class="cell"><a class="liensFooter" href="plan_site.php">Plan du site</a></div>');
          echo('</div>');
          echo('<div class="row">');
            echo('<div class="cell"><a class="liensFooter" href="mentions_legales.php">Mentions légales</a></div>');
            echo('<div class="cell"><a class="liensFooter" href="cookies.php">Cookies</a></div>');
            echo('<div class="cell"><a class="liensFooter" href="confidentialite.php">Politique confidentialité</a></div>');
          echo('</div>');

        }

      echo('</div>'); 
    echo('</div>');
  echo('</footer>');

?>