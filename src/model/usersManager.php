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
