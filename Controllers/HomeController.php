<?php

namespace Controllers;

use VARIANT;

class HomeController
{
    // afficher la page home.
    public function displayHome()
    {
        //récupérer et retourner les commentaires dans la page home.
        $model = new \Models\UserModel();
        $comments = $model->getAllComments();

        $views = 'home';
        include_once 'views/layout.phtml';
    }

    // afficher le formulaire pour ajouter les commentaires.
    public function displayComments()
    {
        //récupérer et retourner les commentaires.
        $model = new \Models\UserModel();
        $comments = $model->getAllComments();

        $views = 'comments';
        include_once 'views/layout.phtml';
    }

    // afficher la page information légale.
    public function displayInformation()
    {

        $views = 'information';
        include_once 'views/layout.phtml';
    }
    
    // afficher la page panier.
    public function displayBasket()
    {

        $views = 'basket';
        include_once 'views/layout.phtml';
    }
    // afficher la page paiement.
    public function displayPay()
    {

        $views = 'pay';
        include_once 'views/layout.phtml';
    }
     // afficher message validation du paiement.
    public function displayvalidBasket()
    {

        $views = 'validBasket';
        include_once 'views/layout.phtml';
    }
}
