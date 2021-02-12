<?php

/**
 * @description This is an html component which displays an image with it's title
 * @param string $img required path to the image
 * @param string $title required image title
 */

 //TODO: add link
 //TODO: add missing image default

function getComponent($title, $img)
{
    ob_start();
?>

    <div class="card" style="width: 18rem;">
        <img src="<?= !empty($img) ? $img : "" ?>" class="card-img-top" alt="...">
        <div class="card-body">
            <h5 class="card-title"><?= !empty($title) ? $title : "" ?></h5>
        </div>
    </div>

<?php
    return ob_get_clean();
}
