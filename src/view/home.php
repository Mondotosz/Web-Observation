<?php

/**
 * @file home.php
 * @brief Home page
 * @author Created by Benjamin.FONTANA@cpnv.ch
 * @version 0.1 / 14.02.2021
 */


$title = "Home";
$currentNav = "home";

ob_start();
?>

<div class="container-fluid px-0">
    <div id="homeCarousel" class="carousel slide" data-ride="carousel">
        <div class="carousel-inner bg-info" role="listbox">
            <div class="carousel-item active">
                <div class="d-flex align-items-center justify-content-center min-vh-100">
                    <h1 class="display-1">ONE</h1>
                </div>
            </div>
            <div class="carousel-item">
                <div class="d-flex align-items-center justify-content-center min-vh-100">
                    <h1 class="display-1">TWO</h1>
                </div>
            </div>
            <div class="carousel-item">
                <div class="d-flex align-items-center justify-content-center min-vh-100">
                    <h1 class="display-1">THREE</h1>
                </div>
            </div>
        </div>
        <a class="carousel-control-prev" href="#homeCarousel" role="button" data-bs-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
        </a>
        <a class="carousel-control-next" href="#homeCarousel" role="button" data-bs-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
        </a>
    </div>
</div>

<?php
$content = ob_get_clean();

require_once "view/template.php";
