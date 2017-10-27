<?php
    includeFiles(appConf('rootpath').'models/PHPMailer/src/');
    use PHPMailer\PHPMailer\PHPMailer;
    //require '../vendor/autoload.php';

    function sendTokenByEmail($token,$email,$username,$companies){
        echo '<br><br><br>';
        $mail = new PHPMailer;
        //Tell PHPMailer to use SMTP
        $mail->isSMTP();
        //Enable SMTP debugging
        // 0 = off (for production use)
        // 1 = client messages
        // 2 = client and server messages
        $mail->SMTPDebug = 2;
        //Set the hostname of the mail server
        $mail->Host = 'smtp.live.com';
        //Set the SMTP port number - likely to be 25, 465 or 587
        $mail->Port = 465;
        //Whether to use SMTP authentication
        $mail->SMTPAuth = true;
        $mail->SMTPSecure = 'ssl';
        //Username to use for SMTP authentication
        $mail->Username = 'nicolas.marcandella@hotmail.fr';
        //Password to use for SMTP authentication
        $mail->Password = 'exipi314';
        //Set who the message is to be sent from
        $mail->setFrom('nicolas.marcandella@hotmail.fr', 'Nicolas Marcandella');
        //Set an alternative reply-to address
        $mail->addReplyTo('nicolas.marcandella@hotmail.fr', 'Nicolas Marcandella');
        //Set who the message is to be sent to
        $mail->addAddress('nicolas.marcandella@isen.yncrea.fr', 'Nicolas Marcandella');
        //Set the subject line
        $mail->Subject = 'Nouveau Compte '.$companies;
        //Read an HTML message body from an external file, convert referenced images to embedded,
        //convert HTML into a basic plain-text alternative body
        $mail->msgHTML('Nom d\'utilisateur : '.$username.'<br>'.'Mot de passe : '.$token);
        //Replace the plain text body with one created manually
        $mail->AltBody = 'Nom d\'utilisateur : '.$username.' ; '.'Mot de passe : '.$token;
        //Attach an image file
        //$mail->addAttachment('images/phpmailer_mini.png');
        //send the message, check for errors
        if (!$mail->send()) {
            echo '<br><br><br>Mailer Error: ' . $mail->ErrorInfo;
            return false;
        } else {
            echo 'Message sent!';
            return true;
        }
    }
?>