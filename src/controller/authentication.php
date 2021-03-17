<?php

/**
 * @brief this file manages user authentication
 */

/**
 * @description Manages login request redirects to login view on bad login
 * @TODO add error messages
 * @param array $request : Expect an array with ["inputUsername"=>string, "inputPassword"=>string]
 * @return void
 */
function login($request)
{
    require_once "view/login.php";

    // Check if user is unauthenticated
    if (!isAuthenticated()) {
        // Check for empty request data
        if (!empty($request)) {
            // Checks if the required field are filled
            if (!empty($request["inputUsername"]) && !empty($request["inputPassword"])) {
                // Sanitize input
                $request["inputUsername"] = htmlspecialchars($request["inputUsername"], ENT_QUOTES);

                // Gets user
                require_once "model/usersManager.php";
                $user = getUser($request["inputUsername"]);

                // Checks password
                if (password_verify(@$request["inputPassword"], @$user["password"])) {
                    createSession($request["inputUsername"]);

                    // Redirects to /home
                    header("Location: /home");
                } else {
                    header("Location: /login?error=pswNotRight", true);
                }
            } else {
                header("Location: /login?error=emptyFields", true);
            }
        } else {
            loginView();
        }
    } else {
        header("Location: /home");
    }
}

/**
 * @description create session variables
 * @param string $username
 * @return void
 */
function createSession($username)
{
    $_SESSION["username"] = $username;
}

/**
 * @description destroys user session and redirects to /home
 * @return void
 */
function logout()
{
    session_destroy();
    header("Location: /home");
}

/**
 * @description Manages register request redirects to register view on bad input ()
 * @param array $request : Expect an array with ["inputUsername"=>string, "inputPassword"=>string, "inputEmail"=>string]
 * @return void
 */
function register($request)
{
    require_once "view/register.php";

    // User already logged in
    if (!isAuthenticated()) {
        // Empty request data
        if (!empty($request)) {
            // checks if the required field are filled
            if (!empty($request["inputUsername"]) && !empty($request["inputPassword"]) && !empty($request["inputEmail"])) {
                // Sanitize input
                $request["inputUsername"] = htmlspecialchars($request["inputUsername"]);
                $request["inputEmail"] = htmlspecialchars($request["inputEmail"]);

                // Hash password
                $hashedPassword = password_hash($request["inputPassword"], PASSWORD_DEFAULT);

                // Try to add user
                require_once "model/usersManager.php";
                if (addUser($request["inputUsername"], $hashedPassword, $request["inputEmail"])) {
                    // login to created account
                    createSession($request["inputUsername"]);

                    //redirects to /home
                    header("Location: /home");
                } else {
                    header("Location: /register?error=emailAlreadyUsed", true);
                }
            } else {
                header("Location: /register?error=emptyFields", true);
            }
        } else {
            registerView();
        }
    } else {
        header("Location: /home");
    }
}

/**
 * @description checks if the user is logged in
 * @return bool true if the user is logged in
 */
function isAuthenticated()
{
    return isset($_SESSION["username"]);
}
