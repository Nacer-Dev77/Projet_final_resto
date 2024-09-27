<?php
//ouverture de session.
session_start();
// autoloader -> inclue automatiquement les fichiers dés l'instant où on instancie une classe.
spl_autoload_register(function($class) { 
    
    require_once (str_replace('\\','/', $class)) . '.php'; 
});


$router = new Route\Router();
$router->getRouteFromQuery();

