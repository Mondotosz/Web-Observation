<?php

/**
 * @file home.php
 * @brief View for the homepage
 * @author Created by Benjamin.Fontana@cpnv.ch
 * @version 0.1 / 10.02.2021
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
</div>

<?php

$content = ob_get_clean();

require_once "view/template.php";
