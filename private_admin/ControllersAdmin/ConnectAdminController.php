<?php
/* *************************** ************************************************* */
/* renseignements de connexion coté front && back admin */
/* *************************** ************************************************* */
/* Email de connexion admin ===== wacademy@3wa.io */
/* Password de connexion admin ===== admin2022 */
/* *************************** ************************************************* */
/* *************************** ************************************************* */

namespace ControllersAdmin;

class ConnectAdminController
{
    // affiche la page (route) de connexion admin.
    public function displayRoad66Admin()
    {

        $views_admin = 'road66admin';
        include_once 'views_admin/layout_admin.phtml';
    }


    //function pour connecter l'admin.
    public function verifyAndConnectAdmin()
    {
          //on déclare le tableau d'erreurs.
        $errors = [];

        // si les clés des champs email et password existent.
        if (
            array_key_exists('email', $_POST) &&
            array_key_exists('password', $_POST)
        ) {

             //on stock le champs dans le tableau $adminlog.
            $adminlog = [
                'email' => trim($_POST['email']),
                'password' => $_POST['password']
            ];

             // si le champs email est renseigné et que le format email est respecté.
            if (!filter_var($adminlog['email'], FILTER_VALIDATE_EMAIL))
            //sinon message d'erreur.
                $errors[] = 'Erreur d\'identification email ou password incorrect';
            
             // si le champs password est renseigné et est supérieur à 8 caractères.
            if (strlen($adminlog['password']) < 8)
             //sinon message d'erreur.
                $errors[] = 'Erreur d\'identification email ou password incorrect';

            if (count($errors) == 0) {
                 //si pas d'erreurs utiliser la méthode getUserByEmail pour récupérer les données admin par son email et comparer les champs renseignés.
                $model = new \ModelsAdmin\AdminModel();
                $dbUserInfo = $model->getUserByEmail($adminlog['email']);

                 // si les infos récupérées sont identiques à la base de données.
                if ($dbUserInfo == false) {
                     //sinon message d'erreur.
                    $errors[] = 'Erreur d\'identification email ou password incorrect';
                } else {

                     //si le password ne correspond pas au compte et que ce n'est pas l'admin.
                    if (!password_verify($adminlog['password'], $dbUserInfo['user_password']) || $dbUserInfo['user_role'] !== 'ADMIN') {
                         // message d'erreur.
                        $errors[] = 'Erreur d\'identification email ou password incorrect';
                    } else {
                        
                        //sinon connexion ouverte.
                        $_SESSION['connected_admin'] = true;
                        $_SESSION['admin'] =
                            [
                                'id'       =>  $dbUserInfo['user_id'],
                                'lastname' =>  $dbUserInfo['user_lastname'],
                                'firstname' => $dbUserInfo['user_firstname'],
                                'email'    =>  $dbUserInfo['user_email'],
                                'role'     =>  $dbUserInfo['user_role']
                            ];
                             //rediriger vers la page home admin.
                        header('Location: index.php?road=home_admin');
                        exit();
                    }
                }
            }
            //sinon recharger la page de connexion.
            $views_admin = 'road66admin';
            include_once 'views_admin/layout_admin.phtml';
        } else {
            $views_admin = 'road66admin';
            include_once 'views_admin/layout_admin.phtml';
        }
    }
     // function de déconnexion. 
    public function deconnect(): void
    {
        $_SESSION['connected_admin'] = false;
        $_SESSION['admin'] = [];
        session_destroy();
        //rediriger vers la page connexion.
        header('Location: index.php?road=road66admin');
        exit();
    }
}
