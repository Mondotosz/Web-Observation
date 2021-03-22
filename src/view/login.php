<?php

/**
 * @file register.php
 * @author Created by Kenan.Augsburger@cpnv.ch
 * @version 0.1 / 14.02.2021
 */

/**
 * @description render the login view
 * @return void
 */
function loginView()
{

    $title = "login";

    // Content
    ob_start();
?>
    <?php /** this div is used to center and resize the login form */ ?>
    <div class="row w-auto mx-0 px-2 pt-5">
        <?php /** dummy div */ ?>
        <div class="col-0 col-md-3 col-xl-4"></div>
        <form class="border rounded-2 p-4 col-12 col-md-6 col-xl-4" method="post" action="/login">
            <div class="mb-3">
                <label for="inputUsername" class="form-label" required>Username</label>
                <input type="text" class="form-control" id="inputUsername" name="inputUsername" placeholder="e.g Mon">
            </div>
            <div class="mb-3">
                <label for="inputPassword" class="form-label" required>Password</label>
                <input type="password" class="form-control" id="inputPassword" name="inputPassword">
            </div>
            <div class="mb-3">
            <button type="submit" class="btn btn-primary me-3">Login</button>
                <small class="">Don't have any account? Go to <a href="/register">register</a>.</small>
            </div>
        </form>
        <?php /** dummy div */ ?>
        <div class="col-0 col-md-3 col-xl-4"></div>
    </div>
<?php

    $content = ob_get_clean();
    require_once "view/template.php";
    renderTemplate($title, $content);
}
