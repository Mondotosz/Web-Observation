<?php

/**
 * @file index.php
 * @brief This is the router, it handles requests and redirect them to the correct controller
 * @author Created by Kenan.Augsburger@cpnv.ch
 * @version 0.1 / 03.02.2021
 */

// Creates/Resumes a sessions
session_start();

// Dependencies
require_once "controller/nav.php";
require_once "controller/trending.php";
require_once "controller/authentication.php";
require_once "controller/post.php";
require_once "controller/mail.php";

// Routing
switch (strtok($_SERVER["REQUEST_URI"], '?')) {
    case "/":
    case "/home":
        home();
        break;
    case "/register":
        register($_POST);
        break;
    case "/login":
        login($_POST);
        break;
    case "/logout":
        logout();
        break;
    case "/trending":
        trending($_GET);
        break;
    case "/post/create":
        createPost($_POST, $_FILES);
        break;
    case "/post/delete": // Match revery requests on /post/*
        deletePost($_POST);
        break;
    case (preg_match('/^\/post\/(\d+)\/edit\/?$/', $_SERVER["REQUEST_URI"], $res) ? true : false): // Match revery requests on /post/*
        editPost(@$res[1], $_POST, $_FILES);
        break;
    case (preg_match('/^\/post\/(\d+)\/?$/', $_SERVER["REQUEST_URI"], $res) ? true : false): // Match revery requests on /post/*
        showPost(@$res[1]);
        break;
    case "/termsOfServices":
        tOS();
        break;
    case "/about":
        about();
        break;
    case "/contact":
        contact();
        break;
    case "/contactUs":
        contactUs();
        break;
    case "/sendMail":
        sendMail(false);
        break;
    case "/sendMailToUs":
        sendMail(true);
        break;
    default:
        lost();
}
