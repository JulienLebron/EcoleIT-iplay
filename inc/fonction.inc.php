<?php
//----------------------------------------------------
function executeRequete($req)
{
    global $pdo; // accès à la connexion PDO définie dans init.inc.php
    try
    {
        $resultat = $pdo->query($req); // exécute la requête
    }
    catch(PDOException $e)
    {
        // En cas d'erreur SQL on affiche un message
        die("🛑 Une erreur est survenue sur la requête SQL.<br>
        Message de l'erreur : " . $e->getMessage() . "<br>
        Code de la requête : " . $req);
    }

    return $resultat; // retourne l'objet PDOStatement
}
//----------------------------------------------------
function debug($var, $mode = 1)
{
    echo '<div style="background: orange; padding: 5px;">';

    $trace = debug_backtrace();
    $trace = array_shift($trace);

    echo "Debug demandé dans le fichier : $trace[file] à la ligne $trace[line].";

    if($mode === 1)
    {
        echo '<pre>'; print_r($var); echo '</pre>';
    }
    else
    {
        echo '<pre>'; var_dump($var); echo '</pre>';
    }

    echo '</div>';
}