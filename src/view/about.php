<?php
function aboutView()
{
    $title = "About";
    // Content
    ob_start();
?>
    <link rel="stylesheet" href="/view/css/about.css">
    <div class="mx-5 my-3">
        <div>
            <h1 class="center-about"><span style="font-size: x-large;"><u>A</u><u>bout Us !</u></span></h1>
            <h3 class="center-about"><span style="font-weight: normal;"><span style="font-size: large;">Hello Friends Welcome To Photify</span></span></h3>
            <p class="center-about"><br>
            <p class="center-about" style="font-size: 18px;">Photify is a Professional photographers Platform. Here we will provide you only interesting content, which you will like very much.<br />
            <p class="center-about"><br>
            <p class="center-about" style="font-size: 18px;">We're dedicated to providing you the best of photos, with a focus on dependability and .<br><br>
            <p class="center-about" style="font-size: 18px;">We're working to turn our passion for photographers into a booming online website. We hope you enjoy our photographers as much as we enjoy offering them to you.</p>
            <div class="center-about"><br></div>
            <div class="center-about">
                <h3>Thanks For Visiting Our Site</h3>
            </div>
            <div style="text-align: center;"><a href="" target="_blank"><span style="font-size: medium;">
                        <h4>Contact Us !</h4>
                    </span></a></div>
        </div>
    <?php
    $content = ob_get_clean();

    require_once "view/template.php";
    renderTemplate($title, $content);
}
