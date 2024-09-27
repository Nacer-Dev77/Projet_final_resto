<?php

namespace Route;

class Router
{
    public function getRouteFromQuery()
    {
        
        if (array_key_exists('road', $_GET)) {
            
            //page du formulaire connexion admin. 
            switch ($_GET['road']) {
                case 'road66admin':
                    $controller = new \ControllersAdmin\ConnectAdminController();
                    $controller->displayRoad66Admin();
                    break;
            // méthode de déconnexion.
                case 'deconnexion':
                    $controller = new \ControllersAdmin\ConnectAdminController();
                    $controller->deconnect();
                    break;
            // page home admin.
                case 'home_admin':
                    $controller = new \ControllersAdmin\HomeAdminController();
                    $controller->displayHome_Admin();
                    break;
            //méthode pour verifier et connecter l'admin.
                case 'adminConnect':
                    $controller = new \ControllersAdmin\ConnectAdminController();
                    $controller->verifyAndConnectAdmin();
                    break;
            //page tableau des utilisateurs.
                case 'users_admin':
                    $controller = new \ControllersAdmin\HomeAdminController();
                    $controller->displayUsers_Admin();
                    break;
            
            //page tableau des produits.
                case 'products':
                    $controller = new \ControllersAdmin\AdminController();
                    $controller->displayProducts();
                    break;
             //page pour ajouter produits.
                case 'add_product':
                    $controller = new \ControllersAdmin\AdminController();
                    $controller->displayFormAddProduct();
                    break;
            //méthode pour ajouter nouveaux produits.
                case 'addNewProducts':
                    $controller = new \ControllersAdmin\AdminController();
                    $controller->verifyAndAddNewProduct();
                    break;
              //méthode pour modifier produits.
                case 'update_product':
                    $controller = new \ControllersAdmin\AdminController();
                    $controller->updateProduct();
                    break;
             //méthode pour modifier.
                case 'update':
                    $controller = new \ControllersAdmin\AdminController();
                    $controller->update();
                    break;
             //méthode pour supprimer produits.
                case 'delete_product':
                    $controller = new \ControllersAdmin\AdminController();
                    $controller->delete_Product();
                    break;

             //page tableau des commentaires.
                case 'comments':
                    $controller = new \ControllersAdmin\HomeAdminController();
                    $controller->displaycomments();
                    break;
             //méthode pour supprimer commentaires.
                case 'delete_comment':
                    $controller = new \ControllersAdmin\HomeAdminController();
                    $controller->delete_Comment();
                    break;
            }
        }
    }
}
