<?php

    //On se contentera d'une simulation d'un envoi d'un message

    if(isset($_POST['Envoi'])) {

        if(isset($_POST['adresseMail']) && isset($_POST['objet']) && isset($_POST['Commentaire'])){

            $adresseMail = htmlspecialchars($_POST['adresseMail']);

            if(!preg_match('#^[a-z0-9._-]+@[a-z0-9._-]{2,}\.[a-z]{2,4}$#', $adresseMail)) {

                header('Location: ./contact.php?msgErreur=Vérifiez la saisie de vos champs');
                exit;
              
            } else {

                echo('<script language="JavaScript" type="text/javascript"> 
                        alert("Message envoyé."); 
                        location.href = "./index.php";
                    </script>');
            }

        } else {

            echo('<script language="JavaScript" type="text/javascript"> 
                        alert("Veuillez terminer de remplir les champs."); 
                        location.href = "./contact.php";
                    </script>');

        }     

    }

    /*En vue d'une non-configuration du serveur SMTP, il nous est impossible d'utiliser le framework PHPMailer pour l'envoi de mails
  
    use PHPMailer\PHPMailer\PHPMailer;

    require_once('./include/PHPMailer/Exception.php');
    require_once('./include/PHPMailer/PHPMailer.php');
    require_once('./include/PHPMailer/SMTP.php');

    $mail = new PHPMailer(true);

    if(isset($_POST['Envoi'])) {

        $from = $_POST['adresseMail'];
        $to = ""; //The address to send the mail
        $subject = $_POST['objet'];
        $message = $_POST['Commentaire'];

        try {

            $mail->isSMTP();
            $mail->Host = 'smtp.gmail.com';
            $mail->SMTPAuth = true;
            $mail->Username = ''; //Your address
            $mail->Password = '';
            $mail->SMTPSecture = "tls";
            $mail->Port = '587';

            $mail->setFrom(''); //Your adress
            $mail->addAddress(''); //Receiving address

            $mail->isHTML(true);
            $mail->Subject = 'Message Received from Contact :'.$from;
            $mail->Body = "Subject: $subject<br/>Message: $message";

            $mail->send();
            echo ('<script language="JavaScript" type="text/javascript"> 
                        alert("Mail envoyé !"); 
                        location.href = "./index.php";
                    </script>');

        } catch(Exception $e) {

            echo('<script language="JavaScript" type="text/javascript"> 
                        alert("Le mail a échoué."); 
                        location.href = "./contact.php";
                    </script>');
        }

    }*/

?>