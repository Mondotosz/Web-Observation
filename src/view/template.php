<?php

/**
 * @file template.php
 * @brief Centralizes all common graphical components like header and footer
 * @author Created by Kenan.Augsburger@cpnv.ch
 * @version 0.1 / 03.02.2021
 */

/**
 * @param string  $title required page title
 * @param string  $content required page content
 * @param string  $favicon optional path to specific favicon
 * @param string  $head optional html inserted in the head
 * @param string  $scripts optional html inserted just before the body closing tag
 * @param string  $currentNav optional string to define which navItem should be active for simplicity's sake we'll use lowercase
 */

?>
<!DOCTYPE html>
<html lang="en" class="h-100">

<head>

  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">

  <script src="/node_modules/leaflet/dist/leaflet.js"></script>

  <link rel="stylesheet" href="/node_modules/leaflet/dist/leaflet.css" />

  <link rel="stylesheet" href="/node_modules/bootstrap/dist/css/bootstrap.min.css">

  <?php /** Favicon with default value */ ?>
  <link rel="icon" href="<?= !empty($favicon) ? $favicon : "/view/content/icons/favicon.svg" ?>" type="image/svg+xml">

  <?php /** View defined title */ ?>
  <title><?= !empty($title) ? $title : "bad dev forgot to put a title" ?></title>

  <?php /** Fixed navbar requires padding to avoid overlap */ ?>
  <style>
    body {
      padding: 56px 0 0 0;
    }
  </style>

  <?php /** Optional css */ ?>
  <?= !empty($head) ? $head : "" ?>

</head>

<body class="d-flex flex-column h-100">

  <header>
    <nav class="navbar navbar-expand-md navbar-dark fixed-top bg-dark">
      <div class="container-fluid">
        <a class="navbar-brand" href="/home">Photify</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
          <div class="w-100 row mx-auto">
            <ul class="navbar-nav col-12 col-md-4 col-xl-3">
              <li class="nav-item">
                <?php /** NavItem with active attribute depending on the view */ ?>
                <a class="nav-link <?= (@$currentNav == "home") ? "active" : "" ?>" aria-current="page" href="/home">Home</a>
              </li>
              <li class="nav-item">
                <?php /** NavItem with active attribute depending on the view */ ?>
                <a class="nav-link <?= (@$currentNav == "trending") ? "active" : "" ?>" href="/trending">Trending</a>
              </li>
            </ul>
            <form class="d-flex col-12 col-md-4 col-xl-6 gx-0">
              <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search">
              <button class="btn btn-outline-success" type="submit">Search</button>
            </form>
            <div class="col-12 col-md-4 col-xl-3 d-flex justify-content-md-end mt-2 mt-md-0 gx-0">
              <?php
              if (!empty($_SESSION["username"])) {
                echo "<a href=\"/post/create\" class=\"btn btn-primary me-2\">Create a post</a>";
                echo "<a href=\"/logout\" class=\"btn btn-primary\">logout</a>";
              } else {
                echo "<a href=\"/login\" class=\"btn btn-primary me-2\">login</a>";
                echo "<a href=\"/register\" class=\"btn btn-primary\">Register</a>";
              }
              ?>
            </div>
          </div>
        </div>

      </div>
    </nav>
  </header>

  <main>

    <?= !empty($content) ? $content : "<h1>bad dev forgot to add content</h1>" ?>

  </main>

  <footer class="footer mt-auto py-3 bg-dark text-center">

    <div class="d-flex justify-content-center">
      <div class="text-muted mx-2">
        <a href="" class="link-secondary text-decoration-none">Social</a>
      </div>
      <div class="text-muted mx-2">
        <a href="" class="link-secondary text-decoration-none">About</a>
      </div>
      <div class="text-muted mx-2">
        <a href="" class="link-secondary text-decoration-none">Terms</a>
      </div>
    </div>

  </footer>

  <script src="/node_modules/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
  <?= !empty($scripts) ? $scripts : "" ?>
</body>

</html>