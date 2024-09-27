<?php

namespace Controllers;

class MenuController
{
    //**********************************
    //  affichage de notre menu
    //**********************************
    
    // afficher la page des entrées. 
    public function displayEntrees()
    {
        $model = new \Models\UserModel();
        // récupérer et retourner les données getCategory.
        $categories = $model->getCategory();
          // récupérer et retourner les données de la table entrées avec la méthode getAllProducts.
        $products = $model->getAllProducts();
        //afficher les données récupérées. 
        $views = 'entrees';
        include_once 'views/layout.phtml';
    }
    
    // afficher la page des plats.
    public function displayPlats()
    {
        $model = new \Models\UserModel();
        // récupérer et retourner les données getCategory.
        $categories = $model->getCategory();
        // récupérer et retourner les données de la table plats avec la méthode getAllProducts.
        $products = $model->getAllProducts();
        //afficher les données récupérées.
        $views = 'plats';
        include_once 'views/layout.phtml';
    }
    
     // afficher la page des desserts.
    public function displayDesserts()
    {
        $model = new \Models\UserModel();
        // récupérer et retourner les données getCategory.
        $categories = $model->getCategory();
         // récupérer et retourner les données de la table desserts avec la méthode getAllProducts.
        $products = $model->getAllProducts();
        //afficher les données récupérées.
        $views = 'desserts';
        include_once 'views/layout.phtml';
    }

     // afficher la page des boissons.
    public function displayBoissons()
    {
           
        $model = new \Models\UserModel();
         // récupérer et retourner les données getCategory.
        $categories = $model->getCategory();
        // récupérer et retourner les données de la table boissons avec la méthode getAllProducts.
        $products = $model->getAllProducts();
         //afficher les données récupérées.
        $views = 'boissons';
        include_once 'views/layout.phtml';
    }
}
