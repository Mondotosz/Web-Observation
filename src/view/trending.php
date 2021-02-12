<?php

/**
 * @file home.php
 * @brief View for the homepage
 * @author Created by Benjamin.Fontana@cpnv.ch
 * @version 0.1 / 10.02.2021
 */

ob_start();
$title = "home";
$scripts = '<script src="https://cdn.jsdelivr.net/npm/masonry-layout@4.2.2/dist/masonry.pkgd.min.js" integrity="sha384-GNFwBvfVxBkLMJpYMOABq3c+d3KnQxudP/mGPkzpZSTYykLBNsZEnG2D9G/X/+7D" crossorigin="anonymous" async></script>'
?>

<div class="row mx-auto" style="width:99vw;" data-masonry='{"percentPosition": true }'>

    <?php
    if (!empty($cards)) {
        foreach ($cards as $card) {
    ?>
            <div class="col-sm-6 col-lg-4 col-mb-4">
                <?= $card ?>
            </div>
    <?php
        }
    }
    ?>

</div>

<?php

$content = ob_get_clean();

require_once "view/template.php";
