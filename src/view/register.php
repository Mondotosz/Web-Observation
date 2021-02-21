<?php

/**
 * @file register.php
 * @author Created by Kenan.Augsburger@cpnv.ch
 * @version 0.1 / 14.02.2021
 */

//TODO : add confirm password field and logic

ob_start();
$title = "register";

?>
<?php/** this div is used to center and resize the register form */?>
<div class="row w-auto mx-0 px-2 pt-5">
    <?php/** dummy div */?>
    <div class="col-0 col-md-3 col-xl-4"></div>
    <form class="border rounded-2 p-4 col-12 col-md-6 col-xl-4" method="post" action="/register">
        <div class="mb-3">
            <label for="inputEmail" class="form-label" required>Email</label>
            <input type="email" class="form-control" id="inputEmail" name="inputEmail">
        </div>
        <div class="mb-3">
            <label for="inputUsername" class="form-label" required>Username</label>
            <input type="text" class="form-control" id="inputUsername" name="inputUsername">
        </div>
        <div class="mb-3">
            <label for="inputPassword" class="form-label" required>Password</label>
            <input type="password" class="form-control" id="inputPassword" name="inputPassword">
        </div>
        <button type="submit" class="btn btn-primary">Register</button>
    </form>
    <?php/** dummy div */?>
    <div class="col-0 col-md-3 col-xl-4"></div>
</div>

<?php

$content = ob_get_clean();
require_once "view/template.php";
