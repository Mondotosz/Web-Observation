<?php

/**
 * @brief this model interacts with the post file
 */

/**
 * TODO: order by <argument>
 * TODO: create
 * TODO: filter
 * TODO: edit
 * TODO: delete
 * TODO: cascade
 * TODO: constraint verification
 */

/**
 * @description Read post file
 * @return array $posts containing every posts
 */

function getPosts()
{
    //checks if file exist
    if (file_exists("data/posts.json")) {
        //get content and directly translate it to an associative array
        $posts = json_decode(file_get_contents("data/posts.json"), true);
    } else {
        //initialize an empty array to avoid errors
        $posts = [];
    }

    return $posts;
}

/**
 * @description get a single post
 * @return array $post containing the requested post or an empty array
 */

function getPost($id)
{
    if (!empty(getPosts()[$id])) {
        $post = getPosts()[$id];
    } else {
        $post = [];
    }
    return $post;
}
