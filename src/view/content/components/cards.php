<?php

/**
 * @description This is an html component which displays an image with it's title
 * @param string $img required path to the image
 * @param string $title required image title
 */

function getComponent($title, $img, $link)
{
    ob_start();
?>

    <a class="text-decoration-none" href="<?= !empty($link) ? $link : "" ?>">
        <div class="card">
            <img src="<?= !empty($img) ? $img : "" ?>" class="card-img-top" alt="...">
            <div class="card-body">
                <h5 class="card-title"><?= !empty($title) ? $title : "" ?></h5>
            </div>
        </div>
    </a>

<?php
    return ob_get_clean();
}
