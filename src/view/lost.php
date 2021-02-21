<?php

/**
 * @file lost.php
 * @brief Centralizes all common graphical components like header and footer
 * @author Created by Kenan.Augsburger@cpnv.ch
 * @version 0.1 / 03.02.2021
 */
function lostView()
{

    ob_start();
    $title = "404";

?>
    <h1 class="mx-auto pt-5" style="width:fit-content;">404 : Page not found</h1>
<?php

    $content = ob_get_clean();
    require_once "view/template.php";
    renderTemplate($title, $content);
}
