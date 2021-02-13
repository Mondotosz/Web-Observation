<?php

/**
 * @brief this file manages user authentication
 */

//login

function login($request)
{
    // check for empty request
    if (!empty($request)) {

        // checks if the required field are filled
        if (!empty($request["inputUsername"]) && !empty($request["inputPassword"])) {

            // gets user
            require_once "model/usersManager.php";
            $user = getUser($request["inputUsername"]);

            // checks password
            if ($user["password"] == $request["inputPassword"]) {
                $_SESSION["username"] = $request["inputUsername"];

                //redirects to /home
                header("Location: /home");
                require "view/home.php";
            } else {
                require_once "view/login.php";
            }
        } else {
            require_once "view/login.php";
        }
    } else {
        require_once "view/login.php";
    }
}

//logout
function logout($request)
{
    session_destroy();
    header("Location: /home");
    require_once "view/home.php";
}
