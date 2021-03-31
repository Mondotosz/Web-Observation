<?php
/**
 * @brief this file handles static views
 */

/**
 * @description displays home view
 * @return void
 */
function home()
{
    require_once "view/home.php";
    homeView();
}

/**
 * @description displays 404 page not found view
 * @return void
 */
function lost()
{
    require_once "view/lost.php";
    lostView();
}

/**
 * @description displays terms of services view
 */
function tOS()
{
    require_once "view/termsOfServices.php";
    tOSView();
}

/**
 * @description displays the about view
 */
function about()
{
    require_once "view/about.php";
    aboutView();
}