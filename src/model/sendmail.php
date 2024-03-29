<?php
//Import PHPMailer classes into the global namespace
//These must be at the top of your script, not inside a function
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

function mailTo($emailTo, $text, $username, $emailFrom)
{
    //Load Composer's autoloader
    require $_SERVER['DOCUMENT_ROOT'] . '/vendor/autoload.php';
    //Instantiation and passing `true` enables exceptions
    $mail = new PHPMailer(true);

    if ($emailFrom == null){
        $emailFrom = "contact@photify.mycpnv.ch";
        $emailUsername = "Photify contact";
    }

    try {
        //Server settings
        $mail->SMTPDebug = SMTP::DEBUG_SERVER;                      //Enable verbose debug output
        $mail->isSMTP();                                            //Send using SMTP
        $mail->Host       = 'mail01.swisscenter.com';               //Set the SMTP server to send through
        $mail->SMTPAuth   = true;                                   //Enable SMTP authentication
        $mail->Username   = 'contact@photify.mycpnv.ch';            //SMTP username
        $mail->Password   = 'R0kkx.osz';                            //SMTP password
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;         //Enable TLS encryption; `PHPMailer::ENCRYPTION_SMTPS` encouraged
        $mail->Port       = 587;                                    //TCP port to connect to, use 465 for `PHPMailer::ENCRYPTION_SMTPS` above

        //Recipients
        $mail->setFrom($emailFrom, $username);
        //Add a recipient
        $mail->addAddress($emailTo);
        //Sender username
        $mail->FromName = $username;


        //Content
        //Set email format to HTML
        $mail->isHTML(true);
        $mail->Subject = 'An user has sent you something';
        $mail->Body = $text;

        $mail->send();
        
        // echo 'Message has been sent';

        $currentPost = $_SESSION['currentPost'];
        
        $_SESSION['currentPost'] = [];

        if (!empty($currentPost)){

            header('Location: /post/' . $currentPost);
        
        }else {

            header("Location: /home");

        }


    } catch (Exception $e) {

        // echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
        header('Location: /contact?error=' . $mail->ErrorInfo);

    }
}
