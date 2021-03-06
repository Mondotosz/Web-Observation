<?php

//TODO : refactor trending to a more fitting name

/**
 * @function trending
 * @description gets every post and displays them in a single view
 * @param array $request : expect $_GET with search and filter values
 */
function trending($request)
{
    require_once "view/content/components/cards.php";
    require_once "model/postsManager.php";

    // get every existing posts
    // TODO: add a limit
    $posts = getPosts();

    // TODO: check if it should be implemented in the model when saving posts
    // Remove null values for safety
    foreach ($posts as $key => $post) {
        if (empty($post)) unset($posts[$key]);
    }

    // Filter

    // Search for a given string
    if (!empty($request["search"])) {
        foreach ($posts as $key => $post) {
            if (!preg_grep('/' . $request["search"] . '/i', $post)) {
                unset($posts[$key]);
            }
        }
    }

    // Check if user uses advanced filters
    if (@$request["filter"] == "true") {
        // Filter by title
        if (!empty($request["title"])) {
            foreach ($posts as $key => $post) {
                if (!preg_match('/' . $request["title"] . '/i', $post["title"])) {
                    unset($posts[$key]);
                }
            }
        }

        // Filter by author
        if (!empty($request["author"])) {
            foreach ($posts as $key => $post) {
                if (!preg_match('/' . $request["author"] . '/i', $post["owner"])) {
                    unset($posts[$key]);
                }
            }
        }

        // Filter by tags
        if (!empty($request["tags"])) {
            foreach ($posts as $key => $post) {
                foreach ($request["tags"] as $tag) {
                    if (!preg_grep("/^$tag$/i", $post["tags"])) {
                        unset($posts[$key]);
                    }
                }
            }
        }
    }

    // initialize an empty card array
    $cards = [];

    // creates a card with each post title and first picture
    foreach ($posts as $key => $post) {
        // verify if the necessary values exist
        // might become obsolete with good constraints in the model
        if (!empty($post["title"]) && !empty($post["pictures"][0]["filename"])) {
            array_push($cards, getComponent($post["title"], "/view/content/img/thumbnail/" . $post["pictures"][0]["filename"], "/post/" . $key));
        }
    }

    // send cards to the trending view
    require_once "view/trending.php";
    trendingView($cards);
}
