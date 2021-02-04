<?php

/**
 * @file home.php
 * @brief View for the homepage
 * @author Created by Kenan.Augsburger@cpnv.ch
 * @version 0.1 / 03.02.2021
 */

ob_start();
$title = "home";

?>

    <h1>Hello world</h1>

<?php

$content = ob_get_clean();

require_once "view/template.php";