<?php

/**
 * @file post.php
 * @author Created by Kenan.Augsburger@cpnv.ch
 * @version 0.1 / 15.02.2021
 */

/**
 * @param array $post containing post name etc.
 */
ob_start();
$title = $post["title"];

?>
<?php/** this div is used to center and resize the register form */?>
<div class="row">
    <?php /** images and map */ ?>
    <div class="col-6 border rounded-2">
        <img class="img-fluid" src="<?= @$post["pictures"][0]["path"] ?>">
    </div>
    <?php /** title and description */ ?>
    <div class="col-6 border rounded-2">

    </div>
</div>
<?php

$content = ob_get_clean();
require_once "view/template.php";
