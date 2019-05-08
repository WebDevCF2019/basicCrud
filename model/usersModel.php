<?php

/*
 *
 * connexion to admin
 *
 * @
 *
 */
function ConnectUser(mysqli $db,$login,$pwd){
    $login = htmlspecialchars(strip_tags(trim($login)),ENT_QUOTES);
    $pwd = htmlspecialchars(strip_tags(trim($pwd)),ENT_QUOTES);
    // to sha256 into database
    $pwd256 = hash("sha256",$pwd);

    $sql="SELECT users.idusers, users.thename, users.themail,
	perm.thename AS permname, perm.theperm
	FROM users
    INNER JOIN perm
		ON perm.idperm = users.perm_idperm
    WHERE users.thelogin='$login' AND users.thepwd='$pwd256';";

    $req = mysqli_query($db,$sql);

    // si connecté
    if(mysqli_num_rows($req)){
        // création de la session avec les valeurs récupérées et le phpsessid (session_id())
        $_SESSION = mysqli_fetch_assoc($req);
        $_SESSION['myident']=session_id();
        // actualisation
        header("Location: ./");
    }else{
        return false;
    }

}

/*
 *
 * Disconnect session
 *
 */

function disconnect(){
    // Détruit toutes les variables de session
    $_SESSION = array();

// Si vous voulez détruire complètement la session, effacez également
// le cookie de session.
// Note : cela détruira la session et pas seulement les données de session !
    if (ini_get("session.use_cookies")) {
        $params = session_get_cookie_params();
        setcookie(session_name(), '', time() - 42000,
            $params["path"], $params["domain"],
            $params["secure"], $params["httponly"]
        );
    }

// Finalement, on détruit la session.
    session_destroy();
    // retour à l'accueil
    header("Location: ./");
}

/*
 * 
 * Recup all users for admin update and insert
 * 
 */

function listUsers(mysqli $db){
    
    $sql="SELECT idusers, thelogin, thename
            FROM users
           ORDER BY thename ASC";

    $req = mysqli_query($db,$sql);

    // on a au moins un résultat
    if(mysqli_num_rows($req)){
        
        return mysqli_fetch_all($req,MYSQLI_ASSOC);
        
    }else{
        return false;
    }
    
}
