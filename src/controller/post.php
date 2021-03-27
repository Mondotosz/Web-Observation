<?php

/**
 * @description Show post with a given id
 * @param string $postID : key to the post in json
 * @return void
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
        require_once "view/lost.php";
        lostView();
    }
}

/**
 * function createPost
 * @description handles post creation requests
 * @param array $request : contains post infos in an associative array, files are treated using the $_FILES global variable
 * @param array $files : contains file uploaded
 * @return void
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
                $index = 0;
                foreach ($files as $file) {
                    $result = saveImage($file, $postId, $index);
                    if ($result != 0) {
                        $imageNames[$index] = $result;
                        $index++;
                    }
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
 * @description handles post edition requests
 * @param int $postId : id of the post to edit
 * @param array $request : request array (expected $_POST)
 * @param array $files : uploaded files (expected $_FILES)
 * @return void
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
                $index = 0;
                foreach ($files as $file) {
                    $result = saveImage($file, $postId, $index);
                    if ($result != 0) {
                        $imageNames[$index] = $result;
                        $index++;
                    }
                }

                // compare amount of files to remove unused
                $postFileNames = [];
                foreach ($post["pictures"] as $picture) {
                    array_push($postFileNames, $picture["filename"]);
                }

                if (count($postFileNames) > count($imageNames)) {
                    $amount = count($postFileNames) - count($imageNames);
                    $offset = count($imageNames);
                    // Remove unused files
                    for ($i = 0; $i < $amount; $i++) {
                        removeImage($postFileNames[$offset + $i]);
                    }
                }

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
        } else {
            header("Location: /home");
        }
    } else {
        header("Location: /home");
    }
}

/**
 * @description handles post deletion requests
 * @param array $request : ["id"=>int]
 * @return void
 */
function deletePost($request)
{
    file_put_contents("log.log", print_r($request, true), FILE_APPEND);
    if (!empty($request)) {
        // get post and check ownership
        require_once "model/postsManager.php";
        $post = getPost(@$request["id"]);
        if (!empty($post) && $post["owner"] == $_SESSION["username"]) {
            // remove post
            removePost($request["id"]);
        }
        // send to home
        echo json_encode(["response" => "success"]);
    }
}
