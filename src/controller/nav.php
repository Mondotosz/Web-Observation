<?php

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

function tOS()
{
    require_once "view/termsOfServices.php";
    tOSView();
}
function about()
{
    require_once "view/about.php";
    aboutView();
}