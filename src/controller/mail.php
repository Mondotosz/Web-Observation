<?php

function sendMail(){

    require_once 'model/sendmail.php';

    require_once 'model/usersManager.php';

    $targetEmail = getUser($_POST['target']);

    mailTo($targetEmail['email'], $_POST['inputText'], $_POST['inputSignature']);

}