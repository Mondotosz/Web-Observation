<?php

/**
 * @file register.php
 * @author Created by Kenan.Augsburger@cpnv.ch
 * @version 0.1 / 14.02.2021
 */

/**
 * @description render the registration view
 * @return void
 */
function registerView()
{

    $title = "register";

    // Content
    ob_start();
?>
    <?php /** this div is used to center and resize the register form */ ?>
    <div class="row w-auto mx-0 px-2 pt-5">
        <?php /** dummy div */ ?>
        <div class="col-0 col-md-3 col-xl-4"></div>
        <form class="border rounded-2 p-4 col-12 col-md-6 col-xl-4" method="POST" action="/register">
            <div class="mb-3">
                <label for="inputEmail" class="form-label" required>Email</label>
                <input type="email" class="form-control" id="inputEmail" name="inputEmail" placeholder="Bob.Ross@art.com" value="<?= $_POST['inputEmail'] ?? "" ?>">
            </div>
            <div class="mb-3">
                <label for="inputUsername" class="form-label" required>Username</label>
                <input type="text" class="form-control" id="inputUsername" name="inputUsername" placeholder="BRoss" value="<?= $_POST['inputUsername'] ?? "" ?>">
            </div>
            <div class="mb-3">
                <label for="inputPassword" class="form-label" required>Password</label>
                <input type="password" class="form-control" id="inputPassword" name="inputPassword" value="<?= $_POST['inputPassword'] ?? "" ?>">
            </div>
            <div class="mb-3">
                <label for="inputPasswordCheck" class="form-label" required>Confirm password</label>
                <input type="password" class="form-control" id="inputPasswordCheck" name="inputPasswordCheck" value="<?= $_POST['inputPasswordCheck'] ?? "" ?>">
            </div>
            <div class="mb-3">
                <input type="checkbox" class="form-check-input" id="inputTOS">
                <label for="inputTOS" class="form-label">I have read the <a href="/termsOfServices">terms of services</a> and I accepted them.</label>
            </div>
            <div class="mb-3">
            <button type="submit" class="btn btn-primary me-3" id="btnRegister">Register</button>
                <small>Already have an account? Go to <a href="/login">login</a>.</small>
            </div>
        </form>
        <?php /** dummy div */ ?>
        <div class="col-0 col-md-3 col-xl-4"></div>
    </div>

    <?php

    $content = ob_get_clean();

    ob_start();
    ?>
    <script type="module" src="view/js/register.js"></script>
<?php
    $scripts = ob_get_clean();

    require_once "view/template.php";
    renderTemplate($title, $content, null, null, $scripts);
}
