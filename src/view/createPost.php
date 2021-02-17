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
$title = "Create";

?>
<?php /** this div is used to center and resize the register form */ ?>
<div class="row p-3 m-0 g-2">
    <?php /** images and map */ ?>
    <div class="col-12 col-xl-6 border rounded-2">

        <div id="postCarousel" class="carousel slide" data-bs-ride="carousel">
            <div class="carousel-inner">
                <div class="carousel-item text-center active">
                    <?php /** image with hotfix defined height */ ?>
                    <div style="height:600px" class="d-flex align-items-center justify-content-center">
                        <h1 class="display-1">ONE</h1>
                    </div>
                </div>

            </div>
            <a href="#postCarousel" class="carousel-control-prev" type="button" data-bs-target="#postCarousel" data-bs-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Previous</span>
            </a>
            <a href="#postCarousel" class="carousel-control-next" type="button" data-bs-target="#postCarousel" data-bs-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Next</span>
            </a>
        </div>

    </div>
    <?php /** title and description */ ?>
    <div class="col-12 col-xl-6 border rounded-2">
        <?php /** title */ ?>
        <div class="row">
            <div class="col">TITLE</div>
        </div>
        <?php /** author */ ?>
        <div class="row">
            <div class="col">Author</div>
        </div>
        <?php /** description */ ?>
        <div class="row">
            <div class="col">Description</div>
        </div>
        <?php /** tags */ ?>
        <div class="row">
            <div class="col">tags</div>
        </div>
        <div class="d-flex">
        </div>
        <?php /** geolocation */ ?>
        <div>Geolocation</div>
        <table>
            <tbody>
                <tr>
                    <th>Latitude</th>
                    <td>a</td>
                </tr>
                <tr>
                    <th>Longitude</th>
                    <td>b</td>
                </tr>
            </tbody>
        </table>
        <button id="testPost" class="btn btn-primary">button</button>

    </div>
</div>
<?php

$content = ob_get_clean();

ob_start();
?>
<script>
    // Sending and receiving data in JSON format using POST method
    //
    var xhr = new XMLHttpRequest();
    var url = "/post/create";
    xhr.open("POST", url, true);
    xhr.setRequestHeader("Content-Type", "application/json");
    xhr.onreadystatechange = function() {
        if (xhr.readyState === 4 && xhr.status === 200) {
            var json = JSON.parse(xhr.responseText);
            console.log(json.email + ", " + json.password);
        }
    };
    var data = JSON.stringify({
        "post": "post",
        "email": "hey@mail.com",
        "password": "101010"
    });
    document.getElementById("testPost").addEventListener('click', () => {
        xhr.send(data);
    })
</script>
<?php
$scripts = ob_get_clean();
require_once "view/template.php";
