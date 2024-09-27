<?php

//ouverture de session.
session_start();
// autoloader -> inclue automatiquement les fichiers dés l'instant où on instancie une classe.
spl_autoload_register(function ($class) {
    // $class = App\Router.
    require_once (str_replace('\\', '/', $class)) . '.php';
});

// si connecté. 
if (isset($_SESSION['connected_admin'])) {
//inclure les routes.
    $route = new Route\Router();
    $route->getRouteFromQuery();
}
//sinon.
else {

    $road = new ControllersAdmin\ConnectAdminController();
    $road->verifyAndConnectAdmin();
}
