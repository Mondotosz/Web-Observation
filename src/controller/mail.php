<?php

function sendMail($isForUs)
{
    require_once 'model/sendmail.php';

    require_once 'model/usersManager.php';

    $username = $_SESSION['username'];
    $mailFrom = $_SESSION['email'];
    $text = $_POST['inputText'];

    if ($isForUs) {
        if (!empty($_SESSION['username'])) {

            $mailTo = "contact@photify.mycpnv.ch";

            mailTo($mailTo, $text, $username, $mailFrom);
        } else {
            header('Location: /home');
        }
    } else {
        if (!empty($_SESSION['username'])) {

            $targetEmail = getUser($_POST['target']);

            $mailTo = $targetEmail['email'];

            mailTo($mailTo, $text, $username, $mailFrom);
        } else {
            header('Location: /home');
        }
    }
}
