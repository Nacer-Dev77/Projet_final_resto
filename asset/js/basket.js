//creée une fonction pour enregistré notre panier dans le localStorage du navigateur.

function saveBasket(basket) {
    // tronsformer un objet en chaine de caractères.
    localStorage.setItem('basket', JSON.stringify(basket));
}

//creée une fonction pour récupèrer le produit enregistré dans le localStorage du navigateur.
function getBasket() {
    // transformer notre chaine de caractères en objet.
    let basket = localStorage.getItem('basket');
    // faire une con
    if (basket == null) {
        return [];
    } else {
        return JSON.parse(basket);
    }
}

// creée une fonction pour ajout de produit dans le panier.
function addBasket(product) {
    //en récupère le panier du localStorage
    let basket = getBasket();
    //en cherche dans notre panier des produit avec le même id pour pouvoir l'ajouter et gérer la quantités.
    let foundProduct = basket.find(p => p.id == product.id);
    //en ajoute le produit.
    if (foundProduct != undefined) {
        foundProduct.quantity++;
    } else {
        product.quantity = 1;
        basket.push(product);
    }
    //aprés avoir récupèrer notre produit en l'enregistre.
    saveBasket(basket);
}

//creée une fonction pour suprimer produit.
function deleteFromBasket(product) {  
    let basket = getBasket()  
    //suprimer le produit avec id du produit.
    basket = basket.filter(p => p.id !=product.id);
    //aprés avoir suprimer notre produit en enregistre.
    saveBasket(basket);
}

//creée une fonction pour changer la quantités du produit.
function changeQuantity(product, quantity) {
    //en récupère le panier.
    let basket = getBasket();
    //en cherche dans notre panier des produit avec le même id pour pouvoir l'ajouter et gérer la quantités.
    let foundProduct = basket.find(p => p.id == product.id);
    //en aloute le produit.
    if (foundProduct != undefined) {
        foundProduct.quantity += quantity;
        if (foundProduct.quantity <= 0) {
            deleteFromBasket(foundProduct);
        } else {
            //aprés avoir changer la quantité du  produit en enregistre le changement..
            saveBasket(basket);
        }
    }
}

// creée une fonction pour calculer le nombre de produit.
function getNumberProduct(basket) {    
    //en déclare notre nombre à 0.
    let number = 0;
    //en ajoute le nombre de nos produits a number.
    for (let product of basket) {
        number += product.quantity;
    }
    return number;
}

// creée une fonction pour calculer le total des produit.
function getTotalPrice(basket) {
    let total = 0;
    for (let product of basket) {
        total += product.quantity * product.Price;
    }
    return total;
}
// Gestion du boutton du panier
function displayValidButton(products){
    let buttonValid = document.querySelector('.btn_valid_basket')
    let isEmpty = products == 0      
    buttonValid.classList.toggle('display_none',isEmpty)    
}

// Récupère les infos du localstorage et les affiches dans le dom
function displayBasket(){
    let basket = getBasket()
    //Selection de la div principale
    let articleContainer = document.querySelector('.basket_descreption')
    //balise à créer
    let quantityOfProductsContainer = document.createElement('p')
    let totalPriceContainer = document.createElement('p')  
    //Attribution de classe au balise  
    quantityOfProductsContainer.className='test_color total_quantity'
    totalPriceContainer.className='test_color total_price'
    //Calcul total de la quantité et du prix
    let quantityOfProducts = getNumberProduct(basket)
    let totalPrice = getTotalPrice(basket).toFixed(2)
    //Assignation du texte au balises
    quantityOfProductsContainer.textContent=`Nombre de produits dans la panier: ${quantityOfProducts}`
    totalPriceContainer.textContent = `Prix total: ${totalPrice}€`

    for (let i=0; i<basket.length; i++){       
        //balise à créer 
        let article = document.createElement('div')                
        let nameContainer = document.createElement('p')        
        let priceContainer = document.createElement('p')
        let quantityContainer = document.createElement('p') 
        let removeBtnContainer = document.createElement('button')       
        //Attribution de classe au balise
        article.className='basket_article'
        nameContainer.className='test_color js_name'
        priceContainer.className='test_color js_price'
        quantityContainer.className='test_color js_quantity'
        removeBtnContainer.className='test_color btn_delete_article'
        //Récupération des infos de l'objet       
        let name = basket[i].Name
        let price = basket[i].Price
        let quantity= basket[i].quantity
        let id = basket[i].id       
        //Attribution id à la balise
        article.id =id        
        //Assignation du texte au balises
        nameContainer.textContent=name        
        priceContainer.textContent=`Prix: ${price}€`
        quantityContainer.textContent=`Quantités: ${quantity}`
        removeBtnContainer.textContent='Suprimer'
        //Création du contenu sur la page
        articleContainer.append(article)
        article.append(nameContainer)      
        article.append(priceContainer)      
        article.append(quantityContainer)
        article.append(removeBtnContainer)
    }  
    //Création du contenu des totaux sur la page
    articleContainer.append(quantityOfProductsContainer)
    articleContainer.append(totalPriceContainer) 
    displayValidButton(quantityOfProducts)
}

// Supprime les éléments du dom et actualise l'affichage
function deleteDomContent(){      
    const divArticle = document.querySelectorAll('.basket_article')
    const totalPrice = document.querySelector('.total_price')
    const totalQuantity = document.querySelector('.total_quantity') 
    
    for(let i=0; i<divArticle.length; i++ ){                
        const removeBtnContainer = divArticle[i].children[3]
        removeBtnContainer.addEventListener('click',()=>{                         
            deleteFromBasket(divArticle[i])
            let basket = getBasket()  
            divArticle[i].remove()
            let newTotalPrice = getTotalPrice(basket).toFixed(2)            
            let newTotalQuantity = getNumberProduct(basket)                        
            totalPrice.innerHTML = `Prix total: ${newTotalPrice}€` 
            totalQuantity.innerHTML = `Nombre de produits dans la panier: ${newTotalQuantity}`          
            displayValidButton(newTotalQuantity) 
        })  
    }    
}

// trouve les élements du dom et créer un objet à envoyer dans le localstorage
function foundDomContent(){
    let basket_group = document.querySelectorAll('.js_basket_group') 
    for(let i=0; i<basket_group.length; i++)
    {
        let Name = basket_group[i].children[2].outerText
        let Price = basket_group[i].children[5].outerText.substring(5,10)   
        let Button= basket_group[i].children[6]
        let id= basket_group[i].attributes[1].value
        let Data = {
            id:id,
            Name: Name,
            Price:Price
        }
        Button.addEventListener('click',()=>{ addBasket(Data)})   
    }
}
// let urlProducts
let urlProducts = url.substring(url.lastIndexOf('/') + 1);

//Exécution du code
switch (urlProducts) {
    case 'index.php?route=entrees':
        foundDomContent()
        break;
    case 'index.php?route=plats':
        foundDomContent()
        break;
    case 'index.php?route=desserts':
        foundDomContent()
        break;
    case 'index.php?route=boissons':
        foundDomContent()
        break;
    case 'index.php?route=basket':
        displayBasket()     
        deleteDomContent()
        break;
}