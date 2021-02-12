<?php

function trending()
{
    require_once "view/content/components/cards.php";
    $cards = [];
    //example data until we have a model
    array_push($cards, getComponent("bettraves", "/view/content/img/Betteraves_1600.jpg"));
    array_push($cards, getComponent("faucon", "/view/content/img/Faucon_Crécerelle3.jpg"));
    array_push($cards, getComponent("Bouquetin", "/view/content/img/Bouquetin_fenestral.jpg"));
    array_push($cards, getComponent("Hermine", "/view/content/img/Hermine_profil_1600.jpg"));
    array_push($cards, getComponent("Arret", "/view/content/img/arret_1600.jpg"));
    array_push($cards, getComponent("Renard", "/view/content/img/Yeux_renard_1600.jpg"));
    array_push($cards, getComponent("Lagopede", "/view/content/img/Lagopèdes_1600.jpg"));
    array_push($cards, getComponent("Patrouille", "/view/content/img/Patrouille_1600.jpg"));
    array_push($cards, getComponent("60CM", "/view/content/img/60cm_1600.jpg"));
    require_once "view/trending.php";
}
