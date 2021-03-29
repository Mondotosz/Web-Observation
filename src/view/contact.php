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
function contactView()
{

    $title = "contact";

    // Content
    ob_start();
?>
    <?php /** this div is used to center and resize the register form */ ?>
    <div class="row w-auto mx-0 px-2 pt-5">
        <?php /** dummy div */ ?>
        <div class="col-0 col-md-3 col-xl-4"></div>
        <form class="border rounded-2 p-4 col-12 col-md-6 col-xl-4" method="POST" action="/register">
            <div class="mb-3" id="errorArea">
            </div>
            <div class="mb-3">
                <label for="inputEmail" class="form-label" required>Email</label>
                <input type="email" class="form-control" id="inputEmail" name="inputEmail" placeholder="Bob.Ross@art.com">
            </div>
            <div class="mb-3">
                <label for="inputText" class="form-label" required>Text</label>
                <textarea class="form-control" id="inputText" name="inputText" placeholder="Dear author, I really love your photos." style="min-height: 250px"></textarea>
            </div>
            <div class="mb-3">
                <button type="submit" class="btn btn-primary me-3" id="btnRegister">Send</button>
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
    <script type="module" src="view/js/checkUsername.js"></script>
<?php
    $scripts = ob_get_clean();

    require_once "view/template.php";
    renderTemplate($title, $content, null, null, $scripts);
}
