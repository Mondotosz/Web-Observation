<?php

/**
 * @description This is an html component which displays an image with it's title
 * @param string $img required path to the image
 * @param string $title required image title
 */

/**
 * @description This function returns a bootstrap card html
 * @param string $title cards title
 * @param string $img path to the image
 * @param string $link link to the post
 * @return string html bootstrap card
 */
function getComponent($title, $img, $link)
{
    ob_start();
?>

    <a class="text-decoration-none" href="<?= $link ?? "" ?>">
        <div class="card">
            <img src="<?= $img ?? "" ?>" class="card-img-top" alt="<?= $title ?? "" ?>" loading="lazy">
            <div class="card-body">
                <h5 class="card-title"><?= $title ?? "" ?></h5>
            </div>
        </div>
    </a>

<?php
    return ob_get_clean();
}
