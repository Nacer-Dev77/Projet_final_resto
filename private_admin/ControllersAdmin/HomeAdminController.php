<?php

namespace ControllersAdmin;

class HomeAdminController
{
    // afficher la page home admin.
    public function displayHome_Admin()
    {
        $views_admin = 'home_admin';
        include_once 'views_admin/layout_admin.phtml';
    }
    //afficher la page tableau des utilisateurs 
    public function displayUsers_Admin()
    {
        //récupérer tous les utilisateurs et les afficher dans le tableau de la vue déclarée en dessous.
        $model = new \ModelsAdmin\AdminModel();
        $users = $model->getAllUsers();
        $views_admin = 'users_admin';
        include_once 'views_admin/layout_admin.phtml';
    }

     //afficher la page tableau des commentaires.
    public function displayComments()
    {
         //récupérer tous les commentaires et les afficher dans le tableau de la vue déclarée en dessous.
        $model = new \ModelsAdmin\AdminModel();
        $comments = $model->getAllComments();

        $views_admin = 'comments';
        include_once 'views_admin/layout_admin.phtml';
    }
    //function pour effacer les commentaires.
    public function delete_Comment()
    {
        $id = $_GET["id"];
        $model = new \ModelsAdmin\AdminModel();
        //effacer et récupérer tous les commentaires et les afficher dans le tableau de la vue déclarée en dessous.
        $model->deleteOneComment($id);

        $comments = $model->getAllComments();

        $views_admin = 'comments';
        include_once 'views_admin/layout_admin.phtml';
    }
}
