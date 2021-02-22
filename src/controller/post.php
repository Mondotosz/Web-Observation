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
 * @param array $files : contains file uploaded
 */
function createPost($request, $files)
{
    file_put_contents("log.log", print_r($request, true) . print_r($files, true));
    // User needs to be authenticated to create a post
    if (!empty($_SESSION["username"])) {

        // file_put_contents("data/log.log", print_r($request, true));
        //dummy verification
        if (!empty($request)) {

            if (!empty($request["title"]) && !empty($request["description"]) && !empty($files)) {

                // Generate a post id by incrementing the amount of posts
                require_once "model/postsManager.php";
                $postID = count(getPosts()) + 1;
                $imageNames = [];

                // Save images
                require_once "model/imagesManager.php";
                foreach ($files as $key => $file) {
                    $imageNames[$key] = saveImage($file, $postID, $key);
                }

                // Save post
                require_once "model/postsManager.php";
                $post = createPostObject($request["title"], $request["description"], $imageNames, @$request["tags"], @$request["coordinates"], $_SESSION["username"]);
                addPost($postID, $post);

                // Answer depending on whether the request was sent via ajax or simple form
                // Compatibility reasons
                if (@$request["handler"] == "ajax") {
                    echo $postID;
                } else {
                    header("location:/post/$postID");
                }
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
