<!DOCTYPE html>
<html lang="en">
<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>basicCrud Mise à jour de <?=$recup_article['thetitle']?></title>

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
            <h1 class="mt-5">basicCrud Administrateur update</h1>
            <p class="lead">Mise à jour de <?=$recup_article['thetitle']?></p>
        </div>
    </div>
    <form action="" method="post" name="create">
        <div class="form-group">
            <label for="exampleInputEmail1">Le titre</label>
            <input name="thetitle" type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" value="<?=$recup_article['thetitle']?>"
                   placeholder="Votre titre" required>
        </div>
        <div class="form-group">
            <label for="exampleFormControlTextarea1">Votre texte</label>
            <textarea class="form-control" id="exampleFormControlTextarea1" name="thetext" rows="3" required><?=$recup_article['thetext']?></textarea>
        </div>
        <div class="form-group">
         <label for="lulu">La date</label>
        <input type="text" id='lulu' name="thedate" required value="<?=$recup_article['thedate']?>">
        </div>
        <div class="form-group">
         <label for="lala">Les rubriques</label>
            <?php
            // on récupère les 'idrubrique' de l'article avant update en transformant le tout en tableau grâce au séparateur , 
            $tab_rub_article = explode(",", $recup_article['idrubrique']);
            
            // tant qu'on a des rubriques
            foreach($recup_rub AS $item) {
                
       
                // condition ternaire pour cocher ou non les rubriques sélectionnées avant l'update
    $check = (in_array($item['idrubrique'],$tab_rub_article))?"checked":"";
                
                
                ?>
        
        <div class="form-check">
            
            <input name="rubrique[]" class="form-check-input" type="checkbox" value="<?=$item['idrubrique']?>" id="defaultCheck" <?=$check?>>
                <label class="form-check-label" for="defaultCheck">
                    <?=$item['theintitule']?>
                </label>
        </div>
                <?php
            }
            ?>

<div class="form-group">
            <label for="choiceuser">Choix de l'utilisateur:</label>
            <select name='idusers' id='choiceuser' required>
                <?php
                
                // variable contenant l'utilisateur propriétaire de l'article venant de la DB
                $idusersActu = $recup_article['idusers'];
                
                foreach ($recup_users as $itemUser){
                    
                   $text = ($itemUser['idusers']==$idusersActu) 
                           ? "selected": "";
                
                ?>
                <option value='<?=$itemUser['idusers']?>' <?=$text?>><?=$itemUser['thename']?> | <?=$itemUser['thelogin']?></option>
                <?php
                }
                ?>
            </select>
        </div>
<div class="form-group">
            <label for="public">Affiché sur le site:</label>
            <?php
            if($recup_article['thevisibility']==0){
                $visible = ""; $unvisible = "checked";
            }else{
                $visible = "checked"; $unvisible = "";
            }
            ?>
            OUI : <input name='thevisibility' type="radio" value="1" <?=$visible?>> | ou |
            NON : <input name='thevisibility' type="radio" value="0" <?=$unvisible?>>
</div>
        <input type="submit" class="btn btn-primary" value="Envoyer">
    </form>

</div>

<!-- Bootstrap core JavaScript -->
<script src="js/jquery.min.js"></script>
<script src="js/bootstrap.bundle.min.js"></script>
</body>
</html>