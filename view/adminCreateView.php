<!DOCTYPE html>
<html lang="en">
<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>basicCrud Administrateur Create Article</title>

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
            <h1 class="mt-5">basicCrud Administrateur Create Article</h1>
            <p class="lead">Création d'un article</p>
        </div>
    </div>
    <form action="" method="post" name="create">
        <div class="form-group">
            <label for="exampleInputEmail1">Le titre</label>
            <input name="thetitle" type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp"
                   placeholder="Votre titre" required>
        </div>
        <div class="form-group">
            <label for="exampleFormControlTextarea1">Votre texte</label>
            <textarea class="form-control" id="exampleFormControlTextarea1" name="thetext" rows="3" required></textarea>
        </div>
        <input type="datetime-local" name="thedate" required>

            <?php
            foreach($recup_rub AS $item) {
                ?>
        <div class="form-check">
                <input name="rubrique[]" class="form-check-input" type="checkbox" value="<?=$item['idrubrique']?>" id="defaultCheck">
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
                foreach ($recup_users as $itemUser){

                
                ?>
                <option value='<?=$itemUser['idusers']?>'><?=$itemUser['thename']?> | <?=$itemUser['thelogin']?></option>
                <?php
                }
                ?>
            </select>
        </div>
<div class="form-group">
            <label for="public">Affiché sur le site:</label>

            OUI : <input name='thevisibility' type="radio" value="1"> | ou |
            NON : <input name='thevisibility' type="radio" value="0" checked>
</div>

        <input type="submit" class="btn btn-primary" value="Envoyer">
    </form>

</div>

<!-- Bootstrap core JavaScript -->
<script src="js/jquery.min.js"></script>
<script src="js/bootstrap.bundle.min.js"></script>
</body>
</html>