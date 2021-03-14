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

/**
 * @description creates a post object
 * @param string $title post title
 * @param string $description post description
 * @param array $fileNames name of each image file with extension (expected["id-index.jpg"])
 * @param array $tags array of tags for the post
 * @param array $coordinates post coordinates (expected ["lon"=>"x","lat"=>"y"])
 * @param string $owner post owner, defaults to $_SESSION["username"]
 * @return array $post new post
 */
function createPostObject($title, $description, $fileNames, $tags = null, $coordinates = null, $owner = null)
{
    // Save post using model
    $post = [
        "owner" => $owner ?? $_SESSION["username"],
        "title" => htmlspecialchars($title),
        "description" => htmlspecialchars($description),
        "date" => Date("d.m.Y"),
        "coordinates" => [
            "lon" => htmlspecialchars($coordinates["lon"]) ?? "dummy",
            "lat" => htmlspecialchars($coordinates["lat"]) ?? "dummy"
        ],
        "tags" => []
    ];

    // Filename
    foreach ($fileNames as $name) {
        $post["pictures"][] = ["filename" => $name];
    }

    // Tags
    foreach (@$tags as $tag) {
        array_push($post["tags"], htmlspecialchars($tag));
    }

    return $post;
}

/**
 * @description reserve an id in the post json and return it
 * @return int $id : int value of the index reserved
 */
function reservePost()
{
    // get every post
    $posts = getPosts();
    // get the next id
    $id = intval(array_key_last($posts)) + 1;
    // add a new entry
    $post[$id] = [];
    // Encode to json
    $posts = json_encode($posts);
    // Check id data directory exist and creates it if it doesn't
    file_exists("data") ?: mkdir("data");
    // Write to posts.json
    file_put_contents("data/posts.json", $posts);

    return $id;
}

/**
 * @description set a post object with a given id
 * @param int|string $id : post id
 * @param array $post : associated array defined in createPostObject
 * @return int|false int value if successful|false when fail 
 */
function setPost($id, $post)
{
    // Get every posts
    $posts = getPosts();
    // Set id to selected post
    $posts[strval($id)] = $post;
    // Encode to json
    $posts = json_encode($posts);
    // Check id data directory exist and creates it if it doesn't
    file_exists("data") ?: mkdir("data");
    // Write to posts.json
    $res = file_put_contents("data/posts.json", $posts);

    return $res;
}

/**
 * @description unset given post index from posts
 * @param int $id id of the post to remove
 * @return int | false : number of bytes written | false on error
 */
function removePost($id)
{
    // Get every posts
    $posts = getPosts();
    // Set id to selected post
    $posts[strval($id)] = null;
    // Encode to json
    $posts = json_encode($posts);
    // Check id data directory exist and creates it if it doesn't
    file_exists("data") ?: mkdir("data");
    // Write to posts.json
    $res = file_put_contents("data/posts.json", $posts);

    return $res;
}
