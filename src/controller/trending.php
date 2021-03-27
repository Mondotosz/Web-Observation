<?php

//TODO : refactor trending to a more fitting name

/**
 * @description gets every post and displays them in a single view
 * @param array $request : expect $_GET with search and filter values
 * @return void
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
        if (empty($post)) {
            unset($posts[$key]);
        } else {
            $posts[$key]["id"] = $key;
        }
    }

    // Filter

    // Search for a given string
    if (!empty($request["search"])) {
        $search = preg_quote($request["search"]);
        $search = preg_replace("/\//", "\/", $search);
        $pattern = "/$search/i";
        foreach ($posts as $key => $post) {
            if ((!preg_match($pattern, print_r($post, true)))) {
                unset($posts[$key]);
            }
        }
    }

    // Check if user uses advanced filters
    if (@$request["filter"] == "true") {
        // Filter by title

        if (!empty($request["title"])) {
            $search = preg_quote($request["title"]);
            $search = preg_replace("/\//", "\/", $search);
            $pattern = "/$search/i";

            foreach ($posts as $key => $post) {
                if (!preg_match($pattern, $post["title"])) {
                    unset($posts[$key]);
                }
            }
        }

        // Filter by author
        if (!empty($request["author"])) {
            $search = preg_quote($request["author"]);
            $search = preg_replace("/\//", "\/", $search);
            $pattern = "/$search/i";

            foreach ($posts as $key => $post) {
                if (!preg_match($pattern, $post["owner"])) {
                    unset($posts[$key]);
                }
            }
        }

        // Filter by tags
        if (!empty($request["tags"])) {
            foreach ($posts as $key => $post) {
                foreach ($request["tags"] as $tag) {
                    $search = preg_quote($tag);
                    $search = preg_replace("/\//", "\/", $search);

                    if (!preg_grep("/^$search$/i", $post["tags"])) {
                        unset($posts[$key]);
                    }
                }
            }
        }
    }

    switch (@$request["orderBy"]) {
        case "old":
            usort($posts, "sortByDateOld");
            break;
        case "new":
        default:
            usort($posts, "sortByDateNew");
    }


    // initialize an empty card array
    $cards = [];

    // creates a card with each post title and first picture
    foreach ($posts as $post) {
        // verify if the necessary values exist
        // might become obsolete with good constraints in the model
        if (!empty($post["title"]) && !empty($post["pictures"][0]["filename"])) {
            array_push($cards, getComponent($post["title"], "/view/content/img/thumbnail/" . $post["pictures"][0]["filename"], "/post/" . $post["id"]));
        }
    }

    // send cards to the trending view
    require_once "view/trending.php";
    trendingView($cards);
}

function sortByDateNew($a, $b)
{
    return date_create_from_format("d.m.Y", $b['date'])->getTimestamp() - date_create_from_format("d.m.Y", $a['date'])->getTimestamp();
}

function sortByDateOld($a, $b)
{
    return date_create_from_format("d.m.Y", $a['date'])->getTimestamp() - date_create_from_format("d.m.Y", $b['date'])->getTimestamp();
}
