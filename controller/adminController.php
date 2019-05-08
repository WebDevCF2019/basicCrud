<?php

// import dependencies
require_once "../model/articleModel.php";
require_once "../model/rubriqueModel.php";
require_once "../model/usersModel.php";

if (isset($_GET['disconnect'])) {

// déconnexion:

    disconnect();

// create    
} elseif (isset($_GET['create'])) {


// update
} elseif (isset($_GET['update']) && ctype_digit($_GET['update'])) {

    $idarticle = (int) $_GET['update'];


    if (empty($_POST)) {

        // récupération de toutes les rubriques
        $recup_rub = recupCategMenu($mysqli);

        // récupération de tous les utilisateurs
        $recup_users = listUsers($mysqli);

        // récupération du détail de l'article
        $recup_article = recupOneArticleByAdmin($mysqli, $idarticle);
    }else{
        echo "<pre>";
        var_dump($_POST);
        echo "</pre>";
    }

    // appel de la vue
    require_once "../view/adminUpdateView.php";


// homepage
} else {

    // articles récuparation
    $articles = recupArticleAdmin($mysqli);


    // appel de la vue
    require_once "../view/adminHomepageView.php";
}