<?php

/**
 * @function showPost
 * @description 
 * @param string $postID : key to the post in json
 */
function showPost($postID)
{
    // get the requested post
    require_once "model/postsManager.php";
    $post = getPost($postID);

    // checks if it exist
    if (!empty($post)) {
        // redirects to post view
        require_once "view/post.php";
    } else {
        //redirects to lost
        require "view/lost.php";
    }
}

/**
 * function createPost
 * @description handles post creation requests
 * @param array $request : contains post infos in an associative array, files are treated using the $_FILES global variable
 */
function createPost($request)
{
    // User needs to be authenticated to create a post
    if (!empty($_SESSION["username"])) {

        // file_put_contents("data/log.log", print_r($request, true));
        //dummy verification
        if (!empty($request)) {

            if (!empty($request["postTitle"]) && !empty($request["postDescription"])) {

                $post = ["postID" => [
                    "owner" => $_SESSION["username"],
                    "title" => $request["postTitle"],
                    "description" => $request["postDescription"],
                    "date" => Date("d.m.Y"),
                    "coordinates" => [
                        "lon" => "dummy",
                        "lat" => "dummy"
                    ]
                ]];

                file_put_contents("log.log", print_r($_FILES, true));

                //format and save images
                foreach ($_FILES as $key => $file) {
                    $name = basename($file["name"]);
                    move_uploaded_file($file["tmp_name"], "view/content/img/original/" . $name);
                    // file_put_contents("view/content/img/original/" . $key . ".png", $file);
                }

                //TODO Handle images, coordinates etc and create model
                //save post using model
            }
        } else {
            //redirects to post creation page
            require "view/createPost.php";
        }
    } else {
        //redirects to login page
        header("Location: /login");
        require "view/login.php";
    }
}
