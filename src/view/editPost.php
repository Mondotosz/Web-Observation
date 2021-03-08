<?php

/**
 * @file post.php
 * @author Created by Kenan.Augsburger@cpnv.ch
 * @version 0.1 / 15.02.2021
 */

/**
 * @param array $post containing post name etc.
 */
function editPostView($post)
{

    $title = "Edit";

    // Head
    ob_start();
?>
    <link rel="stylesheet" href="/view/css/editPost.css">
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
    <div id="removeItemModal" class="modal" tabindex="-1">
        <div class="modal-dialog modal-xl modal-dialog-scrollable">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Remove image</h5>
                    <button id="removeItemCross" type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body container-fluid">
                    <div id="removeItemContainer" class="row m-0"></div>
                </div>
                <div class="modal-footer">
                    <button id="removeItemCancel" type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                    <button id="removeItemConfirm" type="button" class="btn btn-primary">Confirm</button>
                </div>
            </div>
        </div>
    </div> <?php /** this div is used to center and resize the register form */ ?>
    <div class="row p-3 m-0 g-2">
        <?php /** images */ ?>
        <div class="col-12">
            <div id="postCarousel" class="carousel slide" data-bs-ride="carousel">
                <div id="carouselInner" class="carousel-inner">
                    <?php
                    foreach ($post["pictures"] as $key => $picture) {
                    ?>
                        <div class="carousel-item<?= $key === array_key_first($post["pictures"]) ? " active" : "" ?>" data-image-filename="<?= $picture["filename"] ?>">
                            <div class="w-100" style="height: 800px;
                                background-color: black;
                                background-repeat: no-repeat; background-position: center center;
                                background-size: contain;
                                background-image: url(&quot;data:image/jpg;base64,<?= base64_encode(file_get_contents("view/content/img/original/" . $picture["filename"])) ?>&quot;)"></div>
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
                <button id="btnRemoveImage" type="button" class="btn btn-danger btn-trash"></button>
                <button id="btnAddImage" type="button" class="btn btn-primary btn-plus"></button>
            </div>

        </div>
        <?php /** title and description */ ?>
        <div class="col-12 col-xl-6">
            <form method="POST" enctype="multipart/form-data" action="/post/create">
                <?php /** title */ ?>
                <div class="row">
                    <label for="postTitle" class="form-label"></label>
                    <input type="text" id="postTitle" name="title" class="form-control px-1 ms-2 w-75" required value="<?= $post["title"] ?? "" ?>">
                </div>
                <?php /** description */ ?>
                <div class="row">
                    <label for="postDescription" class="form-label">Description</label>
                    <input type="text" id="postDescription" name="description" class="form-control px-1 ms-2 w-75 " required value="<?= $post["description"] ?? "" ?>">
                </div>
                <?php /** tags */ ?>
                <div class="row">
                    <label for="postTags" class="form-label">Tags</label>
                    <input type="text" name="tags" id="postTags" class="form-control px-1 ms-2 w-75" style="display:none;">
                    <input id="addTags" type="text" class="form-control px-1 ms-2 w-25" placeholder="Tag">
                    <div id="tagsContainer" class="d-flex flex-wrap w-75">
                        <?php
                        foreach (@$post["tags"] as $key => $tag) {
                        ?>
                            <div class="badge bg-primary p2 me-2 mt-2 fs-6"><?= $tag ?><img src="/view/content/icons/x.svg" class="removeTagIcon" style="height: 1rem;" data-tags-id="<?= $key ?>"></div>
                        <?php
                        }
                        ?>
                    </div>
                </div>
                <div class="d-flex">
                </div>
                <h5>Coordinates</h5>
                <?php /** coordinates latitude */ ?>
                <div class="row">
                    <label for="postLatitude" class="form-label">Latitude</label>
                    <input type="text" id="postLatitude" name="latitude" class="form-control px-1 ms-2 w-75 " value="<?= $post['coordinates']['lat'] ?>" required>
                </div>
                <?php /** coordinates longitude */ ?>
                <div class="row">
                    <label for="postLongitude" class="form-label">Longitude</label>
                    <input type="text" id="postLongitude" name="longitude" class="form-control px-1 ms-2 w-75 " value="<?= $post['coordinates']['lon'] ?>" required>
                </div>
                <div class="row">
                    <label for="postImage" class="form-label" style="display:none;">Image</label>
                    <input type="file" multiple accept=".jpeg, .jpg, .png, .gif" id="postImage" name="postImage" onchange="handleFiles(this.files); this.value = null" class="form-control ms-2 w-75" style="display:none;">
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
                    center: [<?= $post['coordinates']['lat'] ?>, <?= $post['coordinates']['lon'] ?>],
                    zoom: 14,
                    scrollWheelZoom: true
                });
                //geolocalization
                map.locate({
                    setView: true,
                    zoom: 14,
                    scrollWheelZoom: true
                })

                // add the OpenStreetMap tiles
                L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
                    maxZoom: 16,
                    attribution: '&copy; <a href="https://openstreetmap.org/copyright">OpenStreetMap contributors</a>'
                }).addTo(map);

                // show the scale bar on the lower left corner
                L.control.scale().addTo(map);


                // show a marker on the map
                var marker = new L.marker([<?= $post['coordinates']['lat'] ?>, <?= $post['coordinates']['lon'] ?>], {
                    draggable: true,
                    autoPan: true
                }).addTo(map).bindPopup('C\'est le spot de photographie');
            </script>

        </div>
    </div>
    <?php

    $content = ob_get_clean();

    // Scripts
    ob_start();
    ?>
    <script src="/node_modules/jquery/dist/jquery.min.js"></script>
    <script src="/view/js/editPost.js" defer></script>
<?php
    $scripts = ob_get_clean();
    require_once "view/template.php";
    renderTemplate($title, $content, null, $head, $scripts);
}
