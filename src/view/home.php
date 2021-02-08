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

<div class="row row-cols-1 row-cols-md-3 g-4">
    <div class="col">
        <div class="card" style="width:18rem;">
            <img src="view/content/img/3animaux_1600.jpg" class="card-img-top" alt="...">
            <div class="card-body">
                    <h5 class="card-title">Card title</h5>
                    <h6 class="card-subtitle mb-2 text-muted ">Card subtitle</h6>
                    <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
            </div>
        </div>
    </div>
    
    <div id="carouselExampleControls" class="carousel slide" data-bs-ride="carousel">
    <div class="carousel-inner">
        <div class="carousel-item active">
        <img src="view/content/img/3animaux_1600.jpg" class="d-block w-100" alt="...">
        </div>
        <div class="carousel-item">
        <img src="..." class="d-block w-100" alt="...">
        </div>
        <div class="carousel-item">
        <img src="..." class="d-block w-100" alt="...">
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
</div>

<?php

$content = ob_get_clean();

require_once "view/template.php";