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
        showPostView($post);
    } else {
        //redirects to lost
        require "view/lost.php";
        lostView();
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

                // Generate a post id by incrementing the amount of posts
                require_once "model/postsManager.php";
                $postID = count(getPosts()) + 1;
                $imageNames = [];

                require_once "model/imagesManager.php";
                foreach ($_FILES as $key => $file) {
                    $imageNames[$key] = saveImage($file, $postID, $key);
                }

                //TODO Handle images, coordinates etc and create model

                //save post using model
                $post = [$postID => [
                    "owner" => $_SESSION["username"],
                    "title" => $request["postTitle"],
                    "description" => $request["postDescription"],
                    "date" => Date("d.m.Y"),
                    "coordinates" => [
                        "lon" => "dummy",
                        "lat" => "dummy"
                    ]
                ]];

                //save filename
                foreach ($imageNames as $key => $name) {
                    $post[$postID]["pictures"][] = ["filename" => $name];
                }

                //TODO add it to the existing posts via model
                file_put_contents("data/test.post.json", json_encode($post, JSON_PRETTY_PRINT));

                header("location:/home");
            }
        } else {
            //redirects to post creation page
            require_once "view/createPost.php";
            createPostView();
        }
    } else {
        //redirects to login page
        header("Location: /login");
    }
}
