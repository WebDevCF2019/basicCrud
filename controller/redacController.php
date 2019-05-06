<?php
// import dependencies
require_once "../model/articleModel.php";
require_once "../model/rubriqueModel.php";
require_once "../model/usersModel.php";


if(isset($_GET['disconnect'])){

// déconnexion:

    disconnect();

}elseif(isset($_GET['create'])){

    // récupération de toutes les rubriques
    $recup_rub = recupCategMenu($mysqli);

    // si on a envoyé le formulaire
    if(!empty($_POST)){
        $thetitle = htmlspecialchars(strip_tags(trim($_POST['thetitle'])),ENT_QUOTES);
        $thetext = htmlspecialchars(strip_tags(trim($_POST['thetext'])),ENT_QUOTES);
        $thedate = $_POST['thedate'];

        // de la session
        $idusers = $_SESSION['idusers'];

        // si on a coché une rubrique
        if(isset($_POST['rubrique'])) {
            $rub = $_POST['rubrique'];
        }else{
            $rub = [];
        }

        $insert = createArticleRedac($mysqli,$idusers,$thetitle,$thetext,$thedate,$rub);

        // insertion ok
        if($insert){
            header("Location: ./");
        }

    }

    require_once "../view/redacCreateView.php";
/*
 *
 * si un rédacteur veut modifier un de ses articles
 *
 *
 */
}elseif(isset($_GET['update'])&&ctype_digit($_GET['update'])){

    $idarticle = (int) $_GET['update'];

    // on a pas cliqué sur modifier
    if(empty($_POST)){

        // récupération de l'article par son id
        $recup_article = recupOneArticleByUsers($mysqli,$idarticle,$_SESSION['idusers']);

        // essaie d'accèder à un article qui n'est pas à lui
        if(!$recup_article){
            // on le déconnecte
            disconnect();
        }

        // récupération de toutes les rubriques
        $recup_rub = recupCategMenu($mysqli);

        // appel de la vue
        require_once "../view/redacUpdateView.php";

    }else{
        
        
        updateOneArticleByUsers($mysqli, $_POST, $idarticle, $_SESSION['idusers']);
        header("Location: ./");
    }



}else{

    // articles récuparation
    $articles = recupArticleRedac($mysqli, $_SESSION['idusers']);



    require_once "../view/redacHomepageView.php";
}