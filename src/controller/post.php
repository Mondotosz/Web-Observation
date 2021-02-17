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

        //dummy verification
        file_put_contents("data/post.json", ($request));
        if (!empty($request["post"])) {
            //check input validity
            //format and save images
            //save post using model
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
