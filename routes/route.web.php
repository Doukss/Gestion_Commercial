<?php

use App\Controller\Web\CommandeController;
use App\Controller\Web\SecurityController;
use App\Core\Router;

Router::addRoute(
    "accueil", 
    CommandeController::class, 
    "index", 
    ["auth"]
);

Router::addRoute(
    "form", 
    SecurityController::class, 
    "form"
);

Router::addRoute(
    "", 
    SecurityController::class, 
    "form"
);

Router::addRoute(
    "login", 
    SecurityController::class, 
    "login"
);

Router::addRoute(
    "logout", 
    SecurityController::class, 
    "logout", 
    ["auth"] 
);

Router::addRoute(
    "nouvelle",
    CommandeController::class,
    "nouvelleCommande",
    ["auth"],
);
