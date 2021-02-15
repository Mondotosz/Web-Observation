<?php

/**
 * @file trending.php
 * @brief View for the trending
 * @author Created by Benjamin.Fontana@cpnv.ch
 * @version 0.1 / 10.02.2021
 */

ob_start();
$title = "trending";
$currentNav = "trending";
$scripts = "<script src=\"https://cdn.jsdelivr.net/npm/masonry-layout@4.2.2/dist/masonry.pkgd.min.js\" integrity=\"sha384-GNFwBvfVxBkLMJpYMOABq3c+d3KnQxudP/mGPkzpZSTYykLBNsZEnG2D9G/X/+7D\" crossorigin=\"anonymous\" async></script>"
?>

<div id="trendingMasonry" class="row mx-auto masonry" style="width:99vw;" data-masonry='{"percentPosition": true , "itemSelector" : ".masonry-item"}'>

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

$content = ob_get_clean();

require_once "view/template.php";
