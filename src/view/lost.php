<?php

/**
 * @file lost.php
 * @brief Centralizes all common graphical components like header and footer
 * @author Created by Kenan.Augsburger@cpnv.ch
 * @version 0.1 / 03.02.2021
 */

$title = "404";
ob_start();

$content = ob_get_clean();
?>
<h1>404 : Page not found</h1>
<?
require_once "view/template.php";
