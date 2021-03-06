<?php

/**
 * @file trending.php
 * @brief View for the trending
 * @author Created by Benjamin.Fontana@cpnv.ch
 * @version 0.1 / 10.02.2021
 */

/**
 * @param array $cards : card association array containing post titles, images and such
 */

function trendingView($cards)
{

    ob_start();
    $title = "trending";
    $currentNav = "trending";
    $scripts = "<script src=\"/node_modules/masonry-layout/dist/masonry.pkgd.min.js\" async></script>"

    // Content
?>

    <div id="trendingMasonry" class="row mx-auto masonry" style="width:99vw;" data-masonry='{"percentPosition": true , "itemSelector" : ".masonry-item"}'>
        <?php /** Load cards */ ?>
        <?php
        if (!empty($cards)) {
            foreach ($cards as $card) {
        ?>
                <div class="col-12 col-md-6 col-lg-4 col-xl-3 g-3 masonry-item">
                    <?= $card ?>
                </div>
        <?php
            }
        }
        ?>

    </div>

    <?php

    $content = ob_get_clean();

    // Scripts
    ob_start();
    ?>

    <script src="/node_modules/masonry-layout/dist/masonry.pkgd.min.js" async></script>
    <?php /** Workaround for the masonry not updating on load */ ?>
    <script>
        window.addEventListener('DOMContentLoaded', (event) => {
            setTimeout(() => {
                var masonry = new Masonry('.masonry', {
                    itemSelector: '.masonry-item'
                });

            }, 250)
        });
    </script>

<?php
    $scripts = ob_get_clean();

    require_once "view/template.php";
    renderTemplate($title, $content, $currentNav, null, $scripts);
}
