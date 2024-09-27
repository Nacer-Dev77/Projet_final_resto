<?php

namespace Route;


class Router
{
    public function getRouteFromQuery()
    {
        if (empty($_GET))
        header('location: index.php?route=home');
        
        if (array_key_exists('route', $_GET)) {

            switch ($_GET['route']) {
                // page home.
                case 'home':
                    $controller = new \Controllers\HomeController();
                    $controller->displayHome();
                    break;
                 // page comentaires.
                case 'comments':
                    $controller = new \Controllers\HomeController();
                    $controller->displayComments();
                    break;
                 //méthode pour ajouter commentaires.
                case 'UserComment':
                    $controller = new \Controllers\CommentController();
                    $controller->verifyAndAddcomments();
                    break;
                //page du formulaire connexion.
                case 'connect':
                    $controller = new \Controllers\ConnectController();
                    $controller->displayConnect();
                    break;
                 //méthode pour verifier et connecter utilisateurs.
                case 'UserConnect':
                    $controller = new \Controllers\ConnectController();
                    $controller->verifyAndconnectUser();
                    break;
                 //méthode pour déconnecter.
                case 'deconnect':
                    $controller = new \Controllers\ConnectController();
                    $controller->deconnect();
                    break;

                 //page du formulaire de création de compte utilisateurs.
                case 'create':
                    $controller = new \Controllers\UserController();
                    $controller->displayCreate();
                    break;
                 //méthode pour verifier et créer compte utilisateurs.
                case 'submitFormAddUser':
                    $controller = new \Controllers\UserController();
                    $controller->verifyAndCreateUser();
                    break;
                // page des entrées.
                case 'entrees':
                    $controller = new \Controllers\MenuController();
                    $controller->displayEntrees();
                    break;
                 // page des plats.
                case 'plats':
                    $controller = new \Controllers\MenuController();
                    $controller->displayPlats();
                    break;
                // page des desserts.
                case 'desserts':
                    $controller = new \Controllers\MenuController();
                    $controller->displayDesserts();
                    break;
                // page des boissons.
                case 'boissons':
                    $controller = new \Controllers\MenuController();
                    $controller->displayBoissons();
                    break;
                // page des informations légales.
                case 'informations':
                    $controller = new \Controllers\HomeController();
                    $controller->displayInformation();
                    break;
                // page panier
                case 'basket';
                    $controller = new \Controllers\HomeController();
                    $controller->displayBasket();
                    break;
                // page paiement 
                case 'pay';
                    $controller = new \Controllers\HomeController();
                    $controller->displayPay();
                    break;
                 // page message validation du paiement 
                 case 'validBasket';
                    $controller = new \Controllers\HomeController();
                    $controller->displayvalidBasket();
                    break;
               
                default:
                    // rediriger vers la page home.
                    header('location: index.php?route=home');
                    exit;
            }
        }
    }
}
