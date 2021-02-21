<?php

/**
 * @function trending
 * @description gets every post and displays them in a single view
 */
function trending()
{
    require_once "view/content/components/cards.php";
    require_once "model/postsManager.php";

    // get every existing posts
    // TODO: add a limit
    $posts = getPosts();

    // initialize an empty card array
    $cards = [];

    // creates a card with each post title and first picture
    foreach ($posts as $key => $post) {
        // verify if the necessary values exist
        // might become obsolete with good constraints in the model
        if (!empty($post["title"]) && !empty($post["pictures"][0]["path"])) {
            array_push($cards, getComponent($post["title"], $post["pictures"][0]["path"], "/post/" . $key));
        }
    }

    // send cards to the trending view
    require_once "view/trending.php";
    trendingView($cards);
}
