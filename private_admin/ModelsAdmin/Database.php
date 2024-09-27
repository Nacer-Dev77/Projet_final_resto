<?php

namespace ModelsAdmin;

use ValueError;

require('../config/Config.php');
// on inclue le fichier config.php pour accéder aux infos de connexion à la database.

class Database
{
     // fonction qui nous connecte à database et retourne l'accès.
    protected $db;

    public function __construct()
    {
        $this->db = new \PDO('mysql:host=' . DB_HOST . ';dbname=' . DB_NAME . ';charset=utf8', DB_USER, DB_PASSWORD);
    }

//  méthode générique qui récupère et retourne tous.
    protected function findAll($sqlreq, $para = [])
    {
        $query = $this->db->prepare($sqlreq);
        $query->execute($para);
        return $query->fetchAll();
    }

//  méthode générique qui récupère et retourne l'information par son  ID.

    protected function getOneById(string $table, $id): array
    {

        $query = $this->db->prepare('SELECT * FROM ' . $table . ' WHERE prod_id =?');
        $query->execute([$id]);
        $data = $query->fetch();
        return $data;
    } 


//méthode générique qui récupère et retourne un utilisateur par son email.
    protected function getOneByEmail(string $table, $email)
    {
        $query = $this->db->prepare("SELECT * FROM " . $table . " WHERE user_email = ?");
        $query->execute([$email]);
        $data = $query->fetch();
        return $data;
    }
//méthode générique qui permet l'ajout de données à la base de données.
    protected function addOne(string $table, string $columns, string $values, $data)
    {
        $query = $this->db->prepare('INSERT INTO ' . $table . '(' . $columns . ') values (' . $values . ')');
        $query->execute($data);
        $query->closeCursor();
    }

//méthode générique qui permet d'effacer des données de la base de données. 
    protected function deleteOne(string $table,  $data)
    {
        $query = $this->db->prepare('DELETE FROM ' . $table . ' WHERE prod_id=?');
        $query->execute([$data]);
        $query->closeCursor();
    }    

//méthode  qui permet d'effacer des commentaires  de la base de données. 
    protected function deleteComment(string $table,  $data)
    {
        $query = $this->db->prepare('DELETE FROM ' . $table . ' WHERE com_id=?');
        $query->execute([$data]);
        $query->closeCursor();
    }

//méthode générique qui permet d'ajouter ou modifier des données de la base de données. 
    public function newUpdateDb($sqlreq, $data)
    {
        $query = $this->db->prepare($sqlreq);
        $query->execute($data);
        $query->closeCursor();
    }
}
