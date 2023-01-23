<?php
    // on inclut le fichier de connexion à la base Oracle
    session_start();
    require_once("connect.inc.php");

    if(isset($_SESSION['langue']) && $_SESSION['langue'] == 'EN') {

      if(isset($_POST['PaiementCB'])) {

        if(empty($_POST['paiementcb'])) {
            header('Location: ./paiement.php?msgErreur=Incorrect selection');
            exit;
        }

        if(!(isset($_POST['numCB']) && isset($_POST['namesCB']) && isset($_POST['expiration']) && isset($_POST['cryptogramme']))) {
            header('Location: ./paiement.php?msgErreur=Please fill in the fields');
            exit;
        }

        $numeroCB = htmlspecialchars($_POST['numCB']);
        $nomsCB = htmlspecialchars($_POST['namesCB']);
        $exp = htmlspecialchars($_POST['expiration']);
        $cryptogramme = htmlspecialchars($_POST['cryptogramme']);
        $id = $_SESSION['id'];
        $adresse = htmlspecialchars($_POST['adresse']);
        $instructions = htmlspecialchars($_POST['instruction']);
        $support = htmlspecialchars($_POST['paiementcb']);

        if(!preg_match('#^[0-9]{16}$#', $numeroCB)) {
            header('Location: ./paiement.php?msgErreur=Check your credit card number');
            exit;
        }

        if(!preg_match('#^(0[1-9]|1[0-2])(2[3-9]|[3-9][0-9])$#', $exp)) {
            header('Location: ./paiement.php?msgErreur=Check your expiration date entry');
            exit;
        }

        if(!preg_match('#^[0-9]{3}$#', $cryptogramme)) {
            header('Location: ./paiement.php?msgErreur=Check the entry of your cryptogram');
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

        $procCommander = "BEGIN PASSERCOMMANDE(:p_idActeur,:p_addresseLivraison,:p_instructionsLivraison,:p_supportPaiement,:p_numRef,:p_numCB,:p_nomCB,:p_dateCB,:p_cryptoCB,:p_typeProcedure); END;";
        $commanderRecup = oci_parse($connect, $procCommander);
        oci_bind_by_name($commanderRecup,':p_idActeur',$id);
        oci_bind_by_name($commanderRecup,':p_addresseLivraison',$adresse);
        oci_bind_by_name($commanderRecup,':p_instructionsLivraison',$instructions);
        oci_bind_by_name($commanderRecup,':p_supportPaiement',$support);
        oci_bind_by_name($commanderRecup,':p_numRef',$numReference);
        oci_bind_by_name($commanderRecup,':p_numCB',$numeroCB);
        oci_bind_by_name($commanderRecup,':p_nomCB',$nomsCB);
        oci_bind_by_name($commanderRecup,':p_dateCB',$exp);
        oci_bind_by_name($commanderRecup,':p_cryptoCB',$cryptogramme);

        if(isset($_POST['memoCB'])) {

            if(empty(oci_fetch_assoc($CBRecup))) {
            //procédure avec insert carte bancaire
              $typeProcedure = "ins";
              oci_bind_by_name($commanderRecup,'p_typeProcedure',$typeProcedure);

              $resultCommander = oci_execute($commanderRecup);

              if (!$resultCommander) {
                $e = oci_error($commanderRecup);  // on récupère l'exception liée au pb d'execution de la requete (violation PK par exemple)
                $SQLerror = htmlentities($e['message'] . ' pour cette requete : ' . $e['sqltext']);

                header('Location: ./paiement.php?msgErreur=' .$SQLerror);
                exit;
              }

            } else {
              //procédure avec rien sur carte bancaire
              $typeProcedure = "ras";
              oci_bind_by_name($commanderRecup,'p_typeProcedure',$typeProcedure);

              $resultCommander = oci_execute($commanderRecup);

              if (!$resultCommander) {
                $e = oci_error($commanderRecup);  // on récupère l'exception liée au pb d'execution de la requete (violation PK par exemple)
                $SQLerror = htmlentities($e['message'] . ' pour cette requete : ' . $e['sqltext']);

                header('Location: ./paiement.php?msgErreur=' .$SQLerror);
                exit;
              }
            }
            
        } else if(!empty(oci_fetch_assoc($CBRecup))) {
          //procédure avec delete carte bancaire
          $typeProcedure = "del";
          oci_bind_by_name($commanderRecup,'p_typeProcedure',$typeProcedure);

          $resultCommander = oci_execute($commanderRecup);

          if (!$resultCommander) {
            $e = oci_error($commanderRecup);  // on récupère l'exception liée au pb d'execution de la requete (violation PK par exemple)
            $SQLerror = htmlentities($e['message'] . ' pour cette requete : ' . $e['sqltext']);

            header('Location: ./paiement.php?msgErreur=' .$SQLerror);
            exit;
          }

        } else {
          //procédure avec rien sur carte bancaire
          $typeProcedure = "ras";
          oci_bind_by_name($commanderRecup,'p_typeProcedure',$typeProcedure);

          $resultCommander = oci_execute($commanderRecup);

          if (!$resultCommander) {
            $e = oci_error($commanderRecup);  // on récupère l'exception liée au pb d'execution de la requete (violation PK par exemple)
            $SQLerror = htmlentities($e['message'] . ' pour cette requete : ' . $e['sqltext']);

            header('Location: ./paiement.php?msgErreur=' .$SQLerror);
            exit;
          }
        }

        echo('<script language="JavaScript" type="text/javascript"> 
                alert("Transaction made.");
                location.href = "./index.php";
                </script>');

      }

      if(isset($_POST['PaiementCR'])) {

        if(empty($_POST['paiementcrypto'])) {
            header('Location: ./paiement.php?msgErreur=Incorrect selection');
            exit;
        }

        if(!(isset($_POST['numRef']))) {
            header('Location: ./paiement.php?msgErreur=Please fill in the field');
            exit;
        }

        //variables nécessaires pour la procédure
        $numeroCB = "";
        $nomsCB = "";
        $exp = "";
        $cryptogramme = "";

        $numReference = htmlspecialchars($_POST['numRef']);
        $id = $_SESSION['id'];
        $adresse = htmlspecialchars($_POST['adresse']);
        $instructions = htmlspecialchars($_POST['instruction']);
        $support = htmlspecialchars($_POST['paiementcrypto']);


        if(!preg_match('#^[1-9][0-9]{1,9}$#', $numReference)) {
            header('Location: ./paiement.php?msgErreur=Check the entry of your reference');
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
            header('Location: ./paiement.php?msgErreur=Existing reference number');
            exit;
        }
        //procédure avec rien sur carte bancaire
        $typeProcedure = "ras";


        $procCommander = "BEGIN PASSERCOMMANDE(:p_idActeur,:p_addresseLivraison,:p_instructionsLivraison,:p_supportPaiement,:p_numRef,:p_numCB,:p_nomCB,:p_dateCB,:p_cryptoCB,:p_typeProcedure); END;";
        $commanderRecup = oci_parse($connect, $procCommander);
        oci_bind_by_name($commanderRecup,':p_idActeur',$id);
        oci_bind_by_name($commanderRecup,':p_addresseLivraison',$adresse);
        oci_bind_by_name($commanderRecup,':p_instructionsLivraison',$instructions);
        oci_bind_by_name($commanderRecup,':p_supportPaiement',$support);
        oci_bind_by_name($commanderRecup,':p_numRef',$numReference);
        oci_bind_by_name($commanderRecup,':p_numCB',$numeroCB);
        oci_bind_by_name($commanderRecup,':p_nomCB',$nomsCB);
        oci_bind_by_name($commanderRecup,':p_dateCB',$exp);
        oci_bind_by_name($commanderRecup,':p_cryptoCB',$cryptogramme);
        oci_bind_by_name($commanderRecup,'p_typeProcedure',$typeProcedure);

        $resultCommander = oci_execute($commanderRecup);

        if (!$resultCommander) {
          $e = oci_error($commanderRecup);  // on récupère l'exception liée au pb d'execution de la requete (violation PK par exemple)
          $SQLerror = htmlentities($e['message'] . ' pour cette requete : ' . $e['sqltext']);

          header('Location: ./paiement.php?msgErreur=' .$SQLerror);
          exit;
        }

        oci_free_statement($cryptoRecup);
        oci_free_statement($commanderRecup);
        echo('<script language="JavaScript" type="text/javascript"> 
            alert("Addition of the ref made."); 
            location.href = "./index.php";
          </script>');

      }

    } else {

      if(isset($_POST['PaiementCB'])) {

        if(empty($_POST['paiementcb'])) {
            header('Location: ./paiement.php?msgErreur=Sélection incorrecte');
            exit;
        }

        if(!(isset($_POST['numCB']) && isset($_POST['namesCB']) && isset($_POST['expiration']) && isset($_POST['cryptogramme']))) {
            header('Location: ./paiement.php?msgErreur=Veuillez remplir les champs');
            exit;
        }

        $numeroCB = htmlspecialchars($_POST['numCB']);
        $nomsCB = htmlspecialchars($_POST['namesCB']);
        $exp = htmlspecialchars($_POST['expiration']);
        $cryptogramme = htmlspecialchars($_POST['cryptogramme']);
        $id = $_SESSION['id'];
        $adresse = htmlspecialchars($_POST['adresse']);
        $instructions = htmlspecialchars($_POST['instruction']);
        $support = htmlspecialchars($_POST['paiementcb']);

        if(!preg_match('#^[0-9]{16}$#', $numeroCB)) {
            header('Location: ./paiement.php?msgErreur=Vérifiez la saisie de votre numéro de carte bancaire');
            exit;
        }

        if(!preg_match('#^(0[1-9]|1[0-2])(2[3-9]|[3-9][0-9])$#', $exp)) {
            header('Location: ./paiement.php?msgErreur=Vérifiez la saisie de votre date d\'expiration');
            exit;
        }

        if(!preg_match('#^[0-9]{3}$#', $cryptogramme)) {
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

        $procCommander = "BEGIN PASSERCOMMANDE(:p_idActeur,:p_addresseLivraison,:p_instructionsLivraison,:p_supportPaiement,:p_numRef,:p_numCB,:p_nomCB,:p_dateCB,:p_cryptoCB,:p_typeProcedure); END;";
        $commanderRecup = oci_parse($connect, $procCommander);
        oci_bind_by_name($commanderRecup,':p_idActeur',$id);
        oci_bind_by_name($commanderRecup,':p_addresseLivraison',$adresse);
        oci_bind_by_name($commanderRecup,':p_instructionsLivraison',$instructions);
        oci_bind_by_name($commanderRecup,':p_supportPaiement',$support);
        oci_bind_by_name($commanderRecup,':p_numRef',$numReference);
        oci_bind_by_name($commanderRecup,':p_numCB',$numeroCB);
        oci_bind_by_name($commanderRecup,':p_nomCB',$nomsCB);
        oci_bind_by_name($commanderRecup,':p_dateCB',$exp);
        oci_bind_by_name($commanderRecup,':p_cryptoCB',$cryptogramme);

        if(isset($_POST['memoCB'])) {

            if(empty(oci_fetch_assoc($CBRecup))) {
            //procédure avec insert carte bancaire
              $typeProcedure = "ins";
              oci_bind_by_name($commanderRecup,'p_typeProcedure',$typeProcedure);

              $resultCommander = oci_execute($commanderRecup);

              if (!$resultCommander) {
                $e = oci_error($commanderRecup);  // on récupère l'exception liée au pb d'execution de la requete (violation PK par exemple)
                $SQLerror = htmlentities($e['message'] . ' pour cette requete : ' . $e['sqltext']);

                header('Location: ./paiement.php?msgErreur=' .$SQLerror);
                exit;
              }

            } else {
              //procédure avec rien sur carte bancaire
              $typeProcedure = "ras";
              oci_bind_by_name($commanderRecup,'p_typeProcedure',$typeProcedure);

              $resultCommander = oci_execute($commanderRecup);

              if (!$resultCommander) {
                $e = oci_error($commanderRecup);  // on récupère l'exception liée au pb d'execution de la requete (violation PK par exemple)
                $SQLerror = htmlentities($e['message'] . ' pour cette requete : ' . $e['sqltext']);

                header('Location: ./paiement.php?msgErreur=' .$SQLerror);
                exit;
              }
            }
            
        } else if(!empty(oci_fetch_assoc($CBRecup))) {
          //procédure avec delete carte bancaire
          $typeProcedure = "del";
          oci_bind_by_name($commanderRecup,'p_typeProcedure',$typeProcedure);

          $resultCommander = oci_execute($commanderRecup);

          if (!$resultCommander) {
            $e = oci_error($commanderRecup);  // on récupère l'exception liée au pb d'execution de la requete (violation PK par exemple)
            $SQLerror = htmlentities($e['message'] . ' pour cette requete : ' . $e['sqltext']);

            header('Location: ./paiement.php?msgErreur=' .$SQLerror);
            exit;
          }

        } else {
          //procédure avec rien sur carte bancaire
          $typeProcedure = "ras";
          oci_bind_by_name($commanderRecup,'p_typeProcedure',$typeProcedure);

          $resultCommander = oci_execute($commanderRecup);

          if (!$resultCommander) {
            $e = oci_error($commanderRecup);  // on récupère l'exception liée au pb d'execution de la requete (violation PK par exemple)
            $SQLerror = htmlentities($e['message'] . ' pour cette requete : ' . $e['sqltext']);

            header('Location: ./paiement.php?msgErreur=' .$SQLerror);
            exit;
          }
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

        //variables nécessaires pour la procédure
        $numeroCB = "";
        $nomsCB = "";
        $exp = "";
        $cryptogramme = "";

        $numReference = htmlspecialchars($_POST['numRef']);
        $id = $_SESSION['id'];
        $adresse = htmlspecialchars($_POST['adresse']);
        $instructions = htmlspecialchars($_POST['instruction']);
        $support = htmlspecialchars($_POST['paiementcrypto']);


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
        //procédure avec rien sur carte bancaire
        $typeProcedure = "ras";


        $procCommander = "BEGIN PASSERCOMMANDE(:p_idActeur,:p_addresseLivraison,:p_instructionsLivraison,:p_supportPaiement,:p_numRef,:p_numCB,:p_nomCB,:p_dateCB,:p_cryptoCB,:p_typeProcedure); END;";
        $commanderRecup = oci_parse($connect, $procCommander);
        oci_bind_by_name($commanderRecup,':p_idActeur',$id);
        oci_bind_by_name($commanderRecup,':p_addresseLivraison',$adresse);
        oci_bind_by_name($commanderRecup,':p_instructionsLivraison',$instructions);
        oci_bind_by_name($commanderRecup,':p_supportPaiement',$support);
        oci_bind_by_name($commanderRecup,':p_numRef',$numReference);
        oci_bind_by_name($commanderRecup,':p_numCB',$numeroCB);
        oci_bind_by_name($commanderRecup,':p_nomCB',$nomsCB);
        oci_bind_by_name($commanderRecup,':p_dateCB',$exp);
        oci_bind_by_name($commanderRecup,':p_cryptoCB',$cryptogramme);
        oci_bind_by_name($commanderRecup,'p_typeProcedure',$typeProcedure);

        $resultCommander = oci_execute($commanderRecup);

        if (!$resultCommander) {
          $e = oci_error($commanderRecup);  // on récupère l'exception liée au pb d'execution de la requete (violation PK par exemple)
          $SQLerror = htmlentities($e['message'] . ' pour cette requete : ' . $e['sqltext']);

          header('Location: ./paiement.php?msgErreur=' .$SQLerror);
          exit;
        }

        oci_free_statement($cryptoRecup);
        oci_free_statement($commanderRecup);
        echo('<script language="JavaScript" type="text/javascript"> 
            alert("Ajout de la ref effectuée."); 
            location.href = "./index.php";
          </script>');

      }

    }

?>