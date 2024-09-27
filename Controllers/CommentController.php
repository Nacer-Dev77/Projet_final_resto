<?php

namespace Controllers;

class CommentController
{
    // fonction pour ajouter des commentaires.
    public function verifyAndAddcomments()
    {
        //on déclare nôtre tableau d'erreurs.
        $errors = [];
        
        // si la clé du champ content existe.

        if (

            array_key_exists('content', $_POST)
        ) {
            
            //on stock notre champ dans le tableau $addNewComment.
            $addNewComment =
                [
                    'content' => $_POST['content'],
                ];
            
            // si notre champ est inférieur à 10 caractères.

            if (strlen($addNewComment['content']) < 10)
            //sinon  message d'erreur pour remplir le champ correctement.
                $errors[] = 'Minimum  10 caratères SVP !';
                
            // si notre champ est supérieur à 500 caractères.
            if (strlen($addNewComment['content']) > 500)
             //sinon message d'erreur pour remplir le champ correctement.
                $errors[] = 'vous avez dépasser le nombre de caractères autorisé .';
                
                // si pas d'erreurs. 
            if (count($errors) == 0) {
                // stocker les données dans le tableau $data.
                $data =
                    [
                        $_SESSION['user']['id'],
                        $addNewComment['content']
                    ];
                   // utiliser la méthode addNewComment dans notre Model pour envoyer les commentaires à la base de données.   
                $model = new \Models\UserModel();
                $model->addNewComment($data);
            }
        }
        // utiliser la méthode getAllComments dans notre Model pour récupérer et retourner les commentaires puis les afficher dans la vue (home). 
        $model = new \Models\UserModel();
        $comments = $model->getAllComments();
        // inclure la vue home pour afficher les commentaires.
        $views = "home";
        include_once 'views/layout.phtml';
    }
}
