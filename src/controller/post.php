<?php

// Show post
function showPost($postID)
{
    require_once "model/postsManager.php";
    $post = getPost($postID);

    if (!empty($post)) {
        require_once "view/post.php";
    } else {
        //redirects to lost
        require "view/lost.php";
    }
}

// New post
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
