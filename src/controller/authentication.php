<?php

/**
 * @brief this file manages user authentication
 */

/**
 * @function login
 * @description Manages login request redirects to login view on bad login
 * @TODO add error messages
 * @param array $request : Expect an array with ["inputUsername"=>string, "inputPassword"=>string]
 */
function login($request)
{
    require_once "view/login.php";
    // check for empty request
    if (!empty($request)) {

        // checks if the required field are filled
        if (!empty($request["inputUsername"]) && !empty($request["inputPassword"])) {

            // gets user
            require_once "model/usersManager.php";
            $user = getUser($request["inputUsername"]);

            // checks password
            //@$user["password"] == @$request["inputPassword"]
            if (password_verify(@$request["inputPassword"], @$user["password"])) {
                createSession($request["inputUsername"]);

                //redirects to /home
                header("Location: /home");
                require "view/home.php";
                homeView();
            } else {
                header("Location: /login?error=pswNotEqual",true);
            }
        } else {
            header("Location: /login?error=emptyFields",true);
        }
    } else {
        loginView();
    }
}

/**
 * @function createSession
 * @description create session variables
 * @param string $username
 */
function createSession($username)
{
    $_SESSION["username"] = $username;
}

/**
 * @function logout
 * @description destroys user session and redirects to /home
 */
function logout()
{
    session_destroy();
    header("Location: /home");
}

/**
 * @function register
 * @description Manages register request redirects to register view on bad input ()
 * @TODO add error messages
 * @param array $request : Expect an array with ["inputUsername"=>string, "inputPassword"=>string, "inputEmail"=>string]
 */
function register($request)
{
    require_once "view/register.php";
    // check for empty request
    if (!empty($request)) {

        // checks if the required field are filled
        if (!empty($request["inputUsername"]) && !empty($request["inputPassword"]) && !empty($request["inputEmail"])) {

            // Hash password
            $hashedPassword = password_hash($request["inputPassword"], PASSWORD_DEFAULT);

            // try to add user
            require_once "model/usersManager.php";
            if (addUser($request["inputUsername"], $hashedPassword, $request["inputEmail"])) {
                // login to created account
                createSession($request["inputUsername"]);

                //redirects to /home
                header("Location: /home");
            } else {
                header("Location: /login?error=creationFailed", true);
            }
        } else {
            header("Location: /login?error=emptyFields", true);
        }
    } else {
        registerView();
    }
}
