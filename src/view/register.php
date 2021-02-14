<?php

/**
 * @file lost.php
 * @brief Centralizes all common graphical components like header and footer
 * @author Created by Kenan.Augsburger@cpnv.ch
 * @version 0.1 / 03.02.2021
 */

ob_start();
$title = "register";

?>
<form method="post" action="/register">
    <div class="mb-3">
        <label for="inputEmail" class="form-label">Email</label>
        <input type="email" class="form-control" id="inputEmail" name="inputEmail">
    </div>
    <div class="mb-3">
        <label for="inputUsername" class="form-label">Username</label>
        <input type="text" class="form-control" id="inputUsername" name="inputUsername">
    </div>
    <div class="mb-3">
        <label for="inputPassword" class="form-label">Password</label>
        <input type="password" class="form-control" id="inputPassword" name="inputPassword">
    </div>
    <button type="submit" class="btn btn-primary">Submit</button>
</form>
<?php

$content = ob_get_clean();
require_once "view/template.php";
