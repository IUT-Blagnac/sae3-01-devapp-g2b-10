<?php
    // on inclut le fichier de connexion à la base Oracle
    require_once("connect.inc.php");
    error_reporting(0);

    session_start();

    if(isset($_GET['pIdActeur'])) {

        $acteurARetirer = $_GET['pIdActeur'];

        $req = "DELETE FROM ACTEUR WHERE IDACTEUR = '$acteurARetirer'";

        $deleteActeur = oci_parse($connect, $req);

        $result = oci_execute($deleteActeur);

        oci_commit($connect);

        oci_free_statement($deleteActeur);

        session_destroy();

        echo('<script language="JavaScript" type="text/javascript"> 
                alert("Suppression réussie. A bientôt chez Art\'i\'Chaude."); 
                location.href = "./connexion.php";
              </script>');

    }

?>