<?php
require_once 'inc/init.inc.php';
//------------------------------------- TRAITEMENT PHP -------------------------------------//
debug($_SESSION);
if(isset($_GET['action']) && $_GET['action'] == "deconnexion")
{
    if(isset($_COOKIE[session_name()]))
    {
        // setcookie permet de créer un cookie sauf si la durée de vie est négative
        // nom_du_cookie, valeur, durée_de_vie, path
        setcookie(session_name(), '', time()-42000, '/');
    }
    session_destroy();
}

if(internauteEstConnecte())
{
    header("location:profil.php");
}

if($_POST) {
    // debug($_POST);
    $resultat = executeRequete("SELECT * FROM membre WHERE pseudo ='$_POST[pseudo]'");
    if($resultat->rowCount() != 0) {
        // on applique un fetch sur la réponse de la bdd pour rendre les résultats exploitable sous forme de tableau associatif
        $membre = $resultat->fetch(PDO::FETCH_ASSOC);
        debug($membre);
        if(password_verify($_POST['mdp'], $membre['mdp'])){
            foreach($membre AS $indice => $valeur)
            {
                if($indice != 'mdp')
                {
                    $_SESSION['membre'][$indice] = $valeur;
                }
            }
            header("location:profil.php");
        }  else {
            // dans le cas ou le mdp est incorrect
            $contenu .= "<div class='alert alert-danger text-center'>🛑 Identifiants incorrect : Ce mot de passe est incorrect.</div>";
        }

    } else {
        // dans le cas ou le pseudo n'a pas été trouvé en bdd
        $contenu .= "<div class='alert alert-danger text-center'>🛑 Identifiants incorrect : Ce pseudo n'existe pas.</div>";
    }
}


//------------------------------------- AFFICHAGE HTML -------------------------------------//
require_once 'inc/haut.inc.php';
echo $contenu;
?>


<div class="jumbotron text-center mt-5">
    <h2>CONNEXION</h2>
</div>
<div class="container mt-5">
    <div class="row">
        <div class="col-md-6 mx-auto">
            <form action="" method="post">
                <div class="mb-3">
                    <label for="pseudo" class="form-label">Pseudo</label>
                    <input type="text" class="form-control" name="pseudo" id="pseudo" placeholder="🐱‍👤 Entrer votre Pseudo">
                </div>
                <div class="mb-3">
                    <label for="mdp" class="form-label">Mot de Passe</label>
                    <input type="password" class="form-control" name="mdp" id="mdp" placeholder="🔐 Entrer votre mot de passe">
                </div>
                <div class="mb-3 text-center mt-5">
                    <button type="submit" class="btn btn-primary btn-lg">Se connecter ✅</button>
                </div>
            </form>
        </div>
    </div>
</div>
<?php
require_once 'inc/bas.inc.php';