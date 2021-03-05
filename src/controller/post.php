<?php

/**
 * @function showPost
 * @description 
 * @param string $postID : key to the post in json
 */
function showPost($postId)
{
    // get the requested post
    require_once "model/postsManager.php";
    $post = getPost($postId);

    // checks if it exist
    if (!empty($post)) {
        // redirects to post view
        require_once "view/post.php";
        showPostView($post, $postId);
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
    // User needs to be authenticated to create a post
    if (!empty($_SESSION["username"])) {

        // file_put_contents("data/log.log", print_r($request, true));
        //dummy verification
        if (!empty($request)) {

            if (!empty($request["title"]) && !empty($request["description"]) && !empty($files)) {

                // Generate a post id by incrementing the amount of posts
                require_once "model/postsManager.php";
                $postId = reservePost();
                $imageNames = [];

                // Save images
                require_once "model/imagesManager.php";
                foreach ($files as $key => $file) {
                    $imageNames[$key] = saveImage($file, $postId, $key);
                }

                // Save post
                require_once "model/postsManager.php";
                $post = createPostObject($request["title"], $request["description"], $imageNames, @$request["tags"], @$request["coordinates"], $_SESSION["username"]);
                $res = setPost($postId, $post);

                // Answer depending on whether the request was sent via ajax or simple form
                if (@$request["handler"] == "ajax") {
                    if (!$res) {
                        echo json_encode(["response" => "fail", "error" => "unable to save post"]);
                    } else {
                        echo json_encode(["response" => "success", "postId" => $postId]);
                    }
                } else {
                    header("location:/post/$postId");
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

/**
 * @function editPost
 * @description handles post edition requests
 * @param int $postId : id of the post to edit
 * @param array $request : request array (expected $_POST)
 * @param array $files : uploaded files (expected $_FILES)
 */
function editPost($postId, $request, $files)
{
    if (!empty($postId)) {
        // get post and check ownership
        require_once "model/postsManager.php";
        $post = getPost($postId);

        if (!empty($post) && $post["owner"] == $_SESSION["username"]) {

            if (!empty($request)) {

                $imageNames = [];

                // Save images
                require_once "model/imagesManager.php";
                foreach ($files as $key => $file) {
                    $imageNames[$key] = saveImage($file, $postId, $key);
                }

                file_put_contents("log.log", print_r($imageNames, true));


                // create post object
                $post = createPostObject($request["title"], $request["description"], $imageNames, @$request["tags"], @$request["coordinates"], $_SESSION["username"]);

                // set post
                $res = setPost($postId, $post);

                // Answer depending on whether the request was sent via ajax or simple form
                if (@$request["handler"] == "ajax") {
                    if (!$res) {
                        echo json_encode(["response" => "fail", "error" => "unable to save post"]);
                    } else {
                        echo json_encode(["response" => "success", "postId" => $postId]);
                    }
                } else {
                    header("location:/post/$postID");
                }
            } else {
                require_once "view/editPost.php";
                editPostView($post);
            }
        }
    } else {
        header("Location: /home");
    }
}

/**
 * @function deletePost
 * @description handles post deletion requests
 * @param int $postId : id of the post to delete
 */
function deletePost($postId)
{
    if (!empty($postId)) {
        // get post and check ownership
        require_once "model/postsManager.php";
        $post = getPost($postId);
        if (!empty($post) && $post["owner"] == $_SESSION["username"]) {
            // remove post
            removePost($postId);
        }
        // send to home
        header("Location: /home");
    }
}
