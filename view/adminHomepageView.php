<!DOCTYPE html>
<html lang="en">
<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>basicCrud Administrateur Homepage</title>

    <!-- Bootstrap core CSS -->
    <link href="css/bootstrap.min.css" rel="stylesheet">

</head>
<body>

<!-- Navigation -->
    <?php
    include "adminMainMenuView.php";
    ?>
<h3>Bienvenue <?= $_SESSION['thename'] ?></h3>
<!-- Page Content -->
<div class="container">
    <div class="row">
        <div class="col-lg-12 text-center">
            <h1 class="mt-5">basicCrud Rédacteur Homepage</h1>
            <p class="lead">Liste de vos articles de notre site</p>
        </div>
    </div>

    <!-- Articles -->
    <?php
    // pas d'article
    if($articles===false){
        ?>
        <div class="row">
            <div class="col-lg-12 text-center">
                <hr>
                <h2>Pas encore d'articles</h2>
                <h3>Vous n'avez pas encore écris d'article</h3>
                <hr>
            </div>
        </div>
        <?php
    }else {
        foreach ($articles AS $itemArticle) {
            // pas de rubriques
            if(is_null($itemArticle['idrubrique'])){
                $idrubrique="";
            }else {
                $idrubrique = explode(',', $itemArticle['idrubrique']);
                $theintitule = explode('|@|',$itemArticle['theintitule']);
            }
            ?>
            <div class="row">
                <div class="col-lg-12 text-left">
                    <h2><?= $itemArticle['thetitle'] ?></h2>
                    <h3><?php if($itemArticle['thevisibility']==1) {
                        echo "Est publié";
                        }else{
                        echo "est en attente de publication";
                        }?> | <a href="?update=<?= $itemArticle['idarticle'] ?>"><img src="img/update.png" alt="Modifier" title="Modifier"/></a> </h3>
                    <h4>Catégorie : <small><?php
                            if(empty($idrubrique)){
                                ?>
                                Cet article n'est dans aucune catégorie
                                <?php
                            }else{
                                foreach($theintitule as $clef => $intitule){
                                    ?>
                                    <?=$intitule?> |
                                    <?php
                                }
                            }
                            ?></small></h4>
                    <p><?php
                        $position_last_space = strrpos($itemArticle['thetext'],' ');
                        echo substr(html_entity_decode($itemArticle['thetext']),0,$position_last_space);
                        ?> ... </p>
                    <p><?= $itemArticle['thedate'] ?> Par <?= $itemArticle['thename'] ?></p>
                </div>
            </div>
            <hr>
            <?php
        }
    }
    ?>
</div>

<!-- Bootstrap core JavaScript -->
<script src="js/jquery.min.js"></script>
<script src="js/bootstrap.bundle.min.js"></script>
</body>
</html>