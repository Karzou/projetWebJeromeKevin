<?php

include_once('config/_config.php');

MyAutoload::start();

//création de notre objet routeur

if (isset($_GET['r'])) {

    $request = $_GET['r'];

    $router = new Routeur($request);
} else {
    $router = new Routeur('home');
}

$router->renderController();