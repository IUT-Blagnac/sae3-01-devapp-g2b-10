<?php
    // on inclut le fichier de connexion à la base Oracle
    require_once("connect.inc.php");

    session_start();

    if(isset($_POST['PaiementCB'])) {

        if(empty($_POST['paiementcb'])) {
            header('Location: ./paiement.php?msgErreur=Sélection incorrecte');
            exit;
        } 

        if(!(isset($_POST['numCB']) && isset($_POST['namesCB']) && isset($_POST['expiration']) && isset($_POST['cryptogramme']))) {
            header('Location: ./paiement.php?msgErreur=Veuillez remplir le champ');
            exit;
        }

        $numeroCB = htmlspecialchars($_POST['numCB']);
        $nomsCB = htmlspecialchars($_POST['namesCB']);
        $exp = htmlspecialchars($_POST['expiration']);
        $crypto = htmlspecialchars($_POST['cryptogramme']);
        $id = $_SESSION['id'];

        if(!preg_match('#^[0-9]{16}$#', $numeroCB)) {
            header('Location: ./paiement.php?msgErreur=Vérifiez la saisie de votre numéro de carte bancaire');
            exit;
        }

        if(!preg_match('#^(0[1-9]|1[0-2])(2[3-9]|[3-9][0-9])$#', $exp)) {
            header('Location: ./paiement.php?msgErreur=Vérifiez la saisie de votre date d\'expiration');
            exit;
        }

        if(!preg_match('#^[0-9]{3}$#', $crypto)) {
            header('Location: ./paiement.php?msgErreur=Vérifiez la saisie de votre cryptogramme');
            exit;
        }

        $req = "SELECT * FROM CARTEBANCAIRE WHERE IDACTEUR = :pIdActeur";
        $CBRecup = oci_parse($connect, $req);
        oci_bind_by_name($CBRecup, ":pIdActeur", $id);
        $result = oci_execute($CBRecup);

        if (!$result) {
            $e = oci_error($CBRecup);  // on récupère l'exception liée au pb d'execution de la requete (violation PK par exemple)
            $SQLerror = htmlentities($e['message'] . ' pour cette requete : ' . $e['sqltext']);

            header('Location: ./inscription.php?msgErreur=' .$SQLerror);
            exit;
        }

        if(isset($_POST['memoCB'])) {

            if(empty(oci_fetch_assoc($CBRecup))) {

                oci_free_statement($cryptoRecup);
                echo('<script language="JavaScript" type="text/javascript"> 
                    alert("Okay. Ajout de ta CB en cours... (procédure)"); 
                    location.href = "./index.php";
                    </script>');
            }
            
        } else if(!empty(oci_fetch_assoc($CBRecup))) {

            oci_free_statement($cryptoRecup);

            echo('<script language="JavaScript" type="text/javascript"> 
                alert("Okay. Retrait sur ta CB en cours... (procédure)");
                location.href = "./index.php";
                </script>');
        }

        echo('<script language="JavaScript" type="text/javascript"> 
                alert("Transaction effectuée.");
                location.href = "./index.php";
                </script>');

    }

    if(isset($_POST['PaiementCR'])) {

        if(empty($_POST['paiementcrypto'])) {
            header('Location: ./paiement.php?msgErreur=Sélection incorrecte');
            exit;
        }

        if(!(isset($_POST['numRef']))) {
            header('Location: ./paiement.php?msgErreur=Veuillez remplir le champ');
            exit;
        }

        $numReference = htmlspecialchars($_POST['numRef']);

        if(!preg_match('#^[1-9][0-9]{1,9}$#', $numReference)) {
            header('Location: ./paiement.php?msgErreur=Vérifiez la saisie de votre référence');
            exit;
        }

        $req = "SELECT * FROM CRYPTOMONNAIE WHERE NUMREF = :pNumReference";
        $cryptoRecup = oci_parse($connect, $req);
        oci_bind_by_name($cryptoRecup, ":pNumReference", $numReference);
        $result = oci_execute($cryptoRecup);

        if (!$result) {
            $e = oci_error($cryptoRecup);  // on récupère l'exception liée au pb d'execution de la requete (violation PK par exemple)
            $errorSQL = print htmlentities($e['message'].' pour cette requete : '.$e['sqltext']);
            header("Location: ./paiement.php=?msgErreur=$errorSQL");
            exit;
        }

        if(oci_fetch_assoc($cryptoRecup)) {
            header('Location: ./paiement.php?msgErreur=Numéro de référence déjà existant');
            exit;
        }

        oci_free_statement($cryptoRecup);

        echo('<script language="JavaScript" type="text/javascript"> 
            alert("Okay. Ajout de ta ref en cours... (procédure)"); 
            location.href = "./index.php";
          </script>');

    }

?>