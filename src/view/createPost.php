<?php

/**
 * @file post.php
 * @author Created by Kenan.Augsburger@cpnv.ch
 * @version 0.1 / 15.02.2021
 */

/**
 * @param array $post containing post name etc.
 */
function createPostView()
{

    $title = "Create";

    // Head
    ob_start();
?>
    <link rel="stylesheet" href="/view/css/createPost.css">
    <style>
        #map {
            /* configure the size of the map */
            width: 100%;
            height: 100%;
        }
    </style>
    <?php
    $head = ob_get_clean();

    // Content
    ob_start();
    ?>
    <?php /** this div is used to center and resize the register form */ ?>
    <div class="row p-3 m-0 g-2">
        <?php /** images */ ?>
        <div class="col-12">
            <div id="postCarousel" class="carousel slide" data-bs-ride="carousel">
                <div id="carouselInner" class="carousel-inner">
                    <div id="previewPlaceHolder" class="carousel-item text-center active">
                        <?php /** image with hotfix defined height */ ?>
                        <div style="height:800px;background:black url('/view/content/icons/dragAndDrop.svg') no-repeat center center;" class="d-flex align-items-center justify-content-center">
                        </div>
                    </div>

                </div>
                <a href="#postCarousel" class="carousel-control-prev" type="button" data-bs-target="#postCarousel" data-bs-slide="prev">
                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                    <span class="visually-hidden">Previous</span>
                </a>
                <a href="#postCarousel" class="carousel-control-next" type="button" data-bs-target="#postCarousel" data-bs-slide="next">
                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                    <span class="visually-hidden">Next</span>
                </a>
                <button id="btnAddImage" type="button" class="btn btn-primary btn-plus"></button>
            </div>

        </div>
        <?php /** title and description */ ?>
        <div class="col-12 col-xl-6">
            <form method="POST" enctype="multipart/form-data" action="/post/create">
                <?php /** title */ ?>
                <div class="row">
                    <label for="postTitle" class="form-label">Title</label>
                    <input type="text" id="postTitle" name="title" class="form-control px-1 ms-2 w-75" required>
                </div>
                <?php /** description */ ?>
                <div class="row">
                    <label for="postDescription" class="form-label">Description</label>
                    <input type="text" id="postDescription" name="description" class="form-control px-1 ms-2 w-75 " required>
                </div>
                <?php /** tags */ ?>
                <div class="row">
                    <label for="postTags" class="form-label">Tags</label>
                    <input type="text" name="tags" id="postTags" class="form-control px-1 ms-2 w-75" style="display:none;">
                    <input id="addTags" type="text" class="form-control px-1 ms-2 w-25" placeholder="Tag">
                    <div id="tagsContainer" class="d-flex flex-wrap w-75">
                    </div>
                </div>
                <div class="d-flex">
                </div>
                <div class="row">
                    <label for="postImage" class="form-label" style="display:none;">Image</label>
                    <input type="file" multiple accept="image/*" id="postImage" name="postImage" onchange="handleFiles(this.files)" class="form-control ms-2 w-75" style="display:none;">
                </div>
                <br>
                <button id="create" type="submit" class="btn btn-primary">submit</button>
            </form>
        </div>
        <div class="col-12 col-xl-6" style="height: 600px;">

            <?php /** OpenStreetMap */ ?>
            <div id="map"></div>
            <script>
                var map = L.map('map', {
                    center: [46.831366, 6.564394],
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
                    lon: 6.564394,
                    lat: 46.831366
                }).bindPopup('C\'est le spot de photographie').addTo(map);
            </script>

        </div>
    </div>
    <?php

    $content = ob_get_clean();

    // Scripts
    ob_start();
    ?>
    <script src="/node_modules/jquery/dist/jquery.min.js"></script>
    <script src="/view/js/createPost.js" defer></script>
<?php
    $scripts = ob_get_clean();
    require_once "view/template.php";
    renderTemplate($title, $content, null, $head, $scripts);
}
