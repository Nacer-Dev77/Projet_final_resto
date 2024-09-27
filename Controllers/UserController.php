<?php

namespace Controllers;

class UserController
{

    //aficher le formulaire de création de compte.
    public function displayCreate()
    {
        $views = 'create';
        include_once 'views/layout.phtml';
    }

    // créer un nouveau compte.
    public function verifyAndCreateUser()
    {
         //on déclare nôtre tableau d'erreurs.
        $errors = [];

         // si les champs exitent.
        if (
            array_key_exists('lastname', $_POST) &&
            array_key_exists('firstname', $_POST) &&
            array_key_exists('email', $_POST) &&
            array_key_exists('password', $_POST)
        ) {
            
              //on stock notre champ dans le tableau $addNewUser.
            $addNewUser =
                [
                    'lastname' => $_POST['lastname'],
                    'firstname' => $_POST['firstname'],
                    'email' => $_POST['email'],
                    'password' => $_POST['password']
                ];

                // si le chmp lastname est renseigné. 
            if (empty($addNewUser['lastname']))
             //sinon message d'erreur.
                $errors[] = "Le nom est obligatoire";
                
            // si le chmp firstname est renseigné.
            if (empty($addNewUser['firstname']))
             //sinon message d'erreur.
                $errors[] = "Le prénom est obligatoire";
                
             // si le chmp email est renseigné et que le format email est respecté.
            if (!filter_var($addNewUser['email'], FILTER_VALIDATE_EMAIL))
            //sinon message d'erreur.
                $errors[] =  'Veuillez renseigner un email valide SVP !';
            
            // si le champ password est renseigné et est supérieur à 8 caractères.    
            if (strlen($_POST['password']) < 8)
             //sinon message d'erreur.
                $errors[] = "Le mot de passe doit faire au-moins 8 caractères";

            if (count($errors) == 0) {
                 //si pas d'erreurs utiliser la méthode getUserByEmail pour récupérer les données utilisateur par son email et comparer les champs renseigné si le compte existe déja.
                $model = new \Models\UserModel();
                $result = $model->getUserByEmail($addNewUser['email']);
                
                 //si erreur n'est pas égale à faux.
                if ($result != false)
                //sinon message d'erreur.
                    $errors[] =  "Désolé, ce compte existe déjà !";
               
                //si pas d'erreurs.
                if (count($errors) == 0) {
                // hacher le password.
                    $password = password_hash($addNewUser['password'], PASSWORD_DEFAULT);
                // stocker les données renseignées dans le tableau $data.
                    $data =
                        [
                            $addNewUser['lastname'],
                            $addNewUser['firstname'],
                            $addNewUser['email'],
                            $password,
                            'USER'

                        ];
                    // envoyer les données du tableau $data à la base de données avec la méthode addNewUser. 
                    $model->addNewUser($data);
                }
            }
        }
        // sinon rediriger vers la page create.
        $views = "create";
        include_once 'views/layout.phtml';
    }
}
