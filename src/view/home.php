<?php

/**
 * @file home.php
 * @brief View for the homepage
 * @author Created by Kenan.Augsburger@cpnv.ch
 * @version 0.1 / 03.02.2021
 */

$title = "home";
ob_start();

$content = ob_get_clean();
?>
<h1>Hello world</h1>
<?
require_once "view/template.php";