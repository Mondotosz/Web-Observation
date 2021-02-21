<?php

/**
 * @function home]
 * @description displays home view
 */
function home()
{
    require_once "view/home.php";
    homeView();
}

/**
 * @function lost
 * @description displays 404 page not found view
 */
function lost()
{
    require_once "view/lost.php";
    lostView();
}
