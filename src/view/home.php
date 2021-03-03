<?php

/**
 * @file home.php
 * @brief Home page
 * @author Created by Benjamin.FONTANA@cpnv.ch
 * @version 0.1 / 14.02.2021
 */

function homeView()
{

    $title = "Home";
    $currentNav = "home";
    $head = "<style>
    .navbar{
        opacity: 0.75;
    }
    body{
        padding-top: 0px !important;
    }
    </style>";
    // Content
    ob_start();
?>

    <div class="container-fluid px-0">
        <div id="homeCarousel" class="carousel slide" data-ride="carousel">
            <div class="carousel-inner bg-info" role="listbox">
                <div class="carousel-item active">
                    <div class="d-flex align-items-center justify-content-center min-vh-100" style="background: url('view/content/public/Home/1.jpg') no-repeat center center; background-size: cover">
                    </div>
                </div>
                <div class="carousel-item">
                    <div class="d-flex align-items-center justify-content-center min-vh-100" style="background: url('view/content/public/Home/2.jpg') no-repeat center center; background-size: cover">
                    </div>
                </div>
                <div class="carousel-item">
                    <div class="d-flex align-items-center justify-content-center min-vh-100" style="background: url('view/content/public/Home/3.jpg') no-repeat center center; background-size: cover">
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
    renderTemplate($title, $content, $currentNav, $head);
}
