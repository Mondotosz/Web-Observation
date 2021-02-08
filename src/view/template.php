<?php

/**
 * @file template.php
 * @brief Centralizes all common graphical components like header and footer
 * @author Created by Kenan.Augsburger@cpnv.ch
 * @version 0.1 / 03.02.2021
 */

//TODO: Add loop for optional css / js links
//TODO: Add bootstrap , header and footer

?>
<!DOCTYPE html>
<html lang="en" class="h-100">

<head>

  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">

  <link rel="stylesheet" href="/view/css/bootstrap.min.css">

  <title><?= $title ?></title>

</head>

<body class="d-flex flex-column h-100">

  <header>

    <nav class="navbar navbar-expand-md navbar-dark fixed-top bg-dark">
      <div class="container-fluid">
        <a class="navbar-brand" href="#">Navbar</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
          <ul class="navbar-nav me-auto mb-2 mb-lg-0">
            <li class="nav-item">
              <a class="nav-link active" aria-current="page" href="#">Home</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="#">Link</a>
            </li>
            <li class="nav-item dropdown">
              <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                Dropdown
              </a>
              <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                <li><a class="dropdown-item" href="#">Action</a></li>
                <li><a class="dropdown-item" href="#">Another action</a></li>
                <li>
                  <hr class="dropdown-divider">
                </li>
                <li><a class="dropdown-item" href="#">Something else here</a></li>
              </ul>
            </li>
            <li class="nav-item">
              <a class="nav-link disabled" href="#" tabindex="-1" aria-disabled="true">Disabled</a>
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
      <?= $content ?>
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

</body>





</html>