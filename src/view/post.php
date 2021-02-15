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

?>
<?php/** this div is used to center and resize the register form */?>
<div class="row p-3 m-0 g-2">
    <?php /** images and map */ ?>
    <div class="col-12 col-xl-6 border rounded-2">

        <div id="postCarousel" class="carousel slide" data-bs-ride="carousel">
            <div class="carousel-indicators">
                <?php
                foreach ($post["pictures"] as $key => $picture) {
                ?>
                    <button type="button" data-bs-target="#postCarousel" data-bs-slide-to="<?= $key ?>" class="<?= ($key === array_key_first($post["pictures"]) ? " active" : "") ?>" aria-current="true" aria-label=""></button>
                <?php
                }
                ?>

            </div>
            <div class="carousel-inner">
                <?php
                foreach ($post["pictures"] as $key => $picture) {
                ?>
                    <div class="carousel-item<?= ($key === array_key_first($post["pictures"]) ? " active" : "") ?>">
                        <img class="img-fluid d-block mx-auto" src="<?= @$picture["path"] ?>">
                    </div>

                <?php
                }
                ?>
            </div>
            <button class="carousel-control-prev" type="button" data-bs-target="#postCarousel" data-bs-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Previous</span>
            </button>
            <button class="carousel-control-next" type="button" data-bs-target="#postCarousel" data-bs-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Next</span>
            </button>
        </div>

    </div>
    <?php /** title and description */ ?>
    <div class="col-12 col-xl-6 border rounded-2">
        <?php /** title */ ?>
        <div class="row">
            <div class="col"><?= @$post["title"] ?></div>
        </div>
        <?php /** author */ ?>
        <div class="row">
            <div class="col"><?= @$post["owner"] ?></div>
        </div>
        <?php /** description */ ?>
        <div class="row">
            <div class="col"><?= @$post["description"] ?></div>
        </div>
        <?php /** tags */ ?>
        <div class="row">
            <div class="col">tags</div>
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
</div>
<?php

$content = ob_get_clean();
require_once "view/template.php";
