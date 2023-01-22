<?php

  echo('<header>');

    if(isset($_SESSION['langue']) && $_SESSION['langue'] == 'EN') {

      echo('<div id="h-content">');
      
        echo('<div class="h-info">');
          echo('<a id="art-i-chaude" href="index.php"><img src="./include/images/artichaude.jpg" alt="art-i-chaude"/></a>');           
        echo('</div>');

        echo('<div class="h-info">');
          echo('<form method="POST" id="researchProduct"action="recherche.php">');
            echo('<input type="search" name="s" id="s" value="" placeholder="Search for an article"/>');
            
            echo('<button type="submit" name="btnLoupe" id="headerButton" title="Search..."><img src="./include/images/loupe.png" alt="loupe"/>');
          echo('</button>');
          echo('</form>');
        echo('</div>');

        echo('<div class="h-info" id="white-logos">');
          echo('<a class="headerImages" href="connexion.php"><img src="./include/images/user.png" alt="white-user"/></a>');         
          echo('<a class="headerImages" href="panier.php"><img src="./include/images/panier.png" alt="white-panier"/></a>');         
        echo('</div>');
      
      echo('</div>');

      echo('<div id="subheader">');
        echo('<a href="categorie.php?categorie=POSTERS" class="h-items">Posters</a>');
        echo('<a href="categorie.php?categorie=FIGURINES" class="h-items">Figurines</a>');
        echo('<a href="categorie.php?categorie=PELUCHES" class="h-items">Plushies</a>');
      echo('</div>');    

    } else { 
    
      echo('<div id="h-content">');
      
        echo('<div class="h-info">');
          echo('<a id="art-i-chaude" href="index.php"><img src="./include/images/artichaude.jpg" alt="art-i-chaude"/></a>');           
        echo('</div>');

        echo('<div class="h-info">');
          echo('<form method="POST" id="researchProduct"action="recherche.php">');
            echo('<input type="search" name="s" id="s" value="" placeholder="Rechercher un article"/>');
            
            echo('<button type="submit"  name="btnLoupe" id="headerButton" title="Rechercher..."><img src="./include/images/loupe.png" alt="loupe"/>');
          echo('</button>');
          echo('</form>');
        echo('</div>');

        echo('<div class="h-info" id="white-logos">');
          echo('<a class="headerImages" href="connexion.php"><img src="./include/images/user.png" alt="white-user"/></a>');         
          echo('<a class="headerImages" href="panier.php"><img src="./include/images/panier.png" alt="white-panier"/></a>');         
        echo('</div>');
      
      echo('</div>');

      echo('<div id="subheader">');
        echo('<a href="categorie.php?categorie=POSTERS" class="h-items">Posters</a>');
        echo('<a href="categorie.php?categorie=FIGURINES" class="h-items">Figurines</a>');
        echo('<a href="categorie.php?categorie=PELUCHES" class="h-items">Peluches</a>');
      echo('</div>');

    }
    
  echo('</header>');

?>