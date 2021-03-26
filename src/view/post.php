<?php

/**
 * @file post.php
 * @author Created by Kenan.Augsburger@cpnv.ch
 * @version 0.1 / 15.02.2021
 */

/**
 * @description render post view
 * @param array $post containing post name etc.
 * @param int $postId containing post id used for referencing
 * @return void
 */

function showPostView($post, $postId)
{

    $title = $post["title"];

    // Head
    ob_start();
?>
    <link rel="stylesheet" href="/view/css/post.css">
    <style>
        html,
        body {
            height: 100%;
            margin: 0;
        }

        #map {
            /* configure the size of the map */
            width: 100%;
            height: 100%;
        }
    </style>
    <?php
    $head = ob_get_clean();
    // Scripts
    ob_start();
    ?>
    <script src="/view/js/fullscreenImage.js"></script>
    <script type="module" src="/view/js/postDeletion.js"></script>
    <?php
    $script = ob_get_clean();

    // Content
    ob_start();
    ?>
    <?php /** this div is used to center and resize the register form */

    $owner = @$post['owner'];
    $desc = @$post['description'];
    $date = @$post['date'];
    $lat = @$post['coordinates']['lat'];
    $lon = @$post['coordinates']['lon'];

    ?>
    <div class="row p-3 m-0 g-2">
        <?php /** images and map */ ?>
        <div class="col-12">

            <div id="postCarousel" class="carousel slide" data-bs-ride="carousel">
                <div class="carousel-indicators">
                    <?php
                    foreach ($post["pictures"] as $key => $picture) {
                    ?>
                        <button type="button" data-bs-target="#postCarousel" data-bs-slide-to="<?= $key ?>" class="border rounded-3 pb-2 mb-2 btn-primary w-25 <?= ($key === array_key_first($post["pictures"]) ? " active" : "") ?>" <?= ($key === array_key_first($post["pictures"]) ? "aria-current=\"true\"" : "") ?> aria-label="Slide <?= $key ?>"></button>
                    <?php
                    }
                    ?>

                </div>
                <div class="carousel-inner">
                    <?php
                    foreach ($post["pictures"] as $key => $picture) {
                    ?>
                        <div class="carousel-item text-center<?= ($key === array_key_first($post["pictures"]) ? " active" : "") ?>">
                            <?php /** image with hotfix defined height */ ?>
                            <div onclick="toggleFullScreen('<?= @$picture['filename'] ?>')" id="<?= @$picture['filename'] ?>" style="height:800px;background:black url(<?= "/view/content/img/original/" . @$picture["filename"] ?>) no-repeat center center; background-size: contain;" loading="lazy" class="w-100" href="<?= @$picture['path'] ?>"></div>
                        </div>

                    <?php
                    }
                    ?>
                </div>
                <a href="#postCarousel" class="carousel-control-prev" type="button" data-bs-target="#postCarousel" data-bs-slide="prev">
                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                    <span class="visually-hidden">Previous</span>
                </a>
                <a href="#postCarousel" class="carousel-control-next" type="button" data-bs-target="#postCarousel" data-bs-slide="next">
                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                    <span class="visually-hidden">Next</span>
                </a>
                <?php
                if (@$_SESSION["username"] == $post["owner"]) {
                ?>
                    <a id="btnDeletePost" href="/post/delete" class="btn btn-danger btn-trash"></a>
                    <a href="/post/<?= $postId ?>/edit" class="btn btn-primary btn-edit"></a>
                <?php
                }
                ?>
            </div>

        </div>
        <?php /** title and description */ ?>
        <div class="col-12 col-xl-6 col-xxl-3 border rounded-2 p-4">
            <?php /** title */ ?>
            <div class="row">
                <div class="col-12 h2"><?= @$title ?></div>
            </div>
            <?php /** author */ ?>
            <div class="row">
                <div class="col h4">By <a href="/trending?filter=true&title=&author=<?= @$owner ?>"><?= @$owner ?></a></div>
            </div>
            <?php /** description */ ?>
            <div class="row mt-2">
                <div class="col-12 h5">Description</div>
                <div class="col-12 h6"><?= @$desc ?></div>
            </div>
            <?php /** tags */ ?>
            <div class="row mt-2">
                <div class="col-12 h5">tags:</div>
                <div class="col-12 d-flex">
                    <?php
                    foreach ($post["tags"] as $tag) {
                    ?>
                        <div class="badge bg-primary me-2"><?= @$tag ?></div>
                    <?php
                    }
                    ?>
                </div>
            </div>
            <?php /** geolocation */ ?>
            <div class="row mt-2">
                <div class="col-12 h5">Geolocation</div>
                <div class="col-12">
                    <table>
                        <tbody>
                            <tr>
                                <th>Latitude</th>
                                <td><?= @$post["coordinates"]["lat"] ?></td>
                            </tr>
                            <tr>
                                <th>Longitude</th>
                                <td><?= @$post["coordinates"]["lon"] ?></td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <div class="col-12 col-xl-6 col-xxl-9" style="height: 600px;">

            <?php /** OpenStreetMap */ ?>
            <div id="map"></div>
            <script>
                var map = L.map('map', {
                    center: [<?= $lat ?>, <?= $lon ?>],
                    zoom: 14,
                    scrollWheelZoom: true
                });

                // add the OpenStreetMap tiles
                L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
                    maxZoom: 16,
                    attribution: '&copy; <a href="https://openstreetmap.org/copyright">OpenStreetMap contributors</a>'
                }).addTo(map);

                // show the scale bar on the lower left corner
                L.control.scale().addTo(map);

                // show a marker on the map
                L.marker({
                    lon: <?= $lon ?>,
                    lat: <?= $lat ?>
                }).bindPopup('C\'est le spot de photographie').addTo(map);
            </script>

        </div>
    </div>
    <div id="loadTarget"></div>
<?php

    $content = ob_get_clean();

    require_once "view/template.php";
    renderTemplate($title, $content, null, $head, $script);
}
