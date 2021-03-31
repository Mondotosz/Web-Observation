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
function contactUsView()
{

    $title = "contact";

    // Content
    ob_start();
?>
    <?php /** this div is used to center and resize the register form */ ?>
    <div class="row w-auto mx-0 px-2 pt-5">
        <?php /** dummy div */ ?>
        <div class="col-0 col-md-3 col-xl-4"></div>
        <form class="border rounded-2 p-4 col-12 col-md-6 col-xl-4" method="POST" action="/sendMailToUs">
            <div class="mb-3" id="errorArea">
                <?php
                if ($_GET['error'] == "Message body empty") {
                    echo "the body is empty";
                }
                ?>
            </div>
            <div class="mb-3">
                <h3>Contact Us</h3>
            </div>
            <div class="mb-3">
                <label for="inputText" class="form-label" required>Description</label>
                <textarea class="form-control" id="inputText" name="inputText" placeholder="Dear developper, I'm sending you this because I've spotted a bug on you site" style="min-height: 250px"></textarea>
            </div>
            <input type="hidden" value="<?= $_GET['target'] ?>" name="target">
            <div class="mb-3">
                <button type="submit" class="btn btn-primary me-3" id="btnSend">Send</button>
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
