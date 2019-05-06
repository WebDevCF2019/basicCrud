<?php
// import dependencies
require_once "../model/articleModel.php";
require_once "../model/rubriqueModel.php";
require_once "../model/usersModel.php";

if(isset($_GET['disconnect'])){

// déconnexion:

    disconnect();

}elseif(isset($_GET['create'])){
    
    
    // homepage
}else{
    
     // articles récuparation
    $articles = recupArticleAdmin($mysqli);



    require_once "../view/adminHomepageView.php";
    
}