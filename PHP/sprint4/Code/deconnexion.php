<?php 
  
  session_start();
  
  if(isset($_POST['Deconnexion'])) {
    
    session_destroy();
    header('Location: ./connexion.php');
    
  }
  
?>
