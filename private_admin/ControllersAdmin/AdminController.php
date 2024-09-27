<?php

namespace ControllersAdmin;


class  AdminController
{
    // afficher la page produits.
    public function displayProducts()
    {
        //méthode pour récupérer les produits afin de les afficher dans la vue.
        $model = new \ModelsAdmin\AdminModel();
        $products = $model->getProducts();

        $views_admin = 'products';
        include_once 'views_admin/layout_admin.phtml';
    }
    // afficher la page formulaire ajout de  produits.
    public function displayFormAddProduct()
    {

        $views_admin = 'add_product';
        include_once 'views_admin/layout_admin.phtml';
    }
    
    // page pour effacer un produit.
    public function delete_Product()
    {
       // méthode pour effacer un produit. 
        $id = $_GET["id"];
        $model = new \ModelsAdmin\AdminModel();
        $model->deleteOneProduct($id);
        //récupérer les produits pour les afficher dans la vue en dessous.
        $products = $model->getProducts();

        $views_admin = 'products';
        include_once 'views_admin/layout_admin.phtml';
    }
    
    // page pour modifier les produits. 
    public function updateproduct()
    {
        //récupérer id.
        $id = $_GET["id"];
        $model = new \ModelsAdmin\AdminModel();
        //récupérer le produit par son ID et sa catégorie.
        $product = $model->getProductById($id);
        $categories = $model->getCategories();
       //afficher la page pour modifier le produit avec formulaire préremplie.   
        $views_admin = 'update_products';
        include_once 'views_admin/layout_admin.phtml';
    }

    // function pour modifier produit.
    public function update()
    {
        $id = $_GET["id"];
        
         //on déclare nôtre tableau d'erreurs.
        $errors = [];

        // si les champs exitent.
        if (
            array_key_exists('prod_name', $_POST) &&
            array_key_exists('prod_description', $_POST) &&
            array_key_exists('cat_name', $_POST) &&
            array_key_exists('prod_price', $_POST) &&
            array_key_exists('prod_image', $_POST)

        ) {
            
            //on stock les champs dans le tableau $updateProduct.
            $updateProduct =
                [
                    'prod_name' => $_POST['prod_name'],
                    'prod_description' => $_POST['prod_description'],
                    'cat_name' => $_POST['cat_name'],
                    'prod_price' => $_POST['prod_price'],
                    'prod_image' => $_POST['prod_image']
                ];

            // si le champs prod_name est renseigné et qu'il n'existe pas déja dans la base de données.
            if (empty($updateProduct['prod_name']) && ($updateProduct['prod_name']) !== ($_POST['prod_name']))
            //sinon message d'erreur.
                $errors[] = "Donnez un  nom au produit  ";
                
            // si le champs prod_description est correctement  renseigné.
            if (empty($updateProduct['prod_description']))
            //sinon message d'erreur.
                $errors[] = "Décrivez le produit.";

             // si le champs cat_name est correctement  renseigné.
            if (empty($updateProduct['cat_name']))
            //sinon message d'erreur.
                $errors[] = "La catégorie du produit  est obligatoire";

             // si le champs prod_price est correctement  renseigné.
            if (empty($updateProduct['prod_price']))
             //sinon message d'erreur.
                $errors[] = "Indiqué le prix du produit .";
            
            // si le champs prod_image est correctement  renseigné .
            if (empty($updateProduct['prod_image']))
            //sinon message d'erreur.
                $errors[] = "Insérez une image du produit  ";

            if (count($errors) == 0) {

                //si pas d'erreurs , on update le produit par son ID.
                $model = new \ModelsAdmin\AdminModel();

                // stocker les données renseignées dans le tableau $data.
                $data =

                    [
                        'prod_name' => $updateProduct['prod_name'],
                        'prod_description' => $updateProduct['prod_description'],
                        'prod_category_id' => $updateProduct['cat_name'],
                        'prod_price' => $updateProduct['prod_price'],
                        'prod_image' =>  $updateProduct['prod_image'],
                        'id' => $id

                    ];
                // envoyer les données de la modification $data à la base de données avec la méthode updateProduct.
                $model->updateProduct($data);
                $model = new \ModelsAdmin\AdminModel();
                //récupérer le produit par son ID. 
                $product = $model->getProductById($id);
                //rediriger vers la page de tableau produit. 
                header('location:index.php?road=products');
            }
        }
        $model = new \ModelsAdmin\AdminModel();
        $product = $model->getProductById($id);
        header('location:index.php?road=products');
    }


    //function pour ajouter nouveau produits.
    public function verifyAndAddNewProduct()
    {
        //on déclare nôtre tableau d'erreurs.
        $errors = [];

        // si les champs exitent.
        if (
            array_key_exists('prod_name', $_POST) &&
            array_key_exists('prod_description', $_POST) &&
            array_key_exists('cat_name', $_POST) &&
            array_key_exists('prod_price', $_POST) &&
            array_key_exists('prod_image', $_POST)

        ) {
             //on stock les champs dans le tableau $addNewProduct.
            $addNewProduct =
                [
                    'prod_name' => $_POST['prod_name'],
                    'prod_description' => $_POST['prod_description'],
                    'cat_name' => $_POST['cat_name'],
                    'prod_price' => $_POST['prod_price'],
                    'prod_image' => $_POST['prod_image']
                ];


            // si le champs prod_name est renseigné et qu'il n'existe pas déja dans la base de données.
            if (
                empty($addNewProduct['prod_name']) &&
                ($addNewProduct['prod_name']) !== ($_POST['prod_name'])
            )
            //sinon message d'erreur.
                $errors[] = "Donnez un  nom au produit  ";
            
            // si le champs prod_description est renseigné.
            if (empty($addNewProduct['prod_description']))
                //sinon message d'erreur.
                $errors[] = "Décrivez le produit.";
            
             // si le champs cat_name est renseigné.
            if (empty($addNewProduct['cat_name']))
              //sinon message d'erreur.
                $errors[] = "La catégorie du produit  est obligatoire";
            // si le champs prod_price est renseigné.
            if (empty($addNewProduct['prod_price']))
            //sinon message d'erreur.
                $errors[] = "Indiqué le prix du produit .";
            // si le champs prod_image est renseigné.
            if (
                empty($addNewProduct['prod_image'])
            )
            //sinon message d'erreur.
                $errors[] = "Insérez une image du produit  ";

            if (count($errors) == 0) {
                 //si pas d'erreurs utiliser la méthode getProducts pour récupérer les données du produit  et comparer les champs renseigné si le produit existe déja.
                $model = new \ModelsAdmin\AdminModel();
                $result = $model->getProducts();

                if ($result != false)
                //sinon message d'erreur.
                    $errors[] =  "Désolé, ce produit existe déjà !";
                // stocker les données renseignées dans le tableau $data.
                $data =
                    [

                        $addNewProduct['prod_name'],
                        $addNewProduct['prod_description'],
                        $addNewProduct['cat_name'],
                        $addNewProduct['prod_price'],
                        $addNewProduct['prod_image']


                    ];
                     // envoyer les données du tableau $data à la base de données avec la méthode addNewProduct
                $model->addNewProduct($data);
            }
        }
        //récupérer les produit et les afficher dans le tableau des produit déclaré en dessous.
        $model = new \ModelsAdmin\AdminModel();
        $products = $model->getProducts();
        $views_admin = "products";
        include_once 'views_admin/layout_admin.phtml';
    }
}
