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

  <link rel="stylesheet" href="/view/css/bootstrap.min.css">

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
    <nav class="navbar navbar-expand-md navbar-dark  fixed-top bg-dark">
      <div class="container-fluid">
        <a class="navbar-brand" href="/home">Photify</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
          <ul class="navbar-nav me-auto mb-2 mb-lg-0">
            <li class="nav-item">
              <?php /** NavItem with active attribute depending on the view */ ?>
              <a class="nav-link <?= (@$currentNav == "home") ? "active" : "" ?>" aria-current="page" href="/home">Home</a>
            </li>
            <li class="nav-item">
              <?php /** NavItem with active attribute depending on the view */ ?>
              <a class="nav-link" href="/trending" <?= (@$currentNav == "trending") ? "active" : "" ?>>Trending</a>
            </li>
          </ul>
          <form class="d-flex">
            <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search">
            <button class="btn btn-outline-success" type="submit">Search</button>
          </form>
        </div>

      </div>
    </nav>
  </header>

  <main class="flex-shrink-0">

    <div class="container-fluid">
      <?= !empty($content) ? $content : "<h1>bad dev forgot to add content</h1>" ?>
    </div>

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

  <script src="view/js/bootstrap.bundle.min.js"></script>
  <?= !empty($scripts) ? $scripts : "" ?>
</body>

</html>