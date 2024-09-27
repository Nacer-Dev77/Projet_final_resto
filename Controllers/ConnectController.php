<?php

namespace Controllers;

class ConnectController
{
    // afficher le formulaire de connexion.
    public function displayConnect()
    {
        $views = 'connect';
        include_once 'views/layout.phtml';
    }

    // fonction pour vérifier les infos de connexion utilisateur. 
    public function verifyAndconnectUser()
    {
        //on déclare nôtre tableau d'erreurs.
        $errors = [];
        
        // si les clés des champs email et password existent.
        if (
            array_key_exists('email', $_POST) &&
            array_key_exists('password', $_POST)
        ) {

        //on stock notre champ dans le tableau $userlog.
            $userlog = [
                'email' => trim($_POST['email']),
                'password' => $_POST['password']
            ];
            
            // si le champ email est renseigné et que le format email est respecté.  
            if (!filter_var($userlog['email'], FILTER_VALIDATE_EMAIL))
            //sinon message d'erreur.
                $errors[] = 'Veillez rensignez un email valide SVP !.';
            // si le champ password est renseigné et est supérieur à 8 caractères.
            if (strlen($userlog['password']) < 8)
            //sinon message d'erreur.
                $errors[] = 'Veillez rensignez un mots de passe valide SVP.';

            if (count($errors) == 0) {
                //si pas d'erreurs utilisé la méthode getUserByEmail pour récupérer les données utilisateur par son email et comparer les champs renseignés.
                $model = new \Models\UserModel();
                $dbUserInfo = $model->getUserByEmail($userlog['email']);
                
                // si les infos récupérées ne sont pas identiques à la base de données.
                if ($dbUserInfo == false)
                 // message d'erreur.
                    $errors[] = 'Pas de  compte associer a cette email';
                    
                // si pas d'erreurs.
                if (count($errors) == 0) {
                    //si le password ne correspond pas au compte. 
                    if (!password_verify($userlog['password'], $dbUserInfo['user_password']))
                    // message d'erreur.
                        $errors[] = 'Erreur d\'identification !';
                    //si pas d'erreurs. 
                    if (count($errors) == 0) {
                        
                        //connexion ouverte.
                        $_SESSION['connected'] = true;
                        $_SESSION['user'] =
                            [
                                'id'       =>  $dbUserInfo['user_id'],
                                'lastname' =>  $dbUserInfo['user_lastname'],
                                'firstname' => $dbUserInfo['user_firstname'],
                                'email'    =>  $dbUserInfo['user_email'],
                                'role'     =>  $dbUserInfo['user_role']
                            ];
                            //rediriger vers la page home.
                        header('Location: index.php?route=home');
                        exit();
                    }
                }
            }
        }
        //sinon recharger la page de connexion.
        $views = 'connect';
        include_once 'views/layout.phtml';
    }

    // function de déconnexion. 
    public function deconnect(): void
    {
        $_SESSION['connected'] = false;
        $_SESSION['user'] = [];
        session_destroy();
    //rediriger vers la page home.
        header('Location: index.php?route=home');
        exit();
    }
}
