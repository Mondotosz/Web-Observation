<?php

/**
 * @file createPost.php
 * @author Created by Kenan.Augsburger@cpnv.ch
 * @version 0.1 / 15.02.2021
 */

/**
 * @description renders the post creation view
 * @return void
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
    <div id="removeItemModal" class="modal" tabindex="-1">
        <div class="modal-dialog modal-xl modal-dialog-scrollable">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Remove images</h5>
                    <button id="removeItemCross" type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body container-fluid">
                    <div id="removeItemContainer" class="row m-0"></div>
                </div>
                <div class="modal-footer justify-content-lg-between">
                    <p>Click to select the images you want to remove</p>
                    <div class="wrapper">
                        <button id="removeItemCancel" type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                        <button id="removeItemConfirm" type="button" class="btn btn-primary">Confirm</button>
                    </div>
                </div>
            </div>
        </div>
    </div> <?php /** this div is used to center and resize the register form */ ?>
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
                <button id="btnRemoveImage" type="button" class="btn btn-danger btn-trash"></button>
                <button id="btnAddImage" type="button" class="btn btn-primary btn-plus"></button>
            </div>

        </div>
        <?php /** title and description */ ?>
        <div class="col-12 col-xl-6 col-xxl-3 border rounded-2 p-4">
            <form method="POST" enctype="multipart/form-data" action="/post/create">
                <?php /** title */ ?>
                <div class="row w-full px-2 mb-2">
                    <label for="postTitle" class="form-label h5">Title</label>
                    <input type="text" id="postTitle" name="title" class="form-control" required>
                </div>
                <?php /** description */ ?>
                <div class="row w-full px-2 mb-2">
                    <label for="postDescription" class="form-label h5">Description</label>
                    <textarea id="postDescription" name="description" class="form-control" required></textarea>
                </div>
                <?php /** tags */ ?>
                <div class="row w-full px-2 mb-2">
                    <label for="postTags" class="form-label h5">Tags</label>
                    <div class="d-flex px-0" style="min-height:1rem;">
                        <input id="addTags" type="text" class="form-control" placeholder="Tag">
                        <button id="btnAddTags" class="btn btn-primary ms-2" type="button">
                            <img src="/view/content/icons/enter.svg" alt="Enter" style="min-width:1rem;">
                        </button>
                    </div>
                    <div id="tagsContainer" class="d-flex flex-wrap px-0">
                    </div>
                </div>
                <label for="" class="form-label h5">Coordinates</label>
                <?php /** coordinates latitude */ ?>
                <div class="row w-full px-2">
                    <label for="postLatitude" class="form-label h6">Latitude</label>
                    <input type="number" id="postLatitude" name="latitude" class="form-control px-1 ms-g-2" required>
                </div>
                <?php /** coordinates longitude */ ?>
                <div class="row w-full px-2">
                    <label for="postLongitude" class="form-label h6">Longitude</label>
                    <input type="number" id="postLongitude" name="longitude" class="form-control px-1 ms-g-2" required>
                </div>
                <div class="d-flex">
                </div>
                <div class="row">
                    <label for="postImage" class="form-label" style="display:none;">Image</label>
                    <input type="file" multiple accept=".jpg,.jpeg,.png,.gif" id="postImage" name="postImage" onchange="handleFiles(this.files);this.value = null" class="form-control ms-2 w-75" style="display:none;">
                </div>
                <br>
                <button id="create" type="submit" class="btn btn-primary">submit</button>
            </form>
        </div>
        <div class="col-12 col-xl-6 col-xxl-9" style="min-height: 600px;">

            <?php /** OpenStreetMap */ ?>
            <div id="map"></div>
            <script>
                var map = L.map('map', {
                    center: [<?= $_GET["latitude"] ?? 46.82 ?>, <?= $_GET["longitude"] ?? 6.505 ?>],
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
                var marker = new L.marker([46.82, 6.505], {
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
    <script src="/view/js/createPost.js" defer></script>
    <script src="/view/js/map.js"></script>
<?php
    $scripts = ob_get_clean();
    require_once "view/template.php";
    renderTemplate($title, $content, null, $head, $scripts);
}
