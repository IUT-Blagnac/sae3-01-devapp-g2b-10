<?php

    //On se contentera également d'une simulation d'un envoi d'un message

    if(isset($_POST['Envoyer'])) {

        if(isset($_POST['prenom']) && isset($_POST['nom']) && isset($_POST['adresseMail']) && isset($_POST['telephone']) && isset($_POST['Presentation'])) {

            $adresseMail = htmlspecialchars($_POST['adresseMail']);
            $numTelephone = htmlspecialchars($_POST['telephone']);

            if(!preg_match('#^[a-z0-9._-]+@[a-z0-9._-]{2,}\.[a-z]{2,4}$#', $adresseMail)) {

                header('Location: ./collaboration.php?msgErreur=Vérifiez la saisie de votre adresse mail');
                exit;

            } else if(!preg_match('#^0\d{9}$#', $numTelephone)) {

                header('Location: ./collaboration.php?msgErreur=Vérifiez la saisie de votre numéro de téléphone');
                exit;

            } else {

                echo('<script language="JavaScript" type="text/javascript"> 
                        alert("Demande de collaboration envoyée."); 
                        location.href = "./index.php";
                    </script>');

            }

        } else {

            echo('<script language="JavaScript" type="text/javascript"> 
                        alert("Veuillez terminer de remplir les champs."); 
                        location.href = "./collaboration.php";
                    </script>');

        }

    }


?>