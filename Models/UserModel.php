<?php

namespace Models;

use Models\Database;

class UserModel extends Database
{

//fonction qui permet de récupérer un utilisateur par son email de la base de données.
   public function getUserByEmail($email)
   {
      return $this->getOneByEmail('users', $email);
   }

//fonction qui permet d'ajouter un nouveau utilisateur à la base de données.
   public function addNewUser($data)
   {
      $this->addOne(
         'users',
         'user_lastname ,user_firstname, user_email, user_password, user_role',
         '?,?,?,?,?',
         $data
      );
   }

//fonction qui permet d'ajouter un nouveau commentaires à la base de données.

   public function addNewComment($data)
   {
      $this->addOne(
         'comments',
         'com_username_id, com_content',
         '?,?',
         $data
      );
   }
// fonction qui permet de récupérer tout les commentaires de la base de données.
   public function getAllComments()
   {
      $sqlreq = "SELECT * FROM comments INNER JOIN users on comments.com_username_id=users.user_id  ORDER BY com_create_at DESC LIMIT 4";
      return $this->findAll($sqlreq);
   }
   
// fonction qui permet de récupérer un commentaire par son ID de la base de données.
   public function getCommentById($id)
   {
      return $this->getOneById('comments', 'com_content', $id);
   }

// fonction qui permet de récupérer tout les produits de la base de données.
   public function getAllProducts()
   {
      $sqlreq = "SELECT * FROM products ";
      return $this->findAll($sqlreq);
   }

// fonction qui permet de récupérer les produits par leurs ID de la base de données.
   public function getProductsById($id)
   {
      return $this->getOneById('products', 'prod_name', 'prod_description', 'prod_price', 'image', $id);
   }

// fonction qui permet de récupérer la catégorie du produit depuis la base de données.
   public function getCategory()
   {
      $sqlreq = "SELECT * FROM categories ";
      return $this->findAll($sqlreq);
   }
   
// fonction qui permet de récupérer la catégorie du produit par son ID de la base de données.
   public function getCategoryById($id)
   {
      return $this->getOneById('categories', 'cat_name', $id);
   }
}
