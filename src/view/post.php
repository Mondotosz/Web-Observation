<?php

/**
 * @file post.php
 * @author Created by Kenan.Augsburger@cpnv.ch
 * @version 0.1 / 15.02.2021
 */

/**
 * @param array $post containing post name etc.
 */
ob_start();
$title = $post["title"];

$head = "<style>
      html, body {
        height: 100%;
        margin: 0;
      }
      #map {
        /* configure the size of the map */
        width: 100%;
        height: 100%;
      }
    </style>"

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
    <div class="col-12 col-xl-12">

        <div id="postCarousel" class="carousel slide" data-bs-ride="carousel">
            <div class="carousel-indicators">
                <?php
                foreach ($post["pictures"] as $key => $picture) {
                ?>
                    <button type="button" data-bs-target="#postCarousel" data-bs-slide-to="<?= $key ?>" <?= ($key === array_key_first($post["pictures"]) ? " class=\"active border rounded-3 pb-2 mb-2 btn-primary w-25\" aria-current=\"true\"" : " class=\"border rounded-3 pb-2 mb-2 btn-primary w-25\"") ?> aria-label="Slide <?= $key ?>"></button>
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
                        <img style="height:800px;background:url(<?= @$picture["path"] ?>) no-repeat center center; background-size: contain;" loading="lazy" class="w-100" href="<?=@$picture['path']?>">
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
        </div>

    </div>
    <?php /** title and description */ ?>
    <div class="col-12 col-xl-6">
        <?php /** title */ ?>
        <div class="row">
            <div class="col"><?= @$title ?></div>
        </div>
        <?php /** author */ ?>
        <div class="row">
            <div class="col"><?= @$owner ?></div>
        </div>
        <?php /** description */ ?>
        <div class="row">
            <div class="col"><?= @$desc ?></div>
        </div>
        <?php /** tags */ ?>
        <div class="row">
            <div class="col"><strong>tags: </strong></div>
        </div>
        <div class="d-flex">
            <?php
            foreach ($post["tags"] as $tag) {
            ?>
                <div class="badge bg-primary me-2"><?= @$tag ?></div>
            <?php
            }
            ?>
        </div>
        <?php /** geolocation */ ?>
        <div>Geolocation</div>
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
    <div class="col-6" style="height: 600px;">

        <div id="map"></div>
        <script>
            var map = L.map('map', {
                center: [<?= $lon ?>, <?= $lat ?>],
                zoom: 14,
                scrollWheelZoom: false
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
                lon: <?= $lat ?>,
                lat: <?= $lon ?>
            }).bindPopup('C\'est le spot de photographie').addTo(map);
        </script>

    </div>
</div>
<?php

$content = ob_get_clean();
require_once "view/template.php";
