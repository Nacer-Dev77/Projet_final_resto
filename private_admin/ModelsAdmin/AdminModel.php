<?php


namespace ModelsAdmin;

use  ModelsAdmin\Database;

class AdminModel extends Database
{
    //function pour récupérer et retourner tous les produits de la base de données.
    public function getAllProducts()
    {
        $sqlreq = "SELECT * FROM products INNER JOIN categories on products.prod_category_id = categories.id";
        return $this->findAll($sqlreq);
    }
     //function pour récupérer et retourner un produit de la base de données.
    public function getProducts()
    {
        $sqlreq = "SELECT * FROM products ORDER BY create_at DESC";
        return $this->findAll($sqlreq);
    }
     //function pour récupérer et retourner  les catogries de la base de données.
    public function getCategories()
    {
        $sqlreq = "SELECT * FROM categories ";
        return $this->findAll($sqlreq);
    }
    //function pour récupérer et retourner  un produit par son ID de la base de données.
    public function getProductById($id)
    {

        return $this->getOneById('products',  $id);
    }
    // function pour supprimer un produit de la base de données.
    public function deleteOneProduct($id)
    {
        return $this->deleteOne('products', $id);
    }
    // function pour ajouter un produit à la base de données.
    public function addNewProduct($data)
    {
        $this->addOne(
            'products',
            'prod_name ,prod_description, prod_category_id, prod_price,prod_image',
            '?,?,?,?,?',
            $data
        );
    }
    
    // function pour modifier un produit à la base de données.
    public function updateProduct($data): void
    {
        $sqlreq = "UPDATE products 
        SET prod_name=:prod_name,prod_description=:prod_description,prod_category_id=:prod_category_id,prod_price=:prod_price,prod_image=:prod_image
         WHERE prod_id=:id";
        $this->newUpdateDb($sqlreq, $data);
    }
    
      //function pour récupérer et retourner  un utilisateur par son email de la base de données.
    public function getUserByEmail($email)
    {
        return $this->getOneByEmail('users', $email);
    }
    //function pour récupérer et retourner  tous les utilisateurs de la base de données.
    public function getAllUsers()
    {
        $sqlreq = "SELECT * FROM users ";
        return $this->findAll($sqlreq);
    }
     //function pour récupérer et retourner  tous les commentaires de la base de données.
    public function getAllComments()
    {
        $sqlreq = "SELECT * FROM comments INNER JOIN users on comments.com_username_id=users.user_id  ORDER BY com_create_at DESC";

        return $this->findAll($sqlreq);
    }
    // function pour supprimer un commentaire de la base de données.
    public function deleteOneComment($id)
    {
        return $this->deleteComment('comments', $id);
    }
    //
}
