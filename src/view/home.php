<?php

/**
 * @file home.php
 * @brief View for the homepage
 * @author Created by Kenan.Augsburger@cpnv.ch
 * @version 0.1 / 03.02.2021
 */

ob_start();
$title = "home";

?>
<h1>Hello world</h1>

<!-- <div class="row row-cols-1 row-cols-md-3 g-4 col-centered mx-auto"> -->
    <div id="carouselExampleControls" class="carousel slide mx-auto" data-bs-ride="carousel">
        <div class="carousel-inner">
            <div class="carousel-item active">
                <img src="view/content/img/3animaux_1600.jpg" class="d-block w-100" alt="...">
            </div>
            <div class="carousel-item">
                <img src="view/content/img/60cm_1600.jpg" class="d-block w-100" alt="...">
            </div>
            <div class="carousel-item">
                <img src="view/content/img/arret_1600.jpg" class="d-block w-100" alt="...">
            </div>
        </div>
        <a class="carousel-control-prev" href="#carouselExampleControls" role="button" data-bs-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Previous</span>
        </a>
        <a class="carousel-control-next" href="#carouselExampleControls" role="button" data-bs-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Next</span>
        </a>
    </div>
<!-- </div> -->

<?php

$content = ob_get_clean();

require_once "view/template.php";
