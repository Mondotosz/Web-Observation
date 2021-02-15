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
