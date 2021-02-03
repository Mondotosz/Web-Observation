<?php

/**
 * @file index.php
 * @brief This is the rooter, it handles requests and redirect them to the correct controller
 * @author Created by Kenan.Augsburger@cpnv.ch
 * @version 0.1 / 03.02.2021
 */

// Creates/Resumes a sessions
session_start();
require_once "controller/nav.php";

switch ($_SERVER["REQUEST_URI"]) {
    case "/":
    case "/home":
        home();
        break;
    default:
        lost();
}
