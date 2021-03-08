<?php

/**
 * @brief this model interacts with the post file
 */

/**
 * @description Read user file
 * @return array $users containing every users
 */

function getUsers()
{
    //checks if file exist
    if (file_exists("data/users.json")) {
        //get content and directly translate it to an associative array
        $users = json_decode(file_get_contents("data/users.json"), true);
    } else {
        //initialize an empty array to avoid errors
        $users = [];
    }

    return $users;
}

/**
 * @description gets a specific user
 * @return array $user containing requested user, empty response when the user doesn't exist
 */

function getUser($username)
{
    if (!empty(getUsers()[$username])) {
        $user = getUsers()[$username];
    } else {
        $user = [];
    }
    return $user;
}

/**
 * @description Add an user to the users file
 * @return boolean $success true => user saved | false => couldn't save the user
 */

function addUser($username, $password, $email)
{
    $success = true;

    // Check for existing users with the same email or username
    $users = getUsers();

    // check username first to avoid unnecessary loops
    if (!isset($users[$username])) {

        // go through each existing users to check for email
        foreach ($users as $user) {
            //TODO: check whether this breaks anything
            //TODO: find a good way to break
            if ($user["email"] == $email) {
                $success = false;
                break;
            }
        }

        // if still successful
        if ($success) {
            // set timezone for creation date
            date_default_timezone_set("Europe/Zurich");
            // add new user to the users array
            // ! due to the limitations of json here if multiple users register at the same time there is a risk of overwriting
            $users[htmlspecialchars($username)] = ["creationDate" => date("d.m.Y"), "password" => $password, "email" => htmlspecialchars($email)];
            // save to file
            file_put_contents("data/users.json", json_encode($users));
        }
    } else {

        $success = false;
    }
    // Add the user

    return $success;
}
